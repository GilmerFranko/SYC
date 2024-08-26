<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los contactos (temas)
 *
 */
class f_contacts extends Model
{

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
   * Devuelve un contacto por su id.
   *
   * @param int $id El id del contacto a obtener.
   * @return array|boolean El contacto con el id especificado, o false si no existe.
   */
  public function getContactById($id)
  {
    return getColumns('f_contacts', ['id', 'name', 'short_url', 'status', 'priority', 'visibility'], array('id', $id), 1);
  }
}
