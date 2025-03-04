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
   * @param int $subforum_id
   * @param int $member_id
   * @param string $title
   * @param string $content
   * @param string $status
   * @param int $views_count
   * @param int $replies_count
   * @param int $likes_count
   * @param int $count_favorites
   * @param string $ip_address
   * @param int $report_count
   * @param string $created_at
   * @param string $updated_at
   *
   * @return bool
   */
  public function newThread(array $data): int
  {
    // Generar el slug a partir del título
    $slug = loadClass('core/extra')::generateSlug($data['title']);

    // Añadir un sufijo único para evitar colisiones (puedes usar ID, timestamp, etc.)
    $uniqueId = uniqid();  // O usar time() para un timestamp

    // Combinar el slug y el sufijo para generar la URL
    $url = $slug . '.' . $uniqueId;

    $data2 = [
      'slug' => $url,
      'position' => time(),
      'views_count' => 0,
      'replies_count' => 0,
      'likes_count' => 0,
      'count_favorites' => 00,
      'report_count' => 0,
      'updated_at' => 0
    ];

    $data = array_merge($data, $data2);

    if ($r = loadClass('core/db')->smartInsert('f_threads', $data))
    {
      return $r;
    }
    return false;
  }


  /**
   * @Description Obtiene todos los threads de un foro
   * @param int $subforum_id
   * @param int $page El n mero de p gina
   * @return array|boolean Un array con los threads
   */
  public function getThreadsBySubforumId(int $subforum_id, string $short_url, int $limit = 20)
  {
    $where = [
      'subforum_id' => $subforum_id
    ];

    $total_query = $this->db->query(
      'SELECT 
        COUNT(id)
      FROM 
        `f_threads` AS t
      INNER JOIN 
        `members` AS m ON t.`member_id` = m.`member_id`
      WHERE 
        t.`subforum_id` = "' . $subforum_id . '" AND
        t.`status` = 1'
    );

    list($data['total']) = $total_query->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('f', $short_url), $data['total'], $limit);

    $query = $this->db->query(
      'SELECT 
        t.*,
        m.`name` AS member_name,
        m.`member_id` AS member_id
      FROM 
        `f_threads` AS t
      INNER JOIN 
        `members` AS m ON t.`member_id` = m.`member_id`
      WHERE 
        t.`subforum_id` = "' . $subforum_id . '" AND
        t.`status` = 1 
      ORDER BY 
        t.`position` DESC 
      LIMIT ' . $data['pages']['limit']
    );

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

  /**
   * @Description Obtiene todos los threads de un usuario
   * @param int $subforum_id
   * @param int $page El n mero de p gina
   * @return array|boolean Un array con los threads
   */
  public function getThreadsByProfileId($member_id, $page = 1, $limit = 20)
  {

    $query = $this->db->query(
      'SELECT 
        t.*,
        m.`name` AS member_name,
        m.`member_id` AS member_id
      FROM 
        `f_threads` AS t
      INNER JOIN 
        `members` AS m ON t.`member_id` = m.`member_id`
      WHERE 
        t.`member_id` = "' . $member_id . '" AND
        t.`status` = 1 
      ORDER BY 
        t.`position` DESC'
    );

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

  public function searchThreads($params, $page = 1, $limit = 20)
  {
    $where = [];
    $bindings = [];

    // Filtrar por categoría (forum_id)
    if (!empty($params['forum_id']))
    {
      $where[] = 'l.`forum_id` = "' . $this->db->real_escape_string($params['forum_id']) . '"';
    }

    // Filtrar por ubicación (subforum_id)
    if (!empty($params['subforum_id']))
    {
      $where[] = 't.`subforum_id` = "' . $this->db->real_escape_string($params['subforum_id']) . '"';
    }

    // Filtrar por palabras clave (en el título o contenido)
    if (!empty($params['words']))
    {
      $words = $this->db->real_escape_string($params['words']);
      $where[] = '(t.`title` LIKE "%' . $words . '%" OR t.`content` LIKE "%' . $words . '%")';
    }

    // Filtrar por estado
    $where[] = 't.`status` = ' . 1;

    // Ordenar por fecha (ascendente o descendente)
    $order_by = !empty($params['order_by']) && in_array($params['order_by'], ['asc', 'desc'])
      ? $params['order_by']
      : 'desc';

    // Construir la cláusula WHERE
    $where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : 'WHERE `status` = 1';

    // Calcular el límite inferior y superior
    $lowerLimit = ($page - 1) * $limit;
    $upperLimit = $limit;

    // Consulta para obtener el total de resultados (sin límite de paginación)
    $total_query = $this->db->query(
      'SELECT COUNT(*) 
        FROM `f_threads` AS t
        INNER JOIN `members` AS m ON t.`member_id` = m.`member_id`
        INNER JOIN `f_subforums` AS l ON t.`subforum_id` = l.`id`
        INNER JOIN `f_forums` AS c ON l.`forum_id` = c.`id`
        ' . $where_clause
    );

    list($data['total']) = $total_query->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('forums', 'view.searches', null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT 
            t.*,
            c.`id` AS forum_id,
            m.`name` AS member_name,
            m.`member_id` AS member_id
        FROM 
            `f_threads` AS t
        INNER JOIN 
            `members` AS m ON t.`member_id` = m.`member_id`
        INNER JOIN 
            `f_subforums` AS l ON t.`subforum_id` = l.`id`
        INNER JOIN 
            `f_forums` AS c ON l.`forum_id` = c.`id`
        ' . $where_clause . '
        ORDER BY 
            t.`position` ' . $order_by . ' 
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

  public function searchThreadsBySubforumName($params, $page = 1, $limit = 20)
  {
    $where = [];
    $bindings = [];

    // Filtrar por subforo (forum_id)
    if (!empty($params['subforum_name']))
    {
      $where[] = 'l.name = "' . $this->db->real_escape_string($params['subforum_name']) . '"';
    }

    // Filtrar por estado
    $where[] = 't.`status` = ' . 1;

    // Ordenar por fecha (ascendente o descendente)
    $order_by = !empty($params['order_by']) && in_array($params['order_by'], ['asc', 'desc'])
      ? $params['order_by']
      : 'desc';

    // Construir la cláusula WHERE
    $where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : 'WHERE `status` = 1';

    // Calcular el límite inferior y superior
    $lowerLimit = ($page - 1) * $limit;
    $upperLimit = $limit;

    // Consulta para obtener el total de resultados (sin límite de paginación)
    $total_query = $this->db->query(
      'SELECT COUNT(*) 
        FROM `f_threads` AS t
        INNER JOIN `members` AS m ON t.`member_id` = m.`member_id`
        INNER JOIN `f_subforums` AS l ON t.`subforum_id` = l.`id`
        INNER JOIN `f_forums` AS c ON l.`forum_id` = c.`id`
        ' . $where_clause
    );

    list($data['total']) = $total_query->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('forums', 'view.searches', null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT 
            t.*,
            c.`id` AS forum_id,
            m.`name` AS member_name,
            m.`member_id` AS member_id
        FROM 
            `f_threads` AS t
        INNER JOIN 
            `members` AS m ON t.`member_id` = m.`member_id`
        INNER JOIN 
            `f_subforums` AS l ON t.`subforum_id` = l.`id`
        INNER JOIN 
            `f_forums` AS c ON l.`forum_id` = c.`id`
        ' . $where_clause . '
        ORDER BY 
            t.`position` ' . $order_by . ' 
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



  /**
   * @Description Obtiene todos los threads guardados en favoritos por un usuario
   * @param int $subforum_id
   * @param int $page El n mero de p gina
   * @return array|boolean Un array con los threads
   */
  public function getFavoritedThreads($member_id, $limit = 20)
  {
    $where = [
      'member_id' => $member_id
    ];

    $query_count = $this->db->query(
      'SELECT 
        COUNT(*)
      FROM 
        `f_threads` AS t
      INNER JOIN 
        `members_favorites` AS mf ON t.`id` = mf.`thread_id`
      INNER JOIN 
        `members` AS m ON t.`member_id` = m.`member_id`
      WHERE 
        mf.`member_id` = "' . $member_id . '" AND
        t.`status` = 1
    '
    );

    list($data['total']) = $query_count->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('mi-panel', 'favoritos'), $data['total'], $limit);

    $query = $this->db->query(
      'SELECT 
        t.*,
        m.`name` AS member_name,
        m.`member_id` AS member_id
      FROM 
        `f_threads` AS t
      INNER JOIN 
        `members_favorites` AS mf ON t.`id` = mf.`thread_id`
      INNER JOIN 
        `members` AS m ON t.`member_id` = m.`member_id`
      WHERE 
        mf.`member_id` = "' . $member_id . '" AND
        t.`status` = 1
      ORDER BY 
      t.`created_at` DESC 
      LIMIT ' . $data['pages']['limit']
    );

    $data['rows'] = $query->num_rows;
    // Obtener los resultados de la consulta
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
   * @Description Obtiene todos los threads de un foro
   * @param int $subforum_url
   * @param int $page El n mero de p gina
   * @return array|boolean Un array con los threads
   */
  public function getThreadsBySubforumUrl($subforum_url, $page = 1, $limit = 20)
  {
    if ($subforum = getColumns('f_subforums', ['id'], ['short_url', $subforum_url]))
    {
      return $this->getThreadsBySubforumId($subforum['id'], $page, $limit);
    }
    else
    {
      return false;
    }
  }



  /**
   * Obtiene las imagenes de un thread por su ID
   *
   * @param int $thread_id
   * @return array|bool
   */
  public function getImagesByThreadId($thread_id)
  {
    $query = $this->db->query(
      'SELECT 
        *
      FROM 
        `f_threads_images`
      WHERE 
        `thread_id` = "' . $thread_id . '" 
    '
    );

    if ($query)
    {
      $data['rows'] = $query->num_rows;
      if ($data['rows'] > 0)
      {
        while ($row = $query->fetch_assoc())
        {
          $data['data'][] = $row;
        }
      }
      return $data;
    }
    return false;
  }

  /**
   * Obtiene un thread por su ID
   *
   * @param int $id
   * @return array
   */
  public function getThreadByIdBasic($id)
  {
    $data = getColumns('f_threads', ['id', 'subforum_id', 'member_id', 'title', 'email', 'phone', 'fee', 'content', 'status', 'views_count', 'replies_count', 'likes_count', 'count_favorites', 'ip_address', 'report_count', 'created_at', 'updated_at'], ['id', $id]);
    $data['member'] = getColumns('members', ['member_id', 'name', 'pp_thumb_photo'], ['member_id', $data['member_id']]);
    return $data;
  }

  /**
   * Obtiene un thread por su ID o Slug dependiendo de la variable $isSlug
   *
   * @param int|string $identifier
   * @param int $member_id
   * @param bool $isSlug
   * @return boolean|array
   */
  public function getThread($identifier, $member_id, $isSlug = false)
  {
    // Determinar la columna a buscar
    $column = $isSlug ? 't.`slug`' : 't.`id`';

    // Escapar adecuadamente las variables
    $escapedIdentifier = $this->db->real_escape_string($identifier);

    // Construir la consulta con la lógica condicional
    $query = $this->db->query(
      'SELECT 
        t.*,
        m.`member_id` AS member_id,
        m.`name` AS member_name,
        m.`pp_thumb_photo` AS member_pp,
        COUNT(f.`thread_id`) AS member_favorites
      FROM 
          `f_threads` AS t
      INNER JOIN 
          `members` AS m ON t.`member_id` = m.`member_id`
      LEFT JOIN 
          `members_favorites` AS f ON t.`id` = f.`thread_id` AND f.`member_id` = ' . $member_id . '
      WHERE 
          ' . $column . ' = "' . $escapedIdentifier . '"
      GROUP BY 
          t.`id`'
    );

    // Procesar el resultado
    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return false;
  }

  /**
   * Actualiza un thread en la base de datos
   *
   * @param int $thread_id El ID del thread a actualizar
   * @param array $data Los datos a actualizar
   * @param array $deleted_images (Opcional) Las imágenes que se eliminarán
   * @return array
   */
  public function updateThread($thread_id, array $data, array $deleted_images = [])
  {
    // Validar y limpiar los datos antes de realizar la actualización
    $data = array_merge($data, [
      'updated_at' => time(),
      'ip_address' => Core::model('extra', 'core')->getIp()
    ]);

    // Actualizar el thread en la base de datos
    $updated = loadClass('core/db')->smartInsert('f_threads', $data, ['id', $thread_id]);

    if ($updated)
    {
      $error = false;
      // Si hay imágenes a eliminar, procesarlas
      if (!empty($deleted_images))
      {
        foreach ($deleted_images as $image_id)
        {
          // Eliminar la imagen de la base de datos y del servidor
          if (!$this->deleteImageById($image_id, $thread_id))
          {
            $error = true;
          }
        }
      }
      if ($error)
      {
        $return = ['status' => false, 'msg' => 'No se eliminaron algunas imagenes', 'id' => $updated];
      }
      else
      {
        $return = ['status' => true, 'msg' => '¡Anuncio actualizado con éxito!', 'id' => $updated];
      }
      return $return;
    }
    return ['status' => false, 'msg' => 'No se actualizo el anuncio'];
  }

  /**
   * Elimina un thread por su ID
   *
   * @param int $thread_id El ID del thread a eliminar
   * @return array
   */
  public function deleteThread($thread_id)
  {
    // Eliminar imágenes relacionadas
    $images = $this->getImagesByThreadId($thread_id);
    if ($images && $images['rows'] > 0)
    {
      foreach ($images['data'] as $image)
      {
        if (empty($image['image_url']))
        {
          // Eliminar la imagen solo de la base de datos
          loadClass('core/db')->deleteRow('f_threads_images', $image['id']);
          continue;
        }
        if (!$this->deleteImageById($image['id'], $thread_id))
        {
          return ['status' => false, 'msg' => 'Error al eliminar imágenes asociadas'];
        }
      }
    }

    // Elimina los favoritos relacionados
    if (!loadClass('forums/favorites')->removeAllFavoritesByThreadId($thread_id))
    {
      return ['status' => false, 'msg' => 'Error al eliminar los favoritos asociados'];
    }

    // Elimina los reportes relacionados
    if (!$this->deleteAllReportsOfThread($thread_id))
    {
      return ['status' => false, 'msg' => 'Error al eliminar los reportes asociados'];
    }

    // Eliminar visitas
    if (!$this->deleteAllVisitsByThreadId($thread_id))
    {
      return ['status' => false, 'msg' => 'Error al eliminar las visitas asociadas'];
    }

    // Elimina auto renovaciones
    if (!$this->deleteAllAutoRenewalByThreadId($thread_id))
    {
      return ['status' => false, 'msg' => 'Error al eliminar las renovaciones asociadas'];
    }

    // Registra actividad

    /**
     * Si se llega a registrar a utilizar los contadores
     * de los temas topic_count y post_count se debe
     * actualizar el valor
     **/


    // Si se llega a este punto, se puede eliminar el thread de la base de datos
    $query = $this->db->query('DELETE FROM `f_threads` WHERE `id` = "' . $this->db->real_escape_string($thread_id) . '" LIMIT 1');

    if ($query)
    {
      return ['status' => true, 'msg' => 'Anuncio eliminado con éxito!'];
    }
    else
    {
      return ['status' => false, 'msg' => 'Error al eliminar el anuncio'];
    }
  }

  /**
   * Obtiene la cantidad de todos los threads de una ubicación (subforum)
   *
   * @param int $subforum_id
   * @return int
   */
  public function getCountThreadsBySubforumId($subforum_id)
  {
    return loadClass('core/db')->getCount('f_threads', 'id', ['subforum_id', $subforum_id]);
  }

  /**
   * Sube las imagenes de los threads
   *
   * @return array
   */
  public function uploadImages(): array
  {
    global $config;
    $msg = [false];
    $image_urls = [];

    if (isset($_FILES['images']) && is_array($_FILES['images']['name']))
    {
      // Verifica si se ha subido mas de 9 imagenes
      if (count($_FILES['images']['name']) > 9)
      {
        return [false, 'No puedes subir mas de 9 imagenes'];
      }
      else
      {
        foreach ($_FILES['images']['name'] as $key => $value)
        {
          if ($_FILES['images']['size'][$key] > 0)
          {
            $image_url = loadClass('core/extra')->uploadImage(
              [
                'name' => $_FILES['images']['name'][$key],
                'type' => $_FILES['images']['type'][$key],
                'tmp_name' => $_FILES['images']['tmp_name'][$key],
                'error' => $_FILES['images']['error'][$key],
                'size' => $_FILES['images']['size'][$key]
              ],
              $config['threads_path']
            );
            // Si no ha ocurrido un error
            if ($image_url)
            {
              $image_urls[] = $image_url;
            }
            // Si ha habido un error
            else
            {
              // Borra las imagenes subidas
              foreach ($image_urls as $img)
              {
                loadClass('core/extra')->deleteImage($img, $config['threads_path']);
              }
              $msg = [false, 'No se ha podido subir la imagen', 'error'];

              return $msg;
            }
          }
        }
      }
    }

    // Carga imagen predefinida
    if (empty($image_urls))
    {
      $image_urls[0] = 'null';
    }

    return [true, $image_urls];
  }

  /** Sube una imagen (el nombre) de una publicacion a la base de datos */
  public function newThreadImage($thread_id, $image_url)
  {
    // Si es una imagen vacia
    if ($image_url == 'null')
    {
      // Verifica que el hilo no tenga imagenes, EVITA SUBIR LA IMAGEN DEFAULT 
      $count_images = loadClass('core/db')->getCount('f_threads_images', 'id', ['thread_id', $thread_id]);
      if ($count_images > 0)
      {
        return false;
      }
      return loadClass('core/db')->smartInsert('f_threads_images', ['thread_id' => $thread_id, 'created_at' => time()]);
    }
    // Si es una imagen normal
    else
    {
      return loadClass('core/db')->smartInsert('f_threads_images', ['thread_id' => $thread_id, 'image_url' => $image_url, 'created_at' => time()]);
    }
  }


  /**
   * Elimina una imagen de un thread por su ID
   * Elimina la imagen de la bd y del servidor
   * @param int $image_id ID de la imagen
   * @return bool true si se ha eliminado correctamente, false en caso de error
   */
  public function deleteImageById($image_id, $thread_id)
  {
    global $config;

    $image = getColumns('f_threads_images', ['thread_id', 'image_url'], ['id', $image_id]);

    // Verificar que la imagen existe
    if (!$image)
    {
      return false;
    }

    // Verificar que la imagen pertenece al thread
    if ($image['thread_id'] != $thread_id)
    {
      return false;
    }

    // Eliminar la imagen del servidor
    if (!loadClass('core/extra')->deleteImage($image['image_url'], $config['threads_path']))
    {
      return false;
    }

    // Eliminar la imagen de la base de datos
    return loadClass('core/db')->deleteRow('f_threads_images', $image_id);
  }

  /**
   * Obtiene todos los threads creados por un miembro
   *
   * @param int $member_id ID del miembro
   * @param int $page Número de página (opcional, por defecto 1)
   * @param int $limit Cantidad de threads por página (opcional, por defecto 20)
   * @return array|false Un array con los threads o false si no se encuentran
   */
  public function getThreadsByMemberId($member_id, $page = 1, $limit = 20)
  {
    // Calcular el límite inferior y superior para la paginación
    $offset = ($page - 1) * $limit;

    $query = $this->db->query(
      'SELECT 
            t.*, 
            m.name AS member_name, 
            m.pp_thumb_photo AS member_pp
         FROM 
            `f_threads` AS t
         INNER JOIN 
            `members` AS m ON t.member_id = m.member_id
         WHERE 
            t.member_id = "' . $member_id . '"
         ORDER BY 
            t.created_at DESC
         LIMIT ' . $offset . ', ' . $limit
    );

    if ($query)
    {
      $data['rows'] = $query->num_rows;
      if ($data['rows'] > 0)
      {
        while ($row = $query->fetch_assoc())
        {
          $data['data'][] = $row;
        }
      }
      return $data;
    }
    return ['rows' => 0];
  }


  /**
   * Obtiene el slug de un hilo por su ID
   *
   * @param int $thread_id ID del thread
   * @return string|false El slug del thread o false si no se encuentra
   */
  public function getThreadSlug($thread_id)
  {
    $query = $this->db->query(
      'SELECT
            t.slug
         FROM
            `f_threads` AS t
         WHERE
            t.id = "' . $thread_id . '"'
    );

    if ($query && $query->num_rows > 0)
    {
      $row = $query->fetch_assoc();
      return $row['slug'];
    }
    return false;
  }

  public function getThreadUrl($thread_id)
  {
    return gLink('anuncio/' . $this->getThreadSlug($thread_id));
  }


  /**
   * Elimina la imagen vacia de un thread
   * 
   * @param int $thread_id ID del thread
   * @return void 
   */
  public function deleteEmptyImages($thread_id): void
  {
    $query = $this->db->query(
      'DELETE
          FROM
            `f_threads_images`
          WHERE
            `thread_id` = "' . $thread_id . '"
            AND
            (`image_url` = "" OR `image_url` IS NULL)
          LIMIT 1'
    );
  }



  /**
   * Registra una denuncia de un hilo
   * 
   * @param array $data Los datos de la denuncia
   * 
   * @return bool
   */
  public function reportThread($data)
  {
    $data['reported_at'] = time();

    // Elimina cualquier reporte de este usuario a este hilo
    //$this->db->query('DELETE FROM `f_threads_reports` WHERE `thread_id` = ' . $data['thread_id'] . ' AND `reported_by_member_id` = ' . $data['reported_by_member_id']);

    return loadClass('core/db')->smartInsert('f_threads_reports', $data);
  }



  /**
   * Elimina todos los reportes de un thread
   * 
   * @param int $thread_id ID del thread
   * 
   * @return bool
   */
  public function deleteAllReportsOfThread($thread_id)
  {
    return $this->db->query('DELETE FROM `f_threads_reports` WHERE `thread_id` = "' . $thread_id . '"');
  }


  /**
   * Elimina todas las visitas de un thread
   * 
   * @param int $thread_id ID del thread
   * 
   * @return bool
   */
  public function deleteAllVisitsByThreadId($thread_id)
  {
    return $this->db->query('DELETE FROM `f_threads_visits` WHERE `thread_id` = "' . $thread_id . '"');
  }

  /**
   * Elimina todas las renovaciones de un thread
   * 
   * @param int $thread_id ID del thread
   * 
   * @return bool
   */
  public function deleteAllAutoRenewalByThreadId($thread_id)
  {
    return $this->db->query('DELETE FROM `auto_renueva_settings` WHERE `thread_id` = "' . $thread_id . '"');
  }


  /**
   * Aumenta en uno el conteo de visitas de un thread
   * 
   * @param int $thread_id ID del thread
   * 
   * @return bool
   */
  public function addVisit($thread_id)
  {
    return $this->db->query('UPDATE `f_threads` SET `views_count` = `views_count` + 1 WHERE `id` = "' . $thread_id . '"');
  }


  /**
   * @Description Verifica si un miembro ya visitó un hilo en una fecha específica.
   * @param int $thread_id
   * @param int $member_id
   * @return bool True si ya visitó, False si no.
   */
  public function checkVisit($thread_id, $member_id)
  {
    $query = $this->db->query("
      SELECT id 
      FROM f_threads_visits 
      WHERE thread_id = " . (int)$thread_id . " 
      AND member_id = " . (int)$member_id . "
      AND DATE(visit_date) = CURDATE()
    ");

    return $query and $query->num_rows > 0;
  }

  /**
   * @Description Registra la visita de un miembro a un hilo (thread).
   * @param int $thread_id
   * @param int $member_id
   * @param string $ipaddress Dirección IP del visitante
   * @return bool True si la visita fue registrada correctamente
   */
  public function registerVisit($thread_id, $member_id, $ipaddress)
  {
    // Verificar si ya visitó hoy
    if ($this->checkVisit($thread_id, $member_id))
    {
      return false; // Ya visitó hoy, no registrar de nuevo
    }

    // Registrar la visita
    $query = $this->db->query("
      INSERT INTO f_threads_visits (thread_id, member_id, ipaddress, visit_date) 
      VALUES (" . (int)$thread_id . ", " . (int)$member_id . ", '" . $this->db->real_escape_string($ipaddress) . "', NOW())
    ");

    $this->addVisit($thread_id);

    return $query;
  }

  /**
   * @Description Obtiene los hilos más visitados.
   * @param int $limit El número de hilos a devolver
   * @return array|boolean Un array con los hilos más visitados
   */
  public function getMostVisitedThreads($limit = 10)
  {
    $query = $this->db->query(
      "
      SELECT 
        t.id, 
        t.title, 
        t.content, 
        t.created_at, 
        COUNT(v.id) AS visit_count
      FROM 
        f_threads AS t
      LEFT JOIN 
        f_threads_visits AS v ON t.id = v.thread_id
      GROUP BY 
        t.id
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

  public function getThreadVisitsLast10Days($thread_id)
  {
    $query = $this->db->query(
      "SELECT 
        DATE(visit_date) AS visit_day, 
        COUNT(id) AS visits_count
      FROM 
        f_threads_visits
      WHERE 
        thread_id = " . (int)$thread_id . "
      GROUP BY 
        visit_day
      ORDER BY 
        visit_day DESC
      LIMIT 10"
    );

    $data = [];
    if ($query && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        // Formatear la fecha en 'd-M' (por ejemplo, '1-Dic')
        $formatted_date = date('j-M', strtotime($row['visit_day']));
        $data[] = [$formatted_date, (int)$row['visits_count']];
      }
    }

    return $data;
  }


  /**
   * Verifica si un usuario es el propietario de un hilo
   * @param int $thread_id
   * @param int $member_id
   * @return bool
   */
  public function isThreadOwner($thread_id, $member_id)
  {
    $query = $this->db->query(
      'SELECT 
        COUNT(*) AS count
      FROM 
        f_threads
      WHERE 
        id = "' . (int)$thread_id . '" 
      AND 
        member_id = "' . (int)$member_id . '"'
    );

    return $query->fetch_assoc()['count'] > 0;
  }
}
