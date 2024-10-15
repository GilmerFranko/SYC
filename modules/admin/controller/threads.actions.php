<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de las acciones para un hilo
 *
 *
 */

$page['name'] = 'Anuncios';
$page['code'] = 'threadsActions';

if (isset($_POST['ajax']) && isset($_POST['token']) && $session->checkToken($_POST['token']) === true)
{
  // Verifica si se ha pulsado el boton de suspender
  if (isset($_POST['suspend']) and !empty($_POST['suspend']))
  {
    $ban_member = escape($_POST['suspend']);

    if ($ban_member == $m_id)
    {
      $message = array('success' => false, 'msg' => 'No puedes suspenderte a ti mismo');
    }
    elseif (loadClass('admin/members')->isAdmod($ban_member) === true)
    {
      $message = array('success' => false, 'msg' => 'No puedes suspender a un administrador o moderador');
    }
    else
    {
      $reason = isset($_POST['reason']) ? escape($_POST['reason']) : 1;

      if (loadClass('admin/members')->banMember($ban_member, $reason))
      {
        $message = array('success' => true);
      }
      else
      {
        $message = array('success' => false, 'msg' => 'No se ha podido suspender al usuario');
      }
    }
    echo json_encode($message);
  }

  elseif (isset($_GET['activateThread']))
  {
    if (isset($_POST['thread_id']) and !empty($_POST['thread_id']))
    {
      $thread_id = escape($_POST['thread_id']);

      if ($response = loadClass('admin/thread')->activateThread($thread_id))
      {
        $message = array('success' => true, 'msg' => 'Anuncio activado');
      }
      else
      {
        $message = array('success' => false, 'msg' => 'No se ha podido activar el anuncio');
      }
    }
    else
    {
      $message = array('success' => false, 'msg' => 'No se ha podido activar el anuncio');
    }
    echo json_encode($message);
  }

  // Verifica si se ha pulsado el boton de eliminar anuncio (thread)
  elseif (isset($_GET['deleteThread']))
  {
    if (isset($_POST['thread_id']) and !empty($_POST['thread_id']))
    {
      $thread_id = escape($_POST['thread_id']);

      $password = isset($_POST['password']) ? escape($_POST['password']) : '';


      // VERIFICAR CONTRASEÑA
      if (password_verify($password, $session->memberData['password']) === true)
      {
        $response = loadClass('forums/threads')->deleteThread($thread_id);

        if ($response['status'] === true)
        {
          $message = array('success' => true, 'msg' => $response['msg']);
          setToast([[$response['msg']]]);
        }
        else
        {
          $message = array('success' => false, 'msg' => $response['msg']);
        }
      }
      else
      {
        $message = array('success' => false, 'msg' => 'Contraseña incorrecta');
      }
    }
    else
    {
      $message = array('success' => false, 'msg' => 'No se ha podido eliminar el anuncio');
    }
    echo json_encode($message);
  }
}

else
{

  if (isset($_GET['byThreadId']) && !empty($_GET['byThreadId']))
  {
    $bythreadId = escape($_GET['byThreadId']);
    $thread = loadClass('admin/thread')->getThreadById($_GET['byThreadId']);
    if ($thread === false)
    {
      gourl('admin/threads');
      exit;
    }
  }
  else
  {
    gourl('admin/threads');
    exit;
  }
}
