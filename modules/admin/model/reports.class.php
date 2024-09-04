<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Esta clase se encarga de gestionar lo relacionado con los reportes de hilos
 *
 */
class reports extends Model
{
  /**
   * Inserta un nuevo reporte en la base de datos
   *
   * @param array $data
   * @return bool|int
   */
  public function newReport(array $data)
  {
    $data = array_merge($data, [
      'created_at' => time(),
      'status' => 1,  // 1 para activo, 0 para inactivo
    ]);

    return loadClass('core/db')->smartInsert('f_threads_reports', $data);
  }

  /**
   * Obtiene todos los reportes agrupados por hilo
   *
   * @param int $thread_id
   * @param int $page
   * @param int $limit
   * @return array|bool
   */
  public function getReportsByThreadId($thread_id, $page = 1, $limit = 20)
  {
    $offset = ($page - 1) * $limit;

    $query = $this->db->query(
      'SELECT
        r.*,
        t.`id` AS thread_id,
        t.`title` AS thread_title,
        m.`member_id` AS member_id,
        m.`name` AS member_name
      FROM 
        `f_threads_reports` AS r
      INNER JOIN 
        `f_threads` AS t ON r.`thread_id` = t.`id`
      INNER JOIN 
        `members` AS m ON t.`member_id` = m.`member_id`
      WHERE
        r.`thread_id` = "' . $this->db->real_escape_string($thread_id) . '"
      LIMIT ' . $offset . ', ' . $limit
    );


    $total = $this->db->query('SELECT COUNT(*) FROM `f_threads_reports` AS r WHERE r.`thread_id` = "' . $this->db->real_escape_string($thread_id) . '"')->fetch_assoc()['COUNT(*)'];

    if ($query)
    {
      $data['rows'] = $query->num_rows;

      if ($query->num_rows > 0)
      {
        while ($row = $query->fetch_assoc())
        {
          $data['data'][] = $row;
        }
      }
      // Paginador
      $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', 'reports', null, null), $total, $limit);

      return $data;
    }
    return ['rows' => 0];
  }

  /**
   * Obtiene todos los reportes agrupados por hilo
   *
   * @param int $page
   * @param int $limit
   * @return array|bool
   */
  public function getAllReportsGroupByThread($page = 1, $limit = 20)
  {
    $offset = ($page - 1) * $limit;

    $query = $this->db->query(
      'SELECT
        r.*,
        t.`id` AS thread_id,
        t.`title` AS thread_title,
        m.`name` AS member_name,
        count(r.`id`) AS reports_count
      FROM 
        `f_threads_reports` AS r
      INNER JOIN 
        `f_threads` AS t ON r.`thread_id` = t.`id`
      INNER JOIN 
        `members` AS m ON t.`member_id` = m.`member_id`
      GROUP BY 
        r.`thread_id`
      ORDER BY 
        reports_count DESC
      LIMIT ' . $offset . ', ' . $limit
    );


    $total = $this->db->query('SELECT COUNT(*) FROM `f_threads_reports` AS r GROUP BY r.`thread_id`')->fetch_assoc()['COUNT(*)'];

    if ($query)
    {
      $data['rows'] = $query->num_rows;

      if ($query->num_rows > 0)
      {
        while ($row = $query->fetch_assoc())
        {
          $data['data'][] = $row;
        }
      }
      // Paginador
      $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', 'reports', null, null), $data['rows'], $limit);

      return $data;
    }
    return ['rows' => 0];
  }


  /**
   * Obtiene un reporte por su ID
   *
   * @param int $report_id
   * @return array|bool
   */
  public function getReportById($report_id)
  {
    $query = $this->db->query(
      'SELECT 
                r.*, 
                m.`name` AS member_name, 
                t.`title` AS thread_title 
            FROM 
                `f_threads_reports` AS r
            INNER JOIN 
                `members` AS m ON r.`member_id` = m.`member_id`
            INNER JOIN 
                `f_threads` AS t ON r.`thread_id` = t.`id`
            WHERE 
                r.`id` = "' . $this->db->real_escape_string($report_id) . '"'
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return false;
  }

  /**
   * Actualiza un reporte en la base de datos
   *
   * @param int $report_id
   * @param array $data
   * @return bool
   */
  public function updateReport($report_id, array $data)
  {
    $data = array_merge($data, [
      'updated_at' => time()
    ]);

    return loadClass('core/db')->smartInsert('f_threads_reports', $data, ['id', $report_id]);
  }

  /**
   * Elimina un reporte por su ID
   *
   * @param int $report_id
   * @return bool
   */
  public function deleteReport($report_id)
  {
    $query = $this->db->query(
      'DELETE FROM `f_threads_reports` 
             WHERE `id` = "' . $this->db->real_escape_string($report_id) . '" 
             LIMIT 1'
    );

    return $query ? true : false;
  }

  /**
   * Obtiene la cantidad de reportes por hilo
   *
   * @param int $thread_id
   * @return int
   */
  public function getCountReportsByThreadId($thread_id)
  {
    return loadClass('core/db')->getCount('f_threads_reports', 'id', ['thread_id', $thread_id]);
  }
}
