<?php // defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para manejar la renovación manual y el auto-renueva de un hilo
 */

if (isset($_POST['do']) && isset($_POST['token']) && $session->checkToken($_POST['token']) === true)
{
  $message = array('status' => false, 'message' => 'Error');
  $thread_id = escape($_POST['thread_id']);
  $action = $_POST['do']; // Acción a realizar: renovar manualmente o activar auto-renueva
  $member_id = $m_id; // ID del usuario autenticado

  // Instanciar la clase AutoRenueva
  $autoRenueva = loadClass('forums/autorenueva');

  // Verifica que el usuario sea el propietario del hilo
  if (loadClass('forums/threads')->isThreadOwner($thread_id, $member_id) === true)
  {

    if ($action == 'manualRenew')
    {
      // Renovación manual
      if ($autoRenueva->manualRenew($thread_id, $member_id))
      {
        $message = array('status' => true, 'message' => 'Anuncio renovado manualmente');
      }
      else
      {
        $message = array('status' => false, 'message' => 'Error al renovar el anuncio');
      }
    }
    elseif ($action == 'enableAutoRenew')
    {
      // Verifica que no este activo el auto-renueva
      if ($autoRenueva->isAutoRenewEnabled($thread_id) == false)
      {
        // Activar auto-renueva con renovación instantánea
        if ($autoRenueva->activateAutoRenew($thread_id, $member_id))
        {
          $message = array('status' => true, 'message' => 'Auto-renueva activado y anuncio renovado');
        }
        else
        {
          $message = array('status' => false, 'message' => 'Error al activar auto-renueva');
        }
      }
      else
      {
        $message = array('status' => false, 'message' => 'Auto-renueva ya activado');
      }
    }
    // Desactivar auto-renueva
    elseif ($action == 'disableAutoRenew')
    {
      if ($autoRenueva->disableAutoRenew($thread_id))
      {
        $message = array('status' => true, 'message' => 'Auto-renueva desactivado');
      }
      else
      {
        $message = array('status' => false, 'message' => 'Error al desactivar auto-renueva');
      }
    }
    // Verificar si el hilo tiene activado el auto-renueva
    elseif ($action == 'isAutoRenewEnabled')
    {
      $message = array('status' => true, 'isAutoRenewEnabled' => $autoRenueva->isAutoRenewEnabled($thread_id));
    }
  }
  else
  {
    $message = array('status' => false, 'message' => 'No eres el propietario del hilo');
  }

  echo json_encode($message);
}
