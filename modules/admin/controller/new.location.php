<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de las acciones para las locationes (foros)
 *
 *
 */

$page['name'] = 'Nueva sección locación';
$page['code'] = 'adminNewContact';


// COMPROBAR SI SE HA GUARDARÁ NUEVO THREAD (locacion)
if (isset($_GET['new_location']))
{
  $msg = [];
  // Comprobar si se ha introducido un nombre
  if (!isset($_POST['name']) || empty($_POST['name']))
  {
    $msg[] = 'Debes introducir un nombre';
  }

  // Comprobar si se ha seleccionado un contacto
  if (!isset($_POST['contact_id']) || empty($_POST['contact_id']))
  {
    $msg[] = 'No se ha seleccionado un contacto';
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
    $data['contact_id'] = cleanInput($_POST['contact_id']);
    $data['short_url'] = cleanInput($_POST['short_url']);
    $data['topic_count'] = 0;
    $data['post_count'] = 0;
    $data['last_post_id'] = 0;
    $data['visibility'] = 1;
    $data['status'] = 1;
    $data['created_at'] = time();

    // Verifica si existe el contacto_id 
    if (loadClass('admin/f_contacts')->existContact($_POST['contact_id']))
    {
      // Verifica si no existe una ubicación con el mismo nombre AND contact_id
      if (loadClass('admin/locations')->existsLocation($locationId, $data1['contact_id'], $data['name']) <= 0)
      {
        // Verifica si no existe una sección con la misma url corta
        if (!loadClass('admin/locations')->existsShortUrl($locationId, $data['short_url']))
        {
          if (loadClass('admin/locations')->newLocation($data))
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
        $msg[] = 'Ya exista una sección con ese nombre en ese contacto';
      }
    }
    else
    {
      $msg[] = 'El contacto no existe';
    }
  }
  setToast([$msg]);
  redirect('admin/new.location');
  exit;
}
