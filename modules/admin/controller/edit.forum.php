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
$page['code'] = 'adminEditsubforum';

// COMPROBAR SI SE HA ENVIADO EL FORMULARIO DE EDICIÓN
if (isset($_GET['edit_contact']))
{
  $msg = [];

  // Comprobar si se ha introducido un nombre
  if (!isset($_POST['name']) || empty($_POST['name']))
  {
    $msg[] = 'Debes introducir un nombre';
  }

  // Comprobar si se ha sintroducido una url corta
  if (!isset($_POST['short_url']) || empty($_POST['short_url']))
  {
    $msg[] = 'Debes introducir una url corta';
  }

  if (empty($msg))
  {
    $contactId = cleanInput($_POST['forum_id']);
    $data['name'] = cleanInput($_POST['name']);
    $data['short_url'] = cleanInput($_POST['short_url']);
    $data['updated_at'] = time();

    if (loadClass('admin/f_forums')->updateForums($contactId, $data))
    {
      // Verifica si se debe actualizar imagen
      if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
      {
        if (loadClass('admin/f_forums')->updateImage($contactId, $_FILES['image']))
        {
          //$msg[] = 'La imagen se ha editado correctamente';
        }
        else
        {
          $msg[] = 'No se ha podido editar la imagen';
        }
      }

      $msg[] = 'El foro se ha editado correctamente';

      setToast([$msg]);
      redirect('admin/forums.views');
    }
    else
    {
      $msg[] = 'No se ha podido editar el foro';
    }
  }

  setToast([$msg]);
  redirect('admin/forums.views');
  exit;
}
else
{

  $msg = [];

  // Verificar si se ha pasado un ID válido para la edición
  if (!isset($_GET['forum_id']) || !is_numeric($_GET['forum_id']))
  {
    $msg = ['Has introducido un ID incorrecto'];
  }

  // Verifica que no haya errores
  if (empty($msg))
  {
    $contactID = (int)$_GET['forum_id'];
    $contact = loadClass('admin/f_forums')->getForumsById($contactID);
    if (!$contact)
    {
      $msg = ['La ubicación no existe'];
    }
  }

  if (!empty($msg))
  {
    setToast([$msg]);
    redirect('admin/forums.views');
    exit;
  }
}
