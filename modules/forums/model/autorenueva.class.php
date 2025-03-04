<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Clase para gestionar la función Auto Renueva
 */

class AutoRenueva extends Model
{
  private $renewalCost = 0.2; // Monto fijo para la renovación

  public function __construct()
  {
    parent::__construct();
    $this->session = Core::model('session', 'core');
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
    error_log('Renueva un hilo manualmente (una sola vez)');
    // Verificar si el usuario tiene suficiente saldo en la billetera
    $userWallet = getBalance($member_id);
    if ($userWallet < $this->renewalCost)
    {
      error_log('El usuario no tiene suficiente saldo en la billetera');
      // No tiene suficiente saldo, detener la renovación
      return false;
    }

    // Iniciar una transacción
    $this->db->begin_transaction();

    try
    {
      // Restar el monto fijo de la billetera del usuario
      if (!$this->debitWallet($member_id, $this->renewalCost))
      {
        // Hubo un problema al debitar, revertir transacción
        $this->db->rollback();
        error_log('No se pudo debitar el monto fijo de la billetera del usuario');
        return false;
      }

      // Actualizar la columna position del hilo con la hora actual (formato UNIX)
      $stmt = $this->db->prepare("UPDATE f_threads SET position = UNIX_TIMESTAMP() WHERE id = ?");
      $stmt->bind_param('i', $thread_id);
      $stmt->execute();
      if ($stmt->affected_rows === 0)
      {
        // No se actualizó ningún hilo, revertir transacción
        $this->db->rollback();
        error_log('No se pudo actualizar la columna position del hilo');
        return false;
      }

      // Confirmar la transacción
      $this->db->commit();
      return true;
    }
    catch (Exception $e)
    {
      // En caso de error, revertir la transacción
      $this->db->rollback();
      return false;
    }
  }

  /**
   * Activa la función de auto-renueva y renueva el hilo instantáneamente
   *
   * @param int $thread_id ID del hilo
   * @param int $member_id ID del usuario
   * @return bool True si se activó y renovó correctamente, False si no
   */
  public function activateAutoRenew($thread_id, $member_id, $interval = 6)
  {
    // Verificar si ya tiene activado auto-renueva
    if ($this->isAutoRenewEnabled($thread_id))
    {
      return false;
    }

    // Realizar una renovación manual (se renovará instantáneamente)
    if (!$this->manualRenew($thread_id, $member_id))
    {
      return false; // Si falla la renovación manual, no se activa el auto-renueva
    }

    // Activar la función de auto-renueva
    return $this->toggleAutoRenew($thread_id, true, $interval);
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
    if ($this->isAutoRenewEnabled($thread_id) == false)
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
    $result = $this->db->query("SELECT id FROM auto_renueva_settings WHERE thread_id = $thread_id AND is_enabled = 1");
    error_log("SELECT id FROM auto_renueva_settings WHERE thread_id = $thread_id AND is_enabled = 1");
    return $result->num_rows > 0;
  }

  /**
   * Activa o desactiva la función de auto-renueva para un hilo
   *
   * @param int $thread_id ID del hilo
   * @param bool $enable True para activar, False para desactivar
   * @return bool True si se activó/desactivó correctamente
   */
  public function toggleAutoRenew($thread_id, $enable, $interval = 6)
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
      $stmt = $this->db->prepare("UPDATE auto_renueva_settings SET is_enabled = ?, renewal_interval = ? WHERE thread_id = ?");
      $stmt->bind_param('iii', $is_enabled, $interval, $thread_id);
      $stmt->execute();
      return $stmt->affected_rows > 0;
    }
    else
    {
      // Registro no existe, hacer inserción
      $stmt = $this->db->prepare("INSERT INTO auto_renueva_settings (thread_id, is_enabled, renewal_interval) VALUES (?, ?, ?)");
      $stmt->bind_param('iii', $thread_id, $is_enabled, $interval);
      $stmt->execute();
      return $stmt->affected_rows > 0;
    }
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
    $balance = getBalance($member_id);
    if ($balance < $amount)
    {
      return false;
    }

    return loadClass('members/transactions')->updateBalance($member_id, $amount, false, 'autoRenewal');
  }
}
