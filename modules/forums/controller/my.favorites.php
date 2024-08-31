<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de favoritos guardados
 *
 */

$page_index = isset($_GET['page']) ? escape($_GET['page']) : 1;


if (!$threads = loadClass('forums/threads')->getFavoritedThreads($m_id, $page_index))
{
  $msg[] = 'No hay anuncios para mostrar';
}

if (!empty($msg))
{
  setTI([$msg]);
  redirect('core/home-guest');
  exit;
}

$page['name'] = 'Favoritos';
$page['code'] = 'newThread';
