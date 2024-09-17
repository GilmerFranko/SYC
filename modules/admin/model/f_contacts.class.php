<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los contactos
 *
 *
 */
class f_contacts extends Model
{

  public function getContactById($contact_id)
  {
    return getColumns('f_contacts', ['id', 'name', 'short_url', 'image', 'status', 'priority', 'visibility'], array('id', $contact_id), 1);
  }

  /**
   * Devuelve todos los contactos de la tabla contacts como un array.
   *
   * @return array|boolean Los contactos de la tabla contacts.
   */
  public function getAllContacts()
  {
    $query = $this->db->query('SELECT * FROM `f_contacts`');
    $contacts = array();

    $contacts['rows'] = $query->num_rows;
    if ($query == true && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $contacts['data'][] = $row;
      }
      return $contacts;
    }
    else
    {
      return false;
    }
  }

  /**
   * Crea un nuevo registro en la tabla contacts con los datos proporcionados.
   *
   * @param array $data Los datos del nuevo registro. Debe contener al menos los campos name, short_url, status, priority y visibility.
   * @return int El ID del nuevo registro insertado, o false si no se pudo insertar.
   */
  public function newContact($data)
  {
    $query = $this->db->query('INSERT INTO `f_contacts` (`name`, `short_url`, `image`, `status`, `visibility`, `created_at`, `updated_at`) VALUES (\'' . $data['name'] . '\', \'' . $data['short_url'] . '\', \'' . $data['image'] . '\', \'' . $data['status'] . '\', \'' . $data['visibility'] . '\', UNIX_TIMESTAMP(), UNIX_TIMESTAMP())');

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
   * Actualiza un registro en la tabla contacts con los datos proporcionados.
   *
   * @param int $id El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro. Debe contener los campos name, short_url, status, priority y visibility.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateForum($id, $data)
  {
    $query = $this->db->query('UPDATE `f_contacts` SET `name`=\'' . $data['name'] . '\', `short_url`=\'' . $data['short_url'] . '\', `status`=\'' . $data['status'] . '\', `priority`=\'' . $data['priority'] . '\', `visibility`=\'' . $data['visibility'] . '\', `updated_at`=UNIX_TIMESTAMP() WHERE `id`=' . $id);

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
   * Actualiza un registro en la tabla contacts con los datos proporcionados.
   *
   * @param int $id El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro. Debe contener los campos name, short_url, image, status y visibility.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateContact($contact_id, $data)
  {
    $query = loadClass('core/db')->smartInsert('f_contacts', $data, ['id', $contact_id]);

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
   * Actualiza la imagen de un contacto en la base de datos.
   *
   * @param int $contact_id El ID del contacto a actualizar.
   * @param array $image La imagen a subir.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateImage($contact_id, $image)
  {
    global $config;

    // Elimina la imagen antig del contacto
    $image_contact = loadClass('core/db')->getColumns('f_contacts', array('image'), array('id', $contact_id));

    if (loadClass('core/extra')->deleteImage($image_contact['image'], $config['contacts_path']))
    {
      $upload = loadClass('core/extra')->uploadImage($image, $config['contacts_path']);

      if ($upload != false)
      {
        $query = loadClass('core/db')->smartInsert('f_contacts', ['image' => $upload], ['id', $contact_id]);

        if ($query == true)
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
    return false;
  }

  /**
   * Comprueba si existe un contacto en la base de datos con el nombre y el email proporcionados.
   *
   * @param string $name Nombre del contacto.
   * @param string $email Email del contacto.
   * @return boolean Devuelve true si existe el contacto, false en caso contrario.
   */
  public function existContact($id)
  {
    $contact = loadClass('core/db')->getColumns('f_contacts', array('id'), array('id', $id), 1, true);
    if ($contact !== false)
    {
      return true;
    }
    return false;
  }


  /**
   * Comprueba si existe un contacto en la base de datos con el id proporcionado y los datos son diferentes.
   *
   * @param int $id Id del contacto.
   * @param array $data Array con los datos nuevos del contacto.
   * @return array Devuelve true si existe el contacto, false en caso contrario.
   */
  public function existContactWithDifferentData($id, $data)
  {
    $contact = loadClass('core/db')->getColumns('f_contacts', array('id'), array('id', $id), 1, true);

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
          return ['status' => false, 'msg' => 'Ya existe un contacto la misma URL corta'];
        }
      }

      return ['status' => false, 'msg' => 'Ya existe un contacto con el mismo nombre'];
    }
    else
    {
      return ['status' => false, 'msg' => 'No existe el contacto'];
    }
  }

  /**
   * Elimina un contacto de la base de datos.
   *
   * @param int $id El ID del contacto a eliminar.
   * @return bool true si se elimino correctamente, false en caso contrario.
   */
  public function deleteContact($id)
  {
    $query = $this->db->query('DELETE FROM `f_contacts` WHERE `id`=' . $id);
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
