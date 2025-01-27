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
class subforums extends Model
{


  /**
   * @Description Obtiene todos los foros
   * @param int $page El n mero de p gina
   * @return array|boolean Un array con los foros
   */
  public function getAllSubforums($page = 1, $limit = 10)
  {

    // Calcular el límite inferior y superior 
    $lowerLimit = ($page - 1) * $limit;
    $upperLimit = $limit;

    $query = $this->db->query('SELECT l.*, c.name AS forum_name FROM `f_subforums` AS l INNER JOIN `f_forums` AS c ON l.`forum_id` = c.`id` ORDER BY `id` DESC LIMIT ' . $lowerLimit . ',' . $upperLimit);
    $data['rows'] = $query->num_rows;
    // Obtener los resultados de la consulta
    if ($query and $data['rows'] > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
      // Paginador
      $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', 'views.subforums', null, null), $data['rows'], $limit);
      return $data;
    }
    return $data;
  }


  /**
   * @Description Guarda un nuevo foro
   * @param int $forum_id El ID del foro donde se va a guardar el foro
   * @param string $name El nombre del foro
   * @param string $description La descripci n del foro
   * @param string $visibility La visibilidad del foro
   * @param string $tags Las etiquetas del foro
   * @param string $status El estatus del foro
   * @return int El ID del nuevo foro
   */
  public function newSubforum($data)
  {
    if ($last_id = loadClass('core/db')->smartInsert('f_subforums', $data))
    {
      return $last_id;
    }
    else
    {
      return false;
    }
  }

  public function updateSubforum($subforumId, $data)
  {
    if ($last_id = loadClass('core/db')->smartInsert('f_subforums', $data, ['id', $subforumId]))
    {
      return $last_id;
    }
    else
    {
      return false;
    }
  }

  /**
   * @Description Elimina un foro (subforo)
   * @param int $id El ID del foro
   * @return bool True si se eliminó, false si no
   */
  public function deleteSubforum($id)
  {
    return loadClass('core/db')->deleteRow('f_subforums', $id);
  }

  /**
   * @Description Verifica si el foro tiene hilos
   * @param int $id El ID del foro
   * @return bool True si tiene hilos, false si no
   */
  public function hasThreads($id)
  {
    return (bool)$this->db->count('threads', array('subforum_id' => $id));
  }

  /**
   * @Description Obtiene todos los foros
   * @return array Los foros
   */
  public function getAllForums()
  {
    return $this->db->select('subforums');
  }

  /**
   * @Description Obtiene el ultimo post de un foro
   * @param int $id El ID del foro
   * @return array El ultimo post del foro
   */
  public function getLastPost($id)
  {
    $where = array(
      'subforum_id' => $id,
      'ORDER' => array('created_at' => 'DESC'),
      'LIMIT' => 1
    );

    return $this->db->select('posts', $where);
  }

  public function getSubforumById($id)
  {
    return getColumns('f_subforums', ['id', 'name', 'short_url', 'description', 'status', 'forum_id'], array('id', $id), 1);
  }

  /**
   * Comprueba si existe una subforo en la base de datos con el name pasado.
   *
   */
  public function existsSubforumByName($name)
  {
    return loadClass('core/db')->getCount('f_subforums', 'id', array('name', $name));
  }

  /**
   * Comprueba si existe una Ubicacion (foro) en la base de datos
   * No se tendrá en cuenta el mismo ID pasado
   */
  public function existsSubforum($subforum_id, $forum_id, $name)
  {
    $query = $this->db->query('SELECT `id` FROM `f_subforums` WHERE `id` != ' . $subforum_id . ' AND `forum_id` = ' . $forum_id . ' AND  `name` = \'' . $name . '\'');
    return $query == true && $query->num_rows > 0;
  }

  /* Comprueba que no exista un short_url igual registrado*/
  public function existsShortUrl($subforum_id, $short_url)
  {
    $query = $this->db->query('SELECT `id` FROM `f_subforums` WHERE `short_url` = \'' . $short_url . '\' AND `id` != ' . $subforum_id);
    return $query == true && $query->num_rows > 0;
  }
}
