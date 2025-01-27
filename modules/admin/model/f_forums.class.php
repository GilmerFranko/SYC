<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los foros
 *
 *
 */
class f_forums extends Model
{

  public function getForumById($forum_id)
  {
    return getColumns('f_forums', ['id', 'name', 'short_url', 'image', 'status', 'priority', 'visibility'], array('id', $forum_id), 1);
  }

  /**
   * Devuelve todos los foros de la tabla forums como un array.
   *
   * @return array|boolean Los foros de la tabla forums.
   */
  public function getAllForums()
  {
    $query = $this->db->query('SELECT * FROM `f_forums`');
    $forums = array();

    $forums['rows'] = $query->num_rows;
    if ($query == true && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $forums['data'][] = $row;
      }
      return $forums;
    }
    else
    {
      return false;
    }
  }

  /**
   * Crea un nuevo registro en la tabla forums con los datos proporcionados.
   *
   * @param array $data Los datos del nuevo registro. Debe contener al menos los campos name, short_url, status, priority y visibility.
   * @return int El ID del nuevo registro insertado, o false si no se pudo insertar.
   */
  public function newForum($data)
  {
    $query = $this->db->query('INSERT INTO `f_forums` (`name`, `short_url`, `image`, `status`, `visibility`, `created_at`, `updated_at`) VALUES (\'' . $data['name'] . '\', \'' . $data['short_url'] . '\', \'' . $data['image'] . '\', \'' . $data['status'] . '\', \'' . $data['visibility'] . '\', UNIX_TIMESTAMP(), UNIX_TIMESTAMP())');

    if ($query == true)
    {
      return $this->db->insert_id;
    }
    else
    {
      return false;
    }
  }

  /**
   * Actualiza un registro en la tabla forums con los datos proporcionados.
   *
   * @param int $id El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro. Debe contener los campos name, short_url, status, priority y visibility.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateForum1($id, $data)
  {
    $query = $this->db->query('UPDATE `f_forums` SET `name`=\'' . $data['name'] . '\', `short_url`=\'' . $data['short_url'] . '\', `status`=\'' . $data['status'] . '\', `priority`=\'' . $data['priority'] . '\', `visibility`=\'' . $data['visibility'] . '\', `updated_at`=UNIX_TIMESTAMP() WHERE `id`=' . $id);

    if ($query == true)
    {
      return true;
    }
    else
    {
      return false;
    }
  }


  /**
   * Actualiza un registro en la tabla forums con los datos proporcionados.
   *
   * @param int $id El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro. Debe contener los campos name, short_url, image, status y visibility.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateForum($forum_id, $data)
  {
    $query = loadClass('core/db')->smartInsert('f_forums', $data, ['id', $forum_id]);

    if ($query == true)
    {
      return true;
    }
    else
    {
      return false;
    }
  }


  /**
   * Actualiza la imagen de un foro en la base de datos.
   *
   * @param int $forum_id El ID del foro a actualizar.
   * @param array $image La imagen a subir.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateImage($forum_id, $image)
  {
    global $config;

    // Elimina la imagen antig del foro
    $image_contact = loadClass('core/db')->getColumns('f_forums', array('image'), array('id', $forum_id));

    if (loadClass('core/extra')->deleteImage($image_contact['image'], $config['forums_path']))
    {
      $upload = loadClass('core/extra')->uploadImage($image, $config['forums_path']);

      if ($upload != false)
      {
        $query = loadClass('core/db')->smartInsert('f_forums', ['image' => $upload], ['id', $forum_id]);

        if ($query == true)
        {
          return true;
        }
        else
        {
          error_log('Error al actualizar la imagen del foro');
        }
      }
      else
      {
        return false;
      }
    }
    return false;
  }

  /**
   * Comprueba si existe un foro en la base de datos con el nombre y el email proporcionados.
   *
   * @param string $name Nombre del foro.
   * @param string $email Email del foro.
   * @return boolean Devuelve true si existe el foro, false en caso contrario.
   */
  public function existForum($id)
  {
    $contact = loadClass('core/db')->getColumns('f_forums', array('id'), array('id', $id), 1, true);
    if ($contact !== false)
    {
      return true;
    }
    return false;
  }


  /**
   * Comprueba si existe un foro en la base de datos con el id proporcionado y los datos son diferentes.
   *
   * @param int $id Id del foro.
   * @param array $data Array con los datos nuevos del foro.
   * @return array Devuelve true si existe el foro, false en caso contrario.
   */
  public function existForumWithDifferentData($id, $data)
  {
    $contact = loadClass('core/db')->getColumns('f_forums', array('id'), array('id', $id), 1, true);

    if ($contact !== false)
    {
      if ($contact['name'] == $data['name'])
      {
        if ($contact['short_url'] == $data['short_url'])
        {
          return ['status' => true];
        }
        else
        {
          return ['status' => false, 'msg' => 'Ya existe un foro la misma URL corta'];
        }
      }

      return ['status' => false, 'msg' => 'Ya existe un foro con el mismo nombre'];
    }
    else
    {
      return ['status' => false, 'msg' => 'No existe el foro'];
    }
  }

  /**
   * Elimina un foro de la base de datos.
   *
   * @param int $id El ID del foro a eliminar.
   * @return bool true si se elimino correctamente, false en caso contrario.
   */
  public function deleteForum($id)
  {
    $query = $this->db->query('DELETE FROM `f_forums` WHERE `id`=' . $id);
    if ($query == true)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}
