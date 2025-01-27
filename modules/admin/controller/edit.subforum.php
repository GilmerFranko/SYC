<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para editar locación (foro)
 *
 */

$page['name'] = 'Editar sección locación';
$page['code'] = 'adminEditSubforum';

// COMPROBAR SI SE HA ENVIADO EL FORMULARIO DE EDICIÓN
if (isset($_GET['edit_subforum']))
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
    $subforumId = cleanInput($_POST['subforum_id']);
    $data['name'] = cleanInput($_POST['name']);
    $data['description'] = isset($_POST['description']) ? cleanInput($_POST['description']) : '';
    $data['short_url'] = cleanInput($_POST['short_url']);
    $data1['forum_id'] = cleanInput($_POST['forum_id']);
    $data['updated_at'] = time();

    // Verifica si existe el foro_id 
    //$existForums = loadClass('admin/f_forums')->existForumsWithDifferentData($data['forum_id'], $data['name'], $data['short_url']);
    if (loadClass('admin/f_forums')->existForums($data1['forum_id']))
    {
      // Verifica si no existe una ubicación con el mismo nombre AND forum_id
      if (loadClass('admin/subforums')->existsSubforum($subforumId, $data1['forum_id'], $data['name']) <= 0)
      {
        // Verifica si no existe una sección con la misma url corta
        if (!loadClass('admin/subforums')->existsShortUrl($subforumId, $data['short_url']))
        {
          if (loadClass('admin/subforums')->updateSubforum($subforumId, $data))
          {
            $msg[] = 'Se ha actualizado la sección correctamente';
          }
          else
          {
            $msg[] = 'No se ha podido actualizar la sección';
          }
        }
        else
        {
          $msg[] = 'Ya existe una sección con esa url corta';
        }
      }
      else
      {
        $msg[] = 'Ya existe una ubicación con ese nombre';
      }
    }
    else
    {
      //$msg[] = 'El foro no existe';
    }
  }
  setToast([$msg]);
  redirect('admin/edit.subforum', ['subforum_id' => $_POST['subforum_id']]);
  exit;
}

if (isset($_GET['delete_subforum']))
{
  $subforumId = cleanInput($_POST['subforum_id']);

  // Verifica si esta subforo (foro) tiene hilos (temas)
  $threads = loadClass('forums/threads')->getCountThreadsBySubforumId($subforumId);
  if ($threads <= 0)
  {
    // Eliminar el foro
    if (loadClass('admin/subforums')->deleteSubforum($subforumId))
    {
      $msg = ['status' => 'success', 'msg' => 'La sección ha sido eliminada'];
    }
    // No se ha podido eliminar el foro
    else
    {
      $msg = ['status' => 'error', 'msg' => 'No se ha podido eliminar la sección'];
    }
  }
  // La sección (foro) tiene hilos anuncios()
  else
  {
    $msg = ['status' => 'error', 'msg' => 'La sección no puede ser eliminada porque tiene hilos'];
  }
  // Devolver el resultado
  echo json_encode($msg);
}

$msg = [];

// Verificar si se ha pasado un ID válido para la edición
if (!isset($_GET['subforum_id']) || !is_numeric($_GET['subforum_id']))
{
  $msg = ['Has introducido un ID incorrecto'];
}

// Verifica que no haya errores
if (empty($msg))
{
  $subforumId = (int)$_GET['subforum_id'];
  $subforum = loadClass('admin/subforums')->getSubforumById($subforumId);
  if (!$subforum)
  {
    $msg = ['La ubicación no existe'];
  }
}

if (!empty($msg))
{
  setToast([$msg]);
  redirect('admin/subforums');
  exit;
}
