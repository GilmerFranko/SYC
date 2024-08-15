<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de manipular la base de datos de los mensajes globales, enviar, ver, eliminar y actualizar los datos, tambien otras funciones que creas necesario como subir archivos etc.
 *
 */
class Messages extends Model
{
    /**
     * @Description Obtiene una lista de mensajes de un canal especifico
     * @param array $options Opciones de paginación
     * @return array|false Un array con los mensajes o false en caso de error
     */
    public function getMessages(int $channel, int $limit = 10, $maxID = 0)
    {
        $query = 'SELECT * FROM `globals_messages` WHERE `channel_id` = ' . $channel . ' AND `id` > ' . $maxID . ' ORDER BY id DESC LIMIT ' . $limit . '';
        //rror_log($query);
        $result = $this->db->query($query);

        if ($result and $result->num_rows > 0)
        {
            $messages = array();
            while ($row = $result->fetch_assoc())
            {
                $row['member'] = loadClass('members/member')->getMemberFromID($row['member_id']);
                $row['sent_at'] = date('m-d H:i', $row['sent_at']);
                $messages[] = $row;
            }
            /* Invertir array */
            $messages = array_reverse($messages);
            return $messages;
        }
        else
        {
            return false;
        }
    }

    /**
     * @Description Guarda un mensaje global
     * @param array $data Datos del mensaje
     * @return int|false ID del mensaje o false en caso de error
     */
    public function sendMessage($channel_id, $member_id, $content)
    {
        $time = time();

        $content = $this->filterMessage($content);

        $query = 'INSERT INTO `globals_messages` (`channel_id`, `member_id`, `content`, `sent_at`) VALUES (?, ?, ?, ' . $time . ')';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iis', $channel_id, $member_id, $content);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if ($result)
        {
            $insert_id = $this->db->insert_id;

            // Devuelve mensaje insertado
            return $this->getMessageByID($insert_id);
        }
        else
        {
            return false;
        }
    }

    /**
     * @Description Actualiza un mensaje global
     * @param int $id ID del mensaje
     * @param array $data Datos del mensaje
     * @return boolean True si se actualiza correctamente, false en caso de error
     */
    public function updateMessage($id, $data)
    {
        return false;
    }

    /**
     * @Description Elimina un mensaje global
     * @param int $id ID del mensaje
     * @return boolean True si se elimina correctamente, false en caso de error
     */
    public function deleteMessage($id)
    {
        return false;
    }


    /**
     * @Description Obtiene un mensaje por su ID
     * @param int $id ID del mensaje
     * @return array|false Array con la información del mensaje o false si falla
     */
    public function getMessageById($id)
    {
        $query = "SELECT * FROM `globals_messages` WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0)
        {
            $data = $result->fetch_assoc();
            $data['member'] = loadClass('members/member')->getMemberFromID($data['member_id']);
            $data['sent_at'] = date('m-d H:i', $data['sent_at']);
            return $data;
        }
        else
        {
            return false;
        }
    }
    /**
     * @Description Filtra un mensaje para evitar inyecciones de codigo y reemplazar salto de linea por <br>
     * @param string $msg Mensaje a filtrar
     * @return string Mensaje filtrado
     */
    public function filterMessage($msg)
    {
        // Escapar caracteres html
        $msg = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');

        $msg = str_replace(htmlentities('\n'), "<br>", $msg);

        // Eliminar etiquetas html y php
        $msg = preg_replace('/<\?(php.*?)\?>/si', '', $msg);

        return $msg;
    }

    /**
     * Sube el contenido a la mensajería
     *
     * @param array    $content
     * @param integer  $channel_id
     * @return array with string and integer values
     */
    function uploadFileInChannel(array $content, int $channel_id, int $member_id)
    {
        /** Verificar que se haya proporcionado contenido */
        if (empty($content))
        {
            return array('No se proporcionó contenido', 'error');
        }

        /** Verificar el tipo de contenido (aquí asumo que el contenido es un archivo) */
        if (!isset($content['type']) || !in_array($content['type'], array('image/jpeg', 'image/png', 'application/pdf')))
        {
            return array('Tipo de contenido no permitido', 'error');
        }

        /** Crear una ruta para almacenar el contenido */
        $content_path = $this->config['channels_path'] . DS . 'ID-' . $channel_id;

        /** Crear el directorio si no existe */
        if (!file_exists($content_path))
        {
            mkdir($content_path, 0777, true);
        }

        /** Obtener la extensión del archivo */
        $extension = pathinfo($content['name'], PATHINFO_EXTENSION);

        /** Generar un nombre único para el archivo */
        $filename = uniqid() . '.' . $extension;

        /** Mover el archivo al directorio de contenido */
        if (move_uploaded_file($content['tmp_name'], $content_path . DS . $filename))
        {

            if ($this->createImageMessage($channel_id, $member_id, $filename))
            {
                return array('Contenido subido correctamente', 'success');
            }
            return array('No se pudo subir el contenido', 'error');
        }
        else
        {
            return array('No se pudo subir el contenido', 'error');
        }
    }

    /**
     * Crea un nuevo mensaje para un canal
     *
     * @param int $channel_id ID .
     * @param int $member_id ID del usuario que envía el mensaje.
     * @param string $image_url Url de la imagen.
     * @return int|false ID del mensaje creado o false si falla.
     */
    public function createImageMessage($channel_id, $member_id, $imageUrl)
    {
        $time = time();
        $imageUrl = escape($imageUrl, $this->db);

        $query = "INSERT INTO globals_messages (member_id, channel_id, image_url, sent_at) VALUES ($member_id, $channel_id, '$imageUrl', $time)";

        if ($this->db->query($query))
        {
            $message_id = $this->db->insert_id;

            return $this->getMessageById($message_id);
        }
        else
        {
            return false;
        }
    }
}
