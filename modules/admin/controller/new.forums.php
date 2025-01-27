<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de las acciones para los contáctos
 *
 *
 */

$page['name'] = 'Nueva categoria foro';
$page['code'] = 'adminNewForum';


// COMPROBAR SI SE HA ESPECIFICADO ACCION Y TIPO
if (isset($_GET['do']))
{
  // ACCIÓN SOBRE PALABRAS
  if ($_GET['do'] == 'new')
  {
    if (!isset($_POST['name']) or empty($_POST['name']))
    {
      $msg[] = 'Debes introducir un nombre';
    }
    if (!isset($_POST['short_url']) or empty($_POST['short_url']))
    {
      $msg[] = 'Debes introducir una descripción';
    }
    if (!isset($msg))
    {

      $contact = [
        'name' => cleanString($_POST['name']),
        'short_url' => cleanString($_POST['short_url']),
        'status' => (isset($_POST['status']) and !is_int($_POST['status'])) ? cleanString($_POST['status']) : 1,
        'visibility' => 1, //(isset($_POST['visibility']) and !is_int($_POST['visibility'])) ? cleanString($_POST['visibility']) : 1,
        'created_at' => time()
      ];

      if ($image_url = loadClass('core/extra')->uploadImage($_FILES['image'], $config['forums_path']))
      {
        $contact['image'] = $image_url;

        $result = loadClass('admin/f_forums')->newForum($contact);

        if ($result)
        {
          $msg[] = 'El foro se ha creado correctamente';
        }
        else
        {
          $msg[] = 'No se ha podido crear el foro';
          // Elimina imagen subida
          loadClass('core/extra')->deleteImage($image_url, $config['forums_path']);
        }
      }
      else
      {
        $msg[] = 'No se ha podido cargar la imagen';
        // Elimina imagen subida
        loadClass('core/extra')->deleteImage($image_url, $config['forums_path']);
      }
    }
    // Mostrar mensajes de error o éxito
    setToast([$msg]);

    // Recargar la página
    redirect('admin/forums.views');
  }
}
