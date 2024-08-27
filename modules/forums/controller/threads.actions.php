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

  echo json_encode($message);
}
