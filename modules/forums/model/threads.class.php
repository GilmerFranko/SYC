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
class threads extends Model
{
  /**
   * Inserta un nuevo thread en la base de datos
   *
   * @param int $location_id
   * @param int $member_id
   * @param string $title
   * @param string $content
   * @param string $status
   * @param int $views_count
   * @param int $replies_count
   * @param int $likes_count
   * @param int $count_favorites
   * @param string $ip_address
   * @param int $is_edited
   * @param int $last_edited_by
   * @param int $report_count
   * @param string $created_at
   * @param string $updated_at
   *
   * @return bool
   */
  public function createThread($location_id, $member_id, $title, $content, $status, $views_count, $replies_count, $likes_count, $count_favorites, $ip_address, $is_edited, $last_edited_by, $report_count, $created_at, $updated_at)
  {
    $data = [
      'location_id' => $location_id,
      'member_id' => $member_id,
      'title' => $title,
      'content' => $content,
      'status' => $status,
      'views_count' => $views_count,
      'replies_count' => $replies_count,
      'likes_count' => $likes_count,
      'count_favorites' => $count_favorites,
      'ip_address' => $ip_address,
      'is_edited' => $is_edited,
      'last_edited_by' => $last_edited_by,
      'report_count' => $report_count,
      'created_at' => $created_at,
      'updated_at' => $updated_at
    ];

    if ($r = loadClass('db')->smartInsert('f_threads', $data))
    {
      return $r;
    }
    return false;
  }

  /**
   * Obtiene un thread por su ID
   *
   * @param int $id
   * @return array
   */
  public function getThreadById($id)
  {
  }

  /**
   * Actualiza un thread en la base de datos
   *
   * @param int $id
   * @param array $data
   * @return bool
   */
  public function updateThread($id, $data)
  {
  }

  /**
   * Elimina un thread por su ID
   *
   * @param int $id
   * @return bool
   */
  public function deleteThread($id)
  {
  }

  /**
   * Obtiene la cantidad de todos los threads de una ubicación (location)
   *
   * @param int $location_id
   * @return int
   */
  public function getCountThreadsByLocationId($location_id)
  {
    return loadClass('core/db')->getCount('f_threads', 'id', ['location_id', $location_id]);
  }
}
