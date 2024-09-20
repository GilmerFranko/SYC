<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project - Cron de Auto-renueva
 *=======================================================
 * Este archivo se ejecuta como cron job cada 5 minutos
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 */

class AutoRenuevaCron extends Model
{
  private $renewalCost = 0.2; // Monto fijo para la renovación

  /**
   * Ejecuta la función de auto-renueva para los hilos que lo tengan activado
   */
  public function processAutoRenewals()
  {
    // Obtener los hilos que tienen auto-renueva activado
    $query = $this->db->query("
            SELECT ars.thread_id, ars.renewal_interval, t.position, mb.member_id
            FROM auto_renueva_settings ars
            INNER JOIN f_threads t ON ars.thread_id = t.id
            INNER JOIN member_balance mb ON t.member_id = mb.member_id
            WHERE ars.is_enabled = 1
        ");

    if ($query && $query->num_rows > 0)
    {
      $this->log('Se encontraron ' . $query->num_rows . ' hilos con la auto-renovacion activada');

      // Cantidad de hilos renovados
      $renewed_threads = 0;
      // Cantidad de hilos que se deben renovar
      $threads_to_renew = 0;

      while ($row = $query->fetch_assoc())
      {
        $thread_id = (int) $row['thread_id'];
        $member_id = (int) $row['member_id'];
        $renewal_interval = (int) $row['renewal_interval']; // Intervalo de auto-renueva en horas
        $last_position = (int) $row['position']; // Timestamp de la última renovación

        // Comprobar si ha pasado suficiente tiempo desde la última renovación
        $current_time = time();
        $next_renewal_time = $last_position + ($renewal_interval * 0); // Intervalo en segundos

        if ($current_time >= $next_renewal_time)
        {
          $threads_to_renew++;
          // Tiempo de renovar el hilo
          if ($this->manualRenew($thread_id, $member_id))
          {
            $renewed_threads++;
          }
        }
      }
      $this->log($threads_to_renew . ' de ellos debería renovarse, ' . $renewed_threads . ' renovados');
    }
  }

  /**
   * Renueva un hilo manualmente (una sola vez)
   *
   * @param int $thread_id ID del hilo
   * @param int $member_id ID del usuario
   * @return bool True si se renovó correctamente, False si no
   */
  public function manualRenew($thread_id, $member_id)
  {
    // Verificar si el usuario tiene suficiente saldo en la billetera
    $userWallet = $this->getUserBalance($member_id);
    if ($userWallet < $this->renewalCost)
    {
      // Enviar notificación al usuario 
      newNotification($member_id, 0, 'renewalFail', $thread_id);
      // No tiene suficiente saldo, detener la renovación
      $this->disableAutoRenew($thread_id);

      $this->log('El usuario ' . $member_id . ' no tiene suficiente saldo en la billetera para renovar el hilo ' . $thread_id);
      return false;
    }

    // Iniciar una transacción y desactivar el autocommit
    if ($this->db->begin_transaction())
    {
      $this->db->autocommit(false);
      echo 'si';
    }
    try
    {
      // Restar el monto fijo de la billetera del usuario
      if (!$this->debitWallet($member_id, $this->renewalCost))
      {
        // Hubo un problema al debitar, revertir transacción
        throw new Exception('No se pudo debitar el monto de la billetera');
      }

      // Actualizar la columna position del hilo con la hora actual (formato UNIX)
      $stmt = $this->db->prepare("UPDATE f_threads SET position = UNIX_TIMESTAMP(), count_renewals = count_renewals + 1 WHERE id = ?");
      if (!$stmt)
      {
        throw new Exception('Error preparando la consulta: ' . $this->db->error);
      }

      $stmt->bind_param('i', $thread_id);
      $stmt->execute();

      if ($stmt->affected_rows === 0)
      {
        // No se actualizó ningún hilo, revertir transacción
        throw new Exception('No se pudo actualizar la columna position del hilo ' . $thread_id);
      }

      // Confirmar la transacción
      $this->db->commit();
      $this->db->autocommit(true);

      // Enviar notificación al usuario 
      newNotification($member_id, 0, 'renewalSuccess', $thread_id);

      $this->log('El usuario ' . $member_id . ' ha renovado el hilo ' . $thread_id);
      return true;
    }
    catch (Exception $e)
    {
      // En caso de error, revertir la transacción
      $this->db->rollback();
      if ($this->db->ping())
      {
        echo ('Rollback ejecutado con éxito');
      }
      else
      {
        echo ('Error: La conexión a la base de datos no está activa');
      }
      $this->db->autocommit(true);
      $this->log('Error en la renovación del hilo: ' . $e->getMessage());
      return false;
    }
  }


  /**
   * Obtiene el saldo actual de la billetera del usuario
   *
   * @param int $member_id ID del usuario
   * @return float Saldo disponible en la billetera
   */
  public function getUserBalance($member_id)
  {
    $query = $this->db->query(
      "
            SELECT balance FROM member_balance 
            WHERE member_id = " . (int)$member_id
    );

    if ($query && $query->num_rows > 0)
    {
      $row = $query->fetch_assoc();
      return (float)$row['balance'];
    }

    return 0.0;
  }

  /**
   * Debita un monto de la billetera del usuario
   *
   * @param int $member_id ID del usuario
   * @param float $amount Monto a debitar
   * @return bool True si se debitó correctamente, False si no
   */
  public function debitWallet($member_id, $amount)
  {
    // Verificar que el usuario tenga saldo suficiente
    $balance = $this->getUserBalance($member_id);
    if ($balance < $amount)
    {
      return false;
    }

    return loadClass('members/transactions')->updateBalance($member_id, $amount, false, 'autoRenewal');
  }

  /**
   * Escribe un mensaje en el log de auto-renueva
   *
   * @param string $message Mensaje a escribir en el log
   * @return void
   */
  private function log($message)
  {
    echo $message . '<br>';
    $log_file = __DIR__ . '/auto_renueva.log';
    if (!file_exists($log_file))
    {
      // Crear el archivo si no existe
      touch($log_file);
    }
    $date = date('d/m/Y H:i:s');
    $message = sprintf("[%s] %s\n", $date, $message);
    file_put_contents($log_file, $message, FILE_APPEND);
  }



  /**
   * Desactiva la función de auto-renueva para un hilo
   *
   * @param int $thread_id ID del hilo
   * @return bool True si se desactivó correctamente, False si no
   */
  public function disableAutoRenew($thread_id)
  {
    // Verificar si el hilo tiene activado el auto-renueva
    if (!$this->isAutoRenewEnabled($thread_id))
    {
      return false;
    }

    // Desactivar la función de auto-renueva
    return $this->toggleAutoRenew($thread_id, false);
  }

  /**
   * Verifica si un hilo tiene activado el auto-renueva
   *
   * @param int $thread_id ID del hilo
   * @return bool True si está activado, False si no
   */
  public function isAutoRenewEnabled($thread_id)
  {
    $stmt = $this->db->prepare("SELECT 1 FROM auto_renueva_settings WHERE thread_id = ? AND is_enabled = 1");
    $stmt->bind_param('i', $thread_id);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
  }

  /**
   * Activa o desactiva la función de auto-renueva para un hilo
   *
   * @param int $thread_id ID del hilo
   * @param bool $enable True para activar, False para desactivar
   * @return bool True si se activó/desactivó correctamente
   */
  public function toggleAutoRenew($thread_id, $enable)
  {
    $is_enabled = $enable ? 1 : 0;

    // Primero, verificar si el hilo ya tiene un registro en la tabla
    $stmt = $this->db->prepare("SELECT 1 FROM auto_renueva_settings WHERE thread_id = ?");
    $stmt->bind_param('i', $thread_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0)
    {
      // Registro existe, hacer actualización
      $stmt = $this->db->prepare("UPDATE auto_renueva_settings SET is_enabled = ? WHERE thread_id = ?");
      $stmt->bind_param('ii', $is_enabled, $thread_id);
      $stmt->execute();
      return $stmt->affected_rows > 0;
    }
    else
    {
      // Registro no existe, hacer inserción
      $stmt = $this->db->prepare("INSERT INTO auto_renueva_settings (thread_id, is_enabled) VALUES (?, ?)");
      $stmt->bind_param('ii', $thread_id, $is_enabled);
      $stmt->execute();
      return $stmt->affected_rows > 0;
    }
  }
}
