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
   * @Description Obtiene todos los foros activos
   * @param int $page El n mero de p gina
   * @return array|boolean Un array con los foros
   */
  public function getAllLocations()
  {
    $query = $this->db->query('SELECT l.*, c.name AS contact_name FROM `f_locations` AS l INNER JOIN `f_contacts` AS c ON l.`contact_id` = c.`id` WHERE l.`status` = 1 ORDER BY `id` DESC');

    $data['rows'] = $query->num_rows;
    // Obtener los resultados de la consulta
    if ($query and $data['rows'] > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
      return $data;
    }
    return $data;
  }

  public function getLocationById($location_id): array
  {
    return getColumns('f_locations', ['id', 'name', 'short_url', 'description', 'status', 'contact_id'], array('id', $location_id));
  }


  /**
   * @Description Verifica si un miembro ya visitó una ubicación en una fecha específica.
   * @param int $location_id
   * @param int $member_id
   * @return bool True si ya visitó, False si no.
   */
  public function checkVisit($location_id, $member_id)
  {
    $query = $this->db->query("
      SELECT id 
      FROM f_locations_visits 
      WHERE location_id = " . (int)$location_id . " 
      AND member_id = " . (int)$member_id . "
      AND DATE(visit_date) = CURDATE()
    ");

    return $query->num_rows > 0;
  }

  /**
   * @Description Registra la visita de un miembro a una ubicación (foro).
   * @param int $location_id
   * @param int $member_id
   * @param string $ipaddress Dirección IP del visitante
   * @return bool True si la visita fue registrada correctamente
   */
  public function registerVisit($location_id, $member_id, $ipaddress)
  {
    // Verificar si ya visitó hoy
    if ($this->checkVisit($location_id, $member_id))
    {
      return false; // Ya visitó hoy, no registrar de nuevo
    }

    // Registrar la visita
    $query = $this->db->query("
      INSERT INTO f_locations_visits (location_id, member_id, ipaddress, visit_date) 
      VALUES (" . (int)$location_id . ", " . (int)$member_id . ", '" . $this->db->real_escape_string($ipaddress) . "', NOW())
    ");

    return $query;
  }


  public function getMostVisitedLocations($limit = 50)
  {
    // Consulta para obtener los foros más visitados, incluyendo la información de la sección (f_contacts)
    $query = $this->db->query(
      "
        SELECT 
            l.id, 
            l.name, 
            l.short_url, 
            l.description, 
            l.status, 
            l.contact_id, 
            c.name AS contact_name, 
            COUNT(v.id) AS visit_count
        FROM 
            f_locations AS l
        INNER JOIN 
            f_contacts AS c ON l.contact_id = c.id
        LEFT JOIN 
            f_locations_visits AS v ON l.id = v.location_id
        GROUP BY 
            l.id
        ORDER BY 
            visit_count DESC
        LIMIT " . (int)$limit
    );

    $data = [];
    if ($query && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
    }

    return $data;
  }

  public function isActive($forum_id)
  {
    return $this->db->query("SELECT id FROM f_locations WHERE id = " . $forum_id . " AND status = 1")->num_rows > 0;
  }
}
