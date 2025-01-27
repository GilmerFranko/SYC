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
class subforums extends Model
{
  public function getSubforumsByForumId($contactId)
  {
    $query = $this->db->query("SELECT * FROM f_subforums WHERE forum_id = " . $contactId . " ORDER BY name ASC");
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
  public function getAllSubforums()
  {
    $query = $this->db->query('SELECT l.*, c.name AS forum_name FROM `f_subforums` AS l INNER JOIN `f_forums` AS c ON l.`forum_id` = c.`id` WHERE l.`status` = 1 ORDER BY `id` DESC');

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

  public function getSubforumById($subforum_id): array
  {
    return getColumns('f_subforums', ['id', 'name', 'short_url', 'description', 'status', 'forum_id'], array('id', $subforum_id));
  }


  /**
   * @Description Verifica si un miembro ya visitó una ubicación en una fecha específica.
   * @param int $subforum_id
   * @param int $member_id
   * @return bool True si ya visitó, False si no.
   */
  public function checkVisit($subforum_id, $member_id)
  {
    $query = $this->db->query("
      SELECT id 
      FROM f_subforums_visits 
      WHERE subforum_id = " . (int)$subforum_id . " 
      AND member_id = " . (int)$member_id . "
      AND DATE(visit_date) = CURDATE()
    ");

    return $query->num_rows > 0;
  }

  /**
   * @Description Registra la visita de un miembro a una ubicación (foro).
   * @param int $subforum_id
   * @param int $member_id
   * @param string $ipaddress Dirección IP del visitante
   * @return bool True si la visita fue registrada correctamente
   */
  public function registerVisit($subforum_id, $member_id, $ipaddress)
  {
    // Verificar si ya visitó hoy
    if ($this->checkVisit($subforum_id, $member_id))
    {
      return false; // Ya visitó hoy, no registrar de nuevo
    }

    // Registrar la visita
    $query = $this->db->query("
      INSERT INTO f_subforums_visits (subforum_id, member_id, ipaddress, visit_date) 
      VALUES (" . (int)$subforum_id . ", " . (int)$member_id . ", '" . $this->db->real_escape_string($ipaddress) . "', NOW())
    ");

    return $query;
  }


  public function getMostVisitedSubforums($limit = 50)
  {
    // Consulta para obtener los foros más visitados, incluyendo la información de la sección (f_forums)
    $query = $this->db->query(
      "
        SELECT 
            l.id, 
            l.name, 
            l.short_url, 
            l.description, 
            l.status, 
            l.forum_id, 
            c.name AS forum_name, 
            COUNT(v.id) AS visit_count
        FROM 
            f_subforums AS l
        INNER JOIN 
            f_forums AS c ON l.forum_id = c.id
        LEFT JOIN 
            f_subforums_visits AS v ON l.id = v.subforum_id
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
    return $this->db->query("SELECT id FROM f_subforums WHERE id = " . $forum_id . " AND status = 1")->num_rows > 0;
  }

  /**
   * @Description Obtiene las diez subforos con más hilos creados
   * @return array Un array con las diez subforos con más hilos
   */
  public function getTop10SubforumsWithMostThreads()
  {
    $query = $this->db->query(
      'SELECT
        l.id,
        l.name,
        l.short_url,
        COUNT(t.id) AS total_threads ,
        c.name AS forum_name
       FROM 
        f_subforums AS l 
       LEFT JOIN 
        f_threads AS t ON l.id = t.subforum_id 
       INNER JOIN 
        f_forums AS c ON l.forum_id = c.id
       WHERE 
        l.status = 1
       GROUP BY l.id 
       ORDER BY total_threads DESC 
       LIMIT 10'
    );

    $data = [];
    if ($query && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data[] = $row;
      }
    }

    return $data;
  }
}
