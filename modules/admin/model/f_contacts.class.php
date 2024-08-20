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
}
