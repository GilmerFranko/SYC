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
   * @Description Obtiene todos los foros
   * @param int $page El n mero de p gina
   * @return array|boolean Un array con los foros
   */
  public function getAllLocations($page = 1, $limit = 10)
  {

    // Calcular el límite inferior y superior 
    $lowerLimit = ($page - 1) * $limit;
    $upperLimit = $limit;

    $query = $this->db->query('SELECT l.*, c.name AS contact_name FROM `f_locations` AS l INNER JOIN `f_contacts` AS c ON l.`contact_id` = c.`id` ORDER BY `id` DESC LIMIT ' . $lowerLimit . ',' . $upperLimit);
    $data['rows'] = $query->num_rows;
    // Obtener los resultados de la consulta
    if ($query and $data['rows'] > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
      // Paginador
      $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', 'views.locations', null, null), $data['rows'], $limit);
      return $data;
    }
    return $data;
  }


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

  public function updateLocation($locationId, $data)
  {
    if ($last_id = loadClass('core/db')->smartInsert('f_locations', $data, ['id', $locationId]))
    {
      return $last_id;
    }
    else
    {
      return false;
    }
  }

  /**
   * @Description Elimina un foro (ubicacion)
   * @param int $id El ID del foro
   * @return bool True si se eliminó, false si no
   */
  public function deleteLocation($id)
  {
    return loadClass('core/db')->deleteRow('f_locations', $id);
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

  public function getLocationById($id)
  {
    return getColumns('f_locations', ['id', 'name', 'short_url', 'description', 'status', 'contact_id'], array('id', $id), 1);
  }

  /**
   * Comprueba si existe una ubicacion en la base de datos con el name pasado.
   *
   */
  public function existsLocationByName($name)
  {
    return loadClass('core/db')->getCount('f_locations', 'id', array('name', $name));
  }

  /**
   * Comprueba si existe una Ubicacion (foro) en la base de datos
   * No se tendrá en cuenta el mismo ID pasado
   */
  public function existsLocation($location_id, $contact_id, $name)
  {
    $query = $this->db->query('SELECT `id` FROM `f_locations` WHERE `id` != ' . $location_id . ' AND `contact_id` = ' . $contact_id . ' AND  `name` = \'' . $name . '\'');
    return $query == true && $query->num_rows > 0;
  }

  /* Comprueba que no exista un short_url igual registrado*/
  public function existsShortUrl($location_id, $short_url)
  {
    $query = $this->db->query('SELECT `id` FROM `f_locations` WHERE `short_url` = \'' . $short_url . '\' AND `id` != ' . $location_id);
    return $query == true && $query->num_rows > 0;
  }
}
