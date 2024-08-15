<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de gestionar los canales de mensajeria
 *
 */
class Channels extends Model
{
    /**
     * @Description Obtiene una lista con todos los canales de mensajeria
     * @return array|false Un array con los canales o false en caso de error
     */
    public function getChannels()
    {
        $query = "SELECT * FROM `globals_channels`";
        $result = $this->db->query($query);

        if ($result && $result->num_rows > 0)
        {
            $channels = array();
            while ($row = $result->fetch_assoc())
            {
                $channels[] = $row;
            }
            return $channels;
        }
        else
        {
            return false;
        }
    }

    /**
     * @Description Obtiene un canal de mensajeria
     * @param int $id ID del canal
     * @return array|false Un array con el canal o false en caso de error
     */
    public function getChannel($id)
    {
        $query = "SELECT * FROM `globals_messages_channels` WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return false;
        }
    }


    /**
     * @Description Verifica si existe un canal
     * @param int $id ID del canal
     * @return boolean True si existe, false si no existe
     */
    public function isChannelExist($id)
    {
        $query = "SELECT COUNT(*) AS count FROM `globals_messages_channels` WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0)
        {
            $data = $result->fetch_assoc();

            if ($data['count'] > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * @Description Crea un nuevo canal de mensajeria
     * @param string $name Nombre del canal
     * @return int|false ID del canal creado o false en caso de error
     */
    public function createChannel($name)
    {
        $query = "INSERT INTO `globals_channels` (`name`) VALUES ('" . $name . "')";
        $result = $this->db->query($query);

        if ($result)
        {
            return $this->db->insert_id;
        }
        else
        {
            return false;
        }
    }

    /**
     * @Description Elimina un canal de mensajeria
     * @param int $id ID del canal
     * @return boolean True si se elimina correctamente, false en caso de error
     */
    public function deleteChannel($id)
    {
        $query = "DELETE FROM `globals_channels` WHERE `id` = " . $id;
        $result = $this->db->query($query);

        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
