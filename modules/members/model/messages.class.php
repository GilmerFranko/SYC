<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los mensajes entre usuarios.
 *
 */
class messages extends Model
{

  /**
   * Devuelve todos los mensajes entre dos usuarios.
   *
   * @param int $from_member_id ID del remitente.
   * @param int $to_member_id ID del destinatario.
   * @return array|boolean Los mensajes entre los dos usuarios.
   */
  public function getMessagesBetween($from_member_id, $to_member_id)
  {
    $query = $this->db->query("SELECT * FROM `members_messages` WHERE (`from_member_id` = $from_member_id AND `to_member_id` = $to_member_id)OR (`from_member_id` = $to_member_id AND `to_member_id` = $from_member_id)ORDER BY `sent_at` ASC");

    if ($query == true && $query->num_rows > 0)
    {
      $messages = array();
      while ($row = $query->fetch_assoc())
      {
        $messages[] = $row;
      }
      return $messages;
    }
    else
    {
      return false;
    }
  }

  /**
   * Envía un nuevo mensaje entre dos usuarios.
   *
   * @param int $from_member_id ID del remitente.
   * @param int $to_member_id ID del destinatario.
   * @param string $content Contenido del mensaje.
   * @param string|null $image_url URL de la imagen si existe.
   * @return boolean True si el mensaje se envió con éxito, False en caso contrario.
   */
  public function sendMessage($data)
  {
    $data2 = [
      'image_url' => null,
      'sent_at' => time(),
      'is_read' => 0
    ];

    $data = array_merge($data, $data2);

    $query = loadClass('core/db')->smartInsert('members_messages', $data);

    return $query;
  }

  /**
   * Marca un mensaje como leído.
   *
   * @param int $message_id ID del mensaje a marcar como leído.
   * @return boolean True si se marcó con éxito, False en caso contrario.
   */
  public function markAsRead($message_id)
  {
    $query = $this->db->query("UPDATE `members_messages` SET `is_read` = 1 WHERE `id` = $message_id");

    return $query ? true : false;
  }

  /**
   * Devuelve los mensajes no leídos para un usuario específico.
   *
   * @param int $to_member_id ID del destinatario.
   * @return array|boolean Los mensajes no leídos, o false si no hay.
   */
  public function getUnreadMessages($to_member_id)
  {
    $query = $this->db->query("SELECT * FROM `members_messages` WHERE `to_member_id` = $to_member_id AND `is_read` = 0 ORDER BY `sent_at` ASC");

    if ($query == true && $query->num_rows > 0)
    {
      $messages = array();
      while ($row = $query->fetch_assoc())
      {
        $messages[] = $row;
      }
      return $messages;
    }
    else
    {
      return false;
    }
  }

  /**
   * Devuelve un mensaje por id
   * @param int $id Id del mensaje
   * @return array|boolean El mensaje o false si no existe
   */
  public function getMessageById($id)
  {
    if ($message = loadClass('core/db')->getColumns('members_messages', ['id', 'from_member_id', 'to_member_id', 'content', 'image_url', 'sent_at', 'is_read'], ['id', $id]))
    {
      $message['sent_at'] = date('m-d H:i', $message['sent_at']);
      return $message;
    }
    return false;
  }

  /**
   * Devuelve los nuevos mensajes entre dos usuarios desde un mensaje específico
   * @param array $data Debe contener los siguientes campos:
   *  - from_member_id: id del usuario que envía el mensaje
   *  - to_member_id: id del usuario que recibe el mensaje
   *  - lastMessageId: id del último mensaje cargado
   * @return array|boolean Los nuevos mensajes o false si no hay
   */
  function getNewMessages($data)
  {
    // Suponiendo que $db es la conexión a la base de datos
    $query = $this->db->query('SELECT * FROM members_messages WHERE id > ' . $data['lastMessageId'] . '  AND ((`from_member_id` = ' . $data['from_member_id'] . ' AND `to_member_id` = ' . $data['to_member_id'] . ') OR (`from_member_id` = ' . $data['to_member_id'] . ' AND `to_member_id` = ' . $data['from_member_id'] . ')) ORDER BY sent_at ASC');

    if ($query)
    {
      $data['rows'] = $query->num_rows;

      if ($data['rows'] > 0)
      {
        while ($row = $query->fetch_assoc())
        {
          $row['sent_at'] = loadClass('core/date')->getFormattedDate($row['sent_at']);
          $data['data'][] = $row;
        }
      }
      return $data;
    }
    return ['rows' => 0];
  }
}
