<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de acciones de los hilos (anuncios)
 *
 *
 */
// Comprobar si se ha especificado alguna opción
if (isset($_POST['do']))
{
  $message = array('status' => false, 'message' => 'Error');
  $thread_id = escape($_POST['thread_id']);
  // Guardar en favoritos
  if ($_POST['do'] == 'addFavorite')
  {
    // Verifica si no es favorito, si no es favorito lo agrega
    if (!loadClass('forums/favorites')->isFavorite($m_id, $thread_id))
    {
      if (loadClass('forums/favorites')->addFavorite($m_id, $thread_id) === true)
      {
        $message = array('status' => true, 'message' => 'Guardado en favoritos');
      }
      else
      {
        $message = array('status' => false, 'message' => 'Error al guardar en favoritos');
      }
    }
    // Si es favorito lo elimina
    else
    {
      if (loadClass('forums/favorites')->removeFavorite($m_id, $thread_id) === true)
      {
        $message = array('status' => true, 'message' => 'Eliminado de favoritos');
      }
      else
      {
        $message = array('status' => false, 'message' => 'Error al eliminar de favoritos');
      }
    }
  }

  // Reportar
  if ($_POST['do'] == 'report')
  {
    if (!isset($_POST['thread_id']) or empty($_POST['thread_id']))
    {
      $msg = array('status' => false, 'message' => 'Error');
    }

    if (!isset($_POST['reason']) or empty($_POST['reason']))
    {
      $msg = array('status' => false, 'message' => 'Er2ror');
    }

    if (isset($_POST['customReason']) and !empty($_POST['customReason']) and $_POST['customReason'] != '')
    {
      $_POST['reason'] = $_POST['customReason'];
    }

    if (empty($msg))
    {
      $thread_id = escape($_POST['thread_id']);
      $reason = escape($_POST['reason']);

      $data = [
        'thread_id' => $thread_id,
        'reported_by_member_id' => $m_id,
        'reason' => $reason
      ];

      if (loadClass('forums/threads')->reportThread($data) !== false)
      {
        $message = array('status' => true, 'message' => 'Anuncio reportado');
      }
      else
      {
        $message = array('status' => false, 'message' => 'Error al reportar');
      }
    }
  }

  echo json_encode($message);
}
