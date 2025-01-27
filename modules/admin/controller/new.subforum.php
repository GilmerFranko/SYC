<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de las acciones para las subforumes (foros)
 *
 *
 */

$page['name'] = 'Nueva sección locación';
$page['code'] = 'adminNewForum';


// COMPROBAR SI SE HA GUARDARÁ NUEVO THREAD (locacion)
if (isset($_GET['new_subforum']))
{
  $msg = [];
  // Comprobar si se ha introducido un nombre
  if (!isset($_POST['name']) || empty($_POST['name']))
  {
    $msg[] = 'Debes introducir un nombre';
  }

  // Comprobar si se ha seleccionado un foro
  if (!isset($_POST['forum_id']) || empty($_POST['forum_id']))
  {
    $msg[] = 'No se ha seleccionado un foro';
  }

  // Comprobar si se ha sintroducido una url corta
  if (!isset($_POST['short_url']) || empty($_POST['short_url']))
  {
    $msg[] = 'Debes introducir una url corta';
  }

  if (empty($msg))
  {

    $data['name'] = cleanInput($_POST['name']);
    $data['description'] = (isset($_POST['description']) and !empty($_POST['description'])) ? cleanInput($_POST['description']) : '';
    $data['forum_id'] = cleanInput($_POST['forum_id']);
    $data['short_url'] = cleanInput($_POST['short_url']);
    $data['topic_count'] = 0;
    $data['post_count'] = 0;
    $data['last_post_id'] = 0;
    $data['visibility'] = 1;
    $data['status'] = 1;
    $data['created_at'] = time();

    // Verifica si existe el foro_id 
    if (loadClass('admin/f_forums')->existForum($_POST['forum_id']))
    {
      // Verifica si no existe una ubicación con el mismo nombre AND forum_id
      if (loadClass('admin/subforums')->existsSubforum($subforumId, $data1['forum_id'], $data['name']) <= 0)
      {
        // Verifica si no existe una sección con la misma url corta
        if (!loadClass('admin/subforums')->existsShortUrl($subforumId, $data['short_url']))
        {
          if (loadClass('admin/subforums')->newSubforum($data))
          {
            $msg[] = 'Se ha creado la sección correctamente';
          }
          else
          {
            $msg[] = 'No se ha podido crear la sección';
          }
        }
        else
        {
          $msg[] = 'La url corta ya existe';
        }
      }
      else
      {
        $msg[] = 'Ya exista una sección con ese nombre en ese foro';
      }
    }
    else
    {
      $msg[] = 'El foro no existe';
    }
  }
  setToast([$msg]);
  redirect('admin/new.subforum');
  exit;
}
