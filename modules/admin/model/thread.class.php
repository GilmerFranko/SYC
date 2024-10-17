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
class thread extends Model
{

  public function getAllThreads($params = [], $section = 'threads', $limit = 20)
  {
    $where = [];

    // Filtrar por categoría (contact_id)
    if (!empty($params['contact_id']))
    {
      $where[] = 'l.`contact_id` = "' . $this->db->real_escape_string($params['contact_id']) . '"';
    }

    // Filtrar por ubicación (location_id)
    if (!empty($params['location_id']))
    {
      $where[] = 't.`location_id` = "' . $this->db->real_escape_string($params['location_id']) . '"';
    }

    // Filtrar por palabras clave (en el título o contenido)
    if (!empty($params['search']))
    {
      $search = $this->db->real_escape_string($params['search']);
      $where[] = '(t.`title` LIKE "%' . $search . '%" OR t.`content` LIKE "%' . $search . '%")';
    }

    if (!empty($params['threads_spam']))
    {
      $where[] = 't.`status` = 0';
    }

    if (!empty($params['only_active']))
    {
      $where[] = 't.`status` = 1';
    }


    // Ordenar por fecha (ascendente o descendente)
    $order_by = !empty($params['order_by']) && in_array($params['order_by'], ['asc', 'desc'])
      ? $params['order_by']
      : 'desc';

    // Construir la cláusula WHERE
    $where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    // Consulta para obtener el total de resultados (sin límite de paginación)
    $total_query = $this->db->query(
      'SELECT COUNT(*) 
        FROM `f_threads` AS t
        INNER JOIN `members` AS m ON t.`member_id` = m.`member_id`
        INNER JOIN `f_locations` AS l ON t.`location_id` = l.`id`
        INNER JOIN `f_contacts` AS c ON l.`contact_id` = c.`id`
        ' . $where_clause
    );

    error_log('SELECT COUNT(*) 
        FROM `f_threads` AS t
        INNER JOIN `members` AS m ON t.`member_id` = m.`member_id`
        INNER JOIN `f_locations` AS l ON t.`location_id` = l.`id`
        INNER JOIN `f_contacts` AS c ON l.`contact_id` = c.`id`
        ' . $where_clause);
    list($data['total']) = $total_query->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', $section, null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT 
            t.*,
            c.`id` AS contact_id,
            c.`name` AS contact_name,
            l.`id` AS location_id,
            l.`name` AS location_name,
            m.`name` AS member_name,
            m.`member_id` AS member_id
        FROM 
            `f_threads` AS t
        INNER JOIN 
            `members` AS m ON t.`member_id` = m.`member_id`
        INNER JOIN 
            `f_locations` AS l ON t.`location_id` = l.`id`
        INNER JOIN 
            `f_contacts` AS c ON l.`contact_id` = c.`id`
        ' . $where_clause . '
        ORDER BY 
            t.`created_at` ' . $order_by . ' 
        LIMIT ' . $data['pages']['limit']
    );

    $data['rows'] = $query->num_rows;

    // Obtener los resultados de la consulta
    if ($query && $data['rows'] > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
    }

    return $data;
  }

  public function getAllThreadsWithSpam($params = [])
  {
    return $this->getAllThreads($params, 't_with_spams');
  }

  /**
   * Obtiene un thread por su ID o Slug dependiendo de la variable $isSlug
   *
   * @param int|string $identifier
   * @param int $member_id
   * @param bool $isSlug
   * @return boolean|array
   */
  public function getThreadById($identifier, $isSlug = false)
  {
    // Determinar la columna a buscar
    $column = $isSlug ? 't.`slug`' : 't.`id`';

    // Escapar adecuadamente las variables
    $escapedIdentifier = $this->db->real_escape_string($identifier);

    // Construir la consulta con la lógica condicional
    $query = $this->db->query(
      'SELECT 
        t.*,
        c.`name` AS contact_name,
        l.`name` AS location_name,
        m.`member_id` AS member_id,
        m.`name` AS member_name,
        m.`pp_thumb_photo` AS member_pp
      FROM 
          `f_threads` AS t
      INNER JOIN 
          `members` AS m ON t.`member_id` = m.`member_id`
      INNER JOIN 
          `f_locations` AS l ON t.`location_id` = l.`id`
      INNER JOIN 
          `f_contacts` AS c ON l.`contact_id` = c.`id`
      WHERE 
          ' . $column . ' = "' . $escapedIdentifier . '"'
    );

    // Procesar el resultado
    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return false;
  }


  /**
   * Obtiene el numero total de hilos que estan en estado 0
   * 
   * @return int
   */
  public function getTotalThreadsStatusZero()
  {
    return $this->db->query('SELECT COUNT(*) AS total FROM `f_threads` WHERE `status` = 0')->fetch_assoc()['total'];
  }


  /**
   * Activa un hilo
   * 
   * @param int $thread_id
   * @return boolean
   */
  public function activateThread($thread_id)
  {
    $query = $this->db->query('UPDATE `f_threads` SET `status` = 1 WHERE `id` = ' . $this->db->real_escape_string($thread_id));
    if ($query)
    {
      return true;
    }
    return false;
  }


  /**
   * Destaca (renueva) un hilo
   * 
   * @param int $thread_id ID del hilo
   * @param int $status 0 para desactivar y 1 para activar
   * @return boolean
   */
  public function manualRenew($thread_id): bool
  {
    $stmt = $this->db->prepare("UPDATE f_threads SET position = UNIX_TIMESTAMP() WHERE id = ?");
    $stmt->bind_param('i', $thread_id);
    $stmt->execute();
    return $stmt->affected_rows > 0 ? true : false;
  }
}
