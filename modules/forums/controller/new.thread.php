<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página nueva publicacion
 *
 *
 */

$page['name'] = 'Nueva publicación';
$page['code'] = 'newThread';


if (isset($_GET['new_thread']))
{
  $msg = [];

  // Verifica si no se ha introducido un t&iacute;tulo
  if (!isset($_POST['title']) || empty($_POST['title']))
  {
    $msg[] = 'Debes introducir un t&iacute;tulo';
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

  // Verifica si no se ha seleccionado una ubicación
  if (!isset($_POST['subforum_id']) || empty($_POST['subforum_id']) || !is_numeric($_POST['subforum_id']))
  {
    $msg[] = 'Debes seleccionar una ubicación';
  }

  // Verifica si no se ha seleccionado una categoría
  if (!isset($_POST['forum_id']) || empty($_POST['forum_id']) || !is_numeric($_POST['forum_id']))
  {
    $msg[] = 'Debes seleccionar una categoría';
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

  // Verifica si no hay errores
  if (empty($msg))
  {

    // Limpia los campos
    $thread = [
      'member_id' => $m_id,
      'title' => cleanString($_POST['title']),
      'email' => cleanString($_POST['email']),
      'phone' => cleanString($_POST['phone']),
      'subforum_id' => cleanString($_POST['subforum_id']),
      'fee' => cleanString($_POST['fee']),
      'created_at' => time(),
      'ip_address' => Core::model('extra', 'core')->getIp()
    ];

    $forum_id = cleanString($_POST['forum_id']);

    // El BBCode recibido desde el formulario
    $bbcode = $_POST['content'] ?? '';

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
    }

    // Verifica que exista la subforo
    // Que esté activa
    // Y pertenezca al foro (foro)
    if ($subforum = loadClass('forums/subforums')->getSubforumById($thread['subforum_id']))
    {
      if (loadClass('forums/subforums')->isActive($subforum['id']))
      {
        if ($subforum['forum_id'] == $forum_id)
        {
          if ($thread_id = loadClass('forums/threads')->newThread($thread))
          {

            // Sube las imagenes al servidor
            $imagens = loadClass('forums/threads')->uploadImages();

            $slug = loadClass('forums/threads')->getThreadSlug($thread_id);

            foreach ($imagens[1] as $image_url)
            {
              // Sube las imagenes a la base de datos
              loadClass('forums/threads')->newThreadImage($thread_id, $image_url);
            }
            if ($thread['status'] === 0)
            {
              // Envia notificación al usuario
              newNotification($m_id, 0, 'spamInThread', $thread_id);


              $msg[] = 'Se ha creado la publicación correctamente, pero el anuncio ha sido marcado como no publicado';
              setTI([$msg]);
              redirect('anuncio/' . $slug);
              exit;
            }
            // Verifica si se subieron las imagenes correctamente
            elseif ($imagens[0] === true)
            {
              $msg[] = 'Se ha creado la publicación correctamente';
              setTI([$msg]);
              redirect('anuncio/' . $slug);
              exit;
            }
            else
            {
              $msg[] = 'Se ha creado la publicación pero no se ha podido subir las imagenes';
              $msg[] = $imagens[1];
              setTI([$msg]);
              redirect('anuncio/' . $slug);
              exit;
            }
          }
          else
          {
            $msg[] = 'No se ha podido crear la publicación';
          }
        }
        else
        {
          $msg[] = 'La ubicación no pertenece al foro (foro)';
        }
      }
      else
      {
        $msg[] = 'La ubicación no está activa';
      }
    }
    else
    {
      $msg[] = 'La ubicación no existe';
    }
  }


  setTI([$msg]);
  redirect('forums/new.thread');
  exit;
}



// Carga todos los foros
$forums = loadClass('forums/f_forums')->getAllForums();

// Carga todos los foros
$subforums = loadClass('forums/subforums')->getAllSubforums();
