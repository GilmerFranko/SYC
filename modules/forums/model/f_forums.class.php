<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los foros (temas)
 *
 */
class f_forums extends Model
{

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
   * Devuelve un foro por su id.
   *
   * @param int $id El id del foro a obtener.
   * @return array|boolean El foro con el id especificado, o false si no existe.
   */
  public function getForumById($id)
  {
    return getColumns('f_forums', ['id', 'name', 'short_url', 'status', 'priority', 'visibility'], array('id', $id), 1);
  }
}
