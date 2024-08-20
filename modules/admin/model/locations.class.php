<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los foros (locaciones)
 *
 *
 */
class locations extends Model
{


  /**
   * @Description Guarda un nuevo foro
   * @param int $contact_id El ID del contacto donde se va a guardar el foro
   * @param string $name El nombre del foro
   * @param string $description La descripci n del foro
   * @param string $visibility La visibilidad del foro
   * @param string $tags Las etiquetas del foro
   * @param string $status El estatus del foro
   * @return int El ID del nuevo foro
   */
  public function newLocation($data)
  {
    if ($last_id = loadClass('core/db')->smartInsert('f_locations', $data))
    {
      return $last_id;
    }
    else
    {
      return false;
    }
  }

  /**
   * @Description Elimina un foro
   * @param int $id El ID del foro
   * @return bool True si se elimin o, false si no
   */
  public function deleteForum($id)
  {
    return $this->db->delete('locations', array('id' => $id));
  }

  /**
   * @Description Verifica si el foro tiene hilos
   * @param int $id El ID del foro
   * @return bool True si tiene hilos, false si no
   */
  public function hasThreads($id)
  {
    return (bool)$this->db->count('threads', array('location_id' => $id));
  }

  /**
   * @Description Obtiene todos los foros
   * @return array Los foros
   */
  public function getAllForums()
  {
    return $this->db->select('locations');
  }

  /**
   * @Description Obtiene el ultimo post de un foro
   * @param int $id El ID del foro
   * @return array El ultimo post del foro
   */
  public function getLastPost($id)
  {
    $where = array(
      'location_id' => $id,
      'ORDER' => array('created_at' => 'DESC'),
      'LIMIT' => 1
    );

    return $this->db->select('posts', $where);
  }
}
