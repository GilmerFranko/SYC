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

  // Devuelve estadisticas
  if ($_POST['do'] == 'stats')
  {
    $thread_id = escape($_POST['thread_id']);

    // Devuelve hilo
    $thread = getColumns('f_threads', ['id', 'views_count', 'count_favorites', 'count_renewals'], ['id', $thread_id]);

    // Optiene la cantidad de favoritos
    $count_favorites = $thread['count_favorites'];

    // Optiene la cantidad de veces que se ha renovado el hilo
    $count_autorenew = $thread['count_renewals'];

    // Optiene las visitas
    $views_count = $thread['views_count'];

    // Optiene las visitas detalladas del hilo
    $visits = loadClass('forums/threads')->getThreadVisitsLast10Days($thread['id']);

    // Verifica si el hilo tiene activado el auto-renueva
    $isAutoRenewEnabled = loadClass('forums/autorenueva')->isAutoRenewEnabled($thread['id']);


    $message = [
      'status' => true,
      'count_favorites' => $count_favorites,
      'count_autorenew' => $count_autorenew,
      'views_count' => $views_count,
      'visits' => $visits,
      'isAutoRenewEnabled' => $isAutoRenewEnabled
    ];
  }

  // Verifica si se ha pulsado el boton de eliminar anuncio (thread)
  elseif ($_POST['do'] == 'delete')
  {
    if (isset($_POST['thread_id']) and !empty($_POST['thread_id']))
    {
      $thread_id = escape($_POST['thread_id']);

      // Optiene el hilo
      $data = getColumns('f_threads', ['id', 'member_id'], ['id', $thread_id]);

      // Verifica si el hilo pertenece al usuario
      if ($data and $data['member_id'] == $m_id)
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
        $message = array('success' => false, 'msg' => 'No se ha podido eliminar el anuncio');
      }
    }
    else
    {
      $message = array('success' => false, 'msg' => 'No se ha podido eliminar el anuncio');
    }
  }

  echo json_encode($message);
}
