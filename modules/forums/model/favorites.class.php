<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los favoritos de los miembros
 *
 */
class favorites extends Model
{


  /**
   * Devuelve todos los favoritos de la tabla members_favorites como un array.
   *
   * @return array|boolean Los favoritos de la tabla members_favorites.
   */
  public function getAllFavorites()
  {
    $query = $this->db->query('SELECT * FROM `members_favorites`');
    $favorites = array();

    $favorites['rows'] = $query->num_rows;
    if ($query == true && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $favorites['data'][] = $row;
      }
      return $favorites;
    }
    else
    {
      return false;
    }
  }

  /**
   * Devuelve los favoritos de un miembro específico por su ID.
   *
   * @param int $member_id El ID del miembro cuyos favoritos se quieren obtener.
   * @return array|boolean Los favoritos del miembro especificado, o false si no existen.
   */
  public function getFavoritesByMemberId($member_id)
  {
    $query = $this->db->query("SELECT * FROM `members_favorites` WHERE `member_id` = $member_id");
    if ($query == true && $query->num_rows > 0)
    {
      $favorites = array();
      while ($row = $query->fetch_assoc())
      {
        $favorites[] = $row;
      }
      return $favorites;
    }
    else
    {
      return false;
    }
  }

  /**
   * Agrega un nuevo favorito para un miembro.
   *
   * @param int $member_id El ID del miembro.
   * @param int $thread_id El ID del hilo a agregar como favorito.
   * @return boolean true si se agregó correctamente, false si ocurrió un error.
   */
  public function addFavorite($member_id, $thread_id)
  {
    $date = time();
    $query = $this->db->query("INSERT INTO `members_favorites` (`member_id`, `thread_id`, `created_at`) VALUES ('$member_id', '$thread_id', '$date')");
    return ($query == true) ? true : false;
  }

  /**
   * Elimina un favorito de un miembro.
   *
   * @param int $member_id El ID del miembro.
   * @param int $thread_id El ID del hilo a eliminar de los favoritos.
   * @return boolean true si se eliminó correctamente, false si ocurrió un error.
   */
  public function removeFavorite($member_id, $thread_id)
  {
    $stmt = $this->db->prepare("DELETE FROM `members_favorites` WHERE `member_id` = ? AND `thread_id` = ?");
    $stmt->bind_param('ii', $member_id, $thread_id);
    return $stmt->execute();
  }


  /**
   * Verifica si un usuario tiene como favorito x hilo.
   *
   * @param int $member_id El ID del miembro.
   * @param int $thread_id El ID del hilo a verificar.
   * @return boolean true si lo tiene como favorito, false si no.
   */
  public function isFavorite($member_id, $thread_id)
  {
    return (bool) $this->db->query("SELECT `thread_id` FROM `members_favorites` WHERE `member_id` = '$member_id' AND `thread_id` = '$thread_id'")->num_rows;
  }
}
