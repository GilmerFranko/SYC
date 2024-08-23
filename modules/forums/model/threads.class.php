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
  public function newThread(array $data): int
  {
    $data2 = [
      'status' => 1,
      'position' => time(),
      'views_count' => 0,
      'replies_count' => 0,
      'likes_count' => 0,
      'count_favorites' => 00,
      'is_edited' => 0,
      'last_edited_by' => 0,
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
      $image_urls[0] = 'foto-predefinida.png';
    }

    return [true, $image_urls];
  }

  /** Sube una imagen (el nombre) de una publicacion a la base de datos */
  public function newThreadImage($thread_id, $image_url)
  {
    return loadClass('core/db')->smartInsert('f_threads_images', ['thread_id' => $thread_id, 'image_url' => $image_url, 'created_at' => time()]);
  }
}
