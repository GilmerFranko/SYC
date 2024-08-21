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
$page['code'] = 'adminEditLocation';

// COMPROBAR SI SE HA ENVIADO EL FORMULARIO DE EDICIÓN
if (isset($_GET['edit_location']))
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


  if (empty($msg))
  {
    $locationId = cleanInput($_POST['location_id']);
    $data['name'] = cleanInput($_POST['name']);
    $data['description'] = isset($_POST['description']) ? cleanInput($_POST['description']) : '';
    $data1['contact_id'] = cleanInput($_POST['contact_id']);
    $data['updated_at'] = time();

    // Verifica si existe el contacto_id 
    //$existContact = loadClass('admin/f_contacts')->existContactWithDifferentData($data['contact_id'], $data['name'], $data['short_url']);
    if (loadClass('admin/f_contacts')->existContact($data1['contact_id']))
    {
      // Verifica si no existe una ubicación con el mismo nombre AND contact_id
      if (loadClass('admin/locations')->existsLocation($locationId, $data1['contact_id'], $data['name']) <= 0)
      {
        if (loadClass('admin/locations')->updateLocation($locationId, $data))
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
        $msg[] = 'Ya existe una ubicación con ese nombre';
      }
    }
    else
    {
      //$msg[] = 'El contacto no existe';
    }
  }
  setToast([$msg]);
  redirect('admin/edit.location', ['location_id' => $_POST['location_id']]);
  exit;
}

if (isset($_GET['delete_location']))
{
  $locationId = cleanInput($_POST['location_id']);

  // Verifica si esta ubicacion (foro) tiene hilos (temas)
  $threads = loadClass('forums/threads')->getCountThreadsByLocationId($locationId);
  if ($threads <= 0)
  {
    // Eliminar el foro
    if (loadClass('admin/locations')->deleteLocation($locationId))
    {
      $msg = ['status' => 'success', 'msg' => 'La sección ha sido eliminada'];
    }
    // No se ha podido eliminar el foro
    else
    {
      $msg = ['status' => 'error', 'msg' => 'No se ha podido eliminar la sección'];
    }
  }
  // La sección (foro) tiene hilos
  else
  {
    $msg = ['status' => 'error', 'msg' => 'La sección no puede ser eliminada porque tiene hilos'];
  }
  // Devolver el resultado
  echo json_encode($msg);
}

$msg = [];

// Verificar si se ha pasado un ID válido para la edición
if (!isset($_GET['location_id']) || !is_numeric($_GET['location_id']))
{
  $msg = ['Has introducido un ID incorrecto'];
}

// Verifica que no haya errores
if (empty($msg))
{
  $locationId = (int)$_GET['location_id'];
  $location = loadClass('admin/locations')->getLocationById($locationId);
  if (!$location)
  {
    $msg = ['La ubicación no existe'];
  }
}

if (!empty($msg))
{
  setToast([$msg]);
  redirect('admin/locations');
  exit;
}
