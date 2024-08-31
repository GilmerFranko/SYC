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

  /**
   * Marca todos los mensajes de un usuario como leídos
   * @param int $to_member_id ID del usuario que los recibió
   * @return boolean True si se actualizaron correctamente, false en caso contrario
   */
  public function markAllAsRead($to_member_id)
  {
    return $this->db->query("UPDATE members_messages SET is_read = 1 WHERE to_member_id = $to_member_id");
  }



  /**
   * Devuelve las conversaciones del usuario, ordenadas por la fecha del último mensaje.
   *
   * @param int $member_id ID del usuario.
   * @return array Las conversaciones del usuario, o false si no hay.
   */
  public function getConversations($member_id)
  {
    // Ejecuta una consulta SQL para obtener el último mensaje de cada conversación en la que el usuario está involucrado
    $query = $this->db->query("SELECT m1.*, m3.member_id AS opposite_member_id, m3.name AS opposite_member_name, m3.pp_main_photo AS opposite_member_photo
        FROM members_messages m1
        -- Une con la subconsulta que obtiene el último mensaje por chat
        INNER JOIN (
            -- Subconsulta para obtener el último mensaje de cada conversación
            SELECT 
                -- Identifica el chat usando el menor ID para asegurar consistencia en el par de usuarios
                LEAST(from_member_id, to_member_id) AS member1,
                -- Identifica el otro usuario en la conversación usando el mayor ID
                GREATEST(from_member_id, to_member_id) AS member2,
                -- Optiene el usuario que no soy yo
                IF(from_member_id = $member_id, to_member_id, from_member_id) AS other_user_id,
                -- Obtiene la fecha y hora del último mensaje en la conversación
                MAX(sent_at) AS last_sent_at
            FROM members_messages
            -- Filtra las conversaciones en las que el usuario está involucrado
            WHERE from_member_id = $member_id OR to_member_id = $member_id
            -- Agrupa por el chat y el otro usuario para encontrar el último mensaje en cada conversación
            GROUP BY member1, member2
        ) m2
        -- Une la tabla original con la subconsulta basada en los identificadores del chat y la fecha del último mensaje
        ON LEAST(m1.from_member_id, m1.to_member_id) = m2.member1
        AND GREATEST(m1.from_member_id, m1.to_member_id) = m2.member2
        AND m1.sent_at = m2.last_sent_at
        -- Une con la tabla members para obtener la información del otro usuario
        INNER JOIN members m3
        ON m2.other_user_id = m3.member_id
        
        ORDER BY sent_at DESC
        ");

    error_log("SELECT m1.*, m3.member_id AS opposite_member_id, m3.name AS opposite_member_name, m3.pp_main_photo AS opposite_member_photo
        FROM members_messages m1
        -- Une con la subconsulta que obtiene el último mensaje por chat
        INNER JOIN (
            -- Subconsulta para obtener el último mensaje de cada conversación
            SELECT 
                -- Identifica el chat usando el menor ID para asegurar consistencia en el par de usuarios
                LEAST(from_member_id, to_member_id) AS member1,
                -- Identifica el otro usuario en la conversación usando el mayor ID
                GREATEST(from_member_id, to_member_id) AS member2,
                -- Optiene el usuario que no soy yo
                IF(from_member_id = 2, to_member_id, from_member_id) AS other_user_id,
                -- Obtiene la fecha y hora del último mensaje en la conversación
                MAX(sent_at) AS last_sent_at
            FROM members_messages
            -- Filtra las conversaciones en las que el usuario está involucrado
            WHERE from_member_id = 2 OR to_member_id = 2
            -- Agrupa por el chat y el otro usuario para encontrar el último mensaje en cada conversación
            GROUP BY member1, member2
        ) m2
        -- Une la tabla original con la subconsulta basada en los identificadores del chat y la fecha del último mensaje
        ON LEAST(m1.from_member_id, m1.to_member_id) = m2.member1
        AND GREATEST(m1.from_member_id, m1.to_member_id) = m2.member2
        AND m1.sent_at = m2.last_sent_at
        -- Une con la tabla members para obtener la información del otro usuario
        INNER JOIN members m3
        ON m2.other_user_id = m3.member_id;
        
        ORDER BY sent_at DESC
        ");



    if ($query)
    {
      $conversations['rows'] = $query->num_rows;
      if ($query && $conversations['rows'] > 0)
      {

        while ($row = $query->fetch_assoc())
        {
          $conversations['data'][] = $row;
        }
        return $conversations;
      }
      else
      {
        return false;
      }
    }
    return ['rows' => 0];
  }
}
