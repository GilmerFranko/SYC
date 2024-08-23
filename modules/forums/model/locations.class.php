<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los threads (temas)
 *
 */
class locations extends Model
{
  public function getLocationsByContactId($contactId)
  {
    $query = $this->db->query("SELECT * FROM f_locations WHERE contact_id = " . $contactId . " ORDER BY name ASC");
    $data['rows'] = $query->num_rows;
    if ($query and $data['rows'] > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
    }
    return $data;
  }

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

  public function getLocationById($location_id): array
  {
    return getColumns('f_locations', ['id', 'name', 'short_url', 'description', 'status', 'contact_id'], array('id', $location_id));
  }
}
