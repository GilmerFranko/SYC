<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de edición de publicación
 *
 */

$page['name'] = 'Modificar publicación';
$page['code'] = 'editThread';

if (!isset($_GET['thread_id']) or empty($_GET['thread_id']))
{
  redirect('core/home-guest');
}

$thread_id = escape($_GET['thread_id']);

// Verifica si existe el hilo
if (!$threadData = loadClass('forums/threads')->getThreadByIdBasic($thread_id))
{
  $msg[] = 'No existe el anuncio';
}

// Verifica si el usuario tiene permisos para manipular el hilo
if (!$threadData['member_id'] == $m_id)
{
  $msg[] = 'No tienes permiso para editar este anuncio';
}

if (!empty($msg))
{
  setTI([$msg]);
  redirect('core/home-guest');
  exit;
}




if (isset($_GET['edit_thread']))
{
  $msg = [];

  // Verifica si no se ha introducido un título
  if (!isset($_POST['title']) || empty($_POST['title']))
  {
    $msg[] = 'Debes introducir un título';
  }

  // Verifica si no se ha introducido un correo electrónico
  if (!isset($_POST['email']) || empty($_POST['email']))
  {
    $msg[] = 'Debes introducir un correo electrónico';
  }

  // Verifica si no se ha introducido un telefono
  // Antes de comprobar si es un numero y si es el tamaño correcto elimina todos los espacios
  if (!isset($_POST['phone']) || empty($_POST['phone']) || !is_numeric(str_replace(' ', '', $_POST['phone'])) || strlen(str_replace(' ', '', $_POST['phone'])) < 9)
  {
    $msg[] = 'El telefono debe tener al menos 9 digitos y ser un numero';
  }

  // Verifica si no se ha introducido una edad mayor a 18
  if (!isset($_POST['age']) || empty($_POST['age']) || !is_numeric($_POST['age']) || $_POST['age'] < 18)
  {
    $msg[] = 'Debes introducir una edad mayor a 18';
  }

  // Verifica si no se ha introducido una tarifa numérica
  if (!isset($_POST['fee']) || empty($_POST['fee']) || !is_numeric($_POST['fee']))
  {
    $msg[] = 'Debes introducir una tarifa numérica';
  }

  // Verifica si no se ha introducido un contenido con mas de 1500 caracteres
  if (!isset($_POST['content']) || empty($_POST['content']) || strlen($_POST['content']) > 10000)
  {
    $msg[] = 'El contenido no debe tener mas de 10.000 caracteres';
  }

  // Verifica si se desea eliminar imagenes
  if (isset($_POST['deleted_images']) and !empty($_POST['deleted_images']))
  {
    $deleted_images = escape($_POST['deleted_images']);
    $deleted_images = explode(',', $deleted_images);
  }
  else
  {
    $deleted_images = [];
  }



  if (empty($msg))
  {
    // Limpia los campos
    $thread = [
      'title' => cleanString($_POST['title']),
      'email' => cleanString($_POST['email']),
      'phone' => cleanString($_POST['phone']),
      'age' => cleanString($_POST['age']),
      'fee' => cleanString($_POST['fee'])
    ];

    // El BBCode recibido desde el formulario
    $bbcode = $_POST['content'] ?? '';

    //$bbcode = str_replace(PHP_EOL, '[br]', $bbcode);
    //$parser->parse($bbcode);

    // Parsear el BBCode
    //$parser->parse($bbcode);

    // Limpia el contenido del String
    $bbcode = cleanString($bbcode, false);

    // Convierte los saltos de linea en <br>
    $bbcode = nl2br2($bbcode);

    // Escapa el contenido del String
    $bbcode = escape($bbcode);

    // Agrega el contenido del String a la variable $thread
    $thread['content'] = $bbcode;


    // Verifica si el hilo contiene spam
    if (loadClass('core/extra')->containsSpam($thread['content']) or loadClass('core/extra')->containsSpam($thread['title']))
    {
      // Si contiene spam, cambia el estado del hilo
      $thread['status'] = 0;

      // Envia notificación al usuario
      newNotification($m_id, 0, 'spamInThread', $thread_id);
    }


    // Si no hay errores, actualiza el hilo
    $update = loadClass('forums/threads')->updateThread($thread_id, $thread, $deleted_images);

    if ($update['status'])
    {
      // Verifica que las imagenes que se quieren subir y las imagenes actuales no superen la cantidad de 9
      $imagesc = loadClass('core/db')->getCount('f_threads_images', 'id', [$thread_id, 'thread_id']);
      $images_count = 0;

      if (isset($_FILES['images']) && is_array($_FILES['images']['name']))
      {
        foreach ($_FILES['images']['name'] as $image)
        {
          if ($_FILES['images']['size'][$image] > 0)
          {
            $images_request++;
          }
        }
      }

      $images_count = $imagesc + $images_request;
      if ($images_count <= 9)
      {
        // Sube las nuevas imagenes al servidor
        $imagens = loadClass('forums/threads')->uploadImages();

        foreach ($imagens[1] as $image_url)
        {
          // Sube las imagenes a la base de datos
          loadClass('forums/threads')->newThreadImage($thread_id, $image_url);
        }

        $slug = loadClass('forums/threads')->getThreadSlug($thread_id);

        if ($thread['status'] == 0)
        {
          $msg[] = 'Se ha creado la publicación correctamente, pero el anuncio ha sido marcado como no publicado';
          setTI([$msg]);
          redirect('anuncio/' . $slug);
          exit;
        }
        // Verifica si se subieron las imagenes correctamente
        elseif ($imagens[0] === true)
        {
          // Si se subió al menos una foto, se elimina cualquier imagen vacia (evita dejar la imagen default)
          if ($imagens[1][0] != 'null')
          {

            loadClass('forums/threads')->deleteEmptyImages($thread_id);
          }

          $msg[] = 'Se ha acutalizado la publicación correctamente';
          setTI([$msg]);
          redirect('anuncio/' . $slug);
          exit;
        }
        else
        {
          $msg[] = 'Se ha acutalizado la publicación pero no se ha podido subir las imagenes';
          $msg[] = $imagens[1];
          setTI([$msg]);
          redirect('anuncio/' . $slug);
          exit;
        }
      }
      else
      {
        $msg[] = 'No puedes subir mas de 9 imagenes';
      }
    }
    else
    {
      $msg[] = 'No se pudo actualizar el anuncio. Inténtalo de nuevo.';
    }
  }
  setTI([$msg]);
  redirect('forums/edit.thread', ['thread_id' => $thread_id]);
  exit;
}

$msg = [];

if (!isset($_GET['thread_id']) or empty($_GET['thread_id']))
{
  $msg[] = 'No existe el anuncio';
}

$thread_id = escape($_GET['thread_id']);

if (!$thread = loadClass('forums/threads')->getThreadByIdBasic($thread_id))
{
  $msg[] = 'No existe el anuncio';
}

if (empty($msg))
{
  // Carga todos los contactos
  $contacts = loadClass('forums/f_contacts')->getAllContacts();

  // Carga todos los foros
  $locations = loadClass('forums/locations')->getAllLocations();

  // Carga todas las imagenes
  $images = loadClass('forums/threads')->getImagesByThreadId($thread['id']);
}
else
{
  setTI([$msg]);
  redirect('mi-panel/anuncios');
  exit;
}
