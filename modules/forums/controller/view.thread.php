<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página Ver un Hilo (anuncio)
 *
 */

if (!isset($_GET['thread_id']) or empty($_GET['thread_id']))
{
  redirect('core/home-guest');
}

$thread_id = escape($_GET['thread_id']);

if (!$thread = loadClass('forums/threads')->getThreadById($thread_id, $m_id))
{
  $msg[] = 'No existe el anuncio';
}

// Optener ubicacion y contacto
$location = loadClass('forums/locations')->getLocationById($thread['location_id']);
$contact = loadClass('forums/f_contacts')->getContactById($location['contact_id']);

$isFavorite = $thread['member_favorites'] > 0 ? true : false;

if (!empty($msg))
{
  setTI([$msg]);
  redirect('core/home-guest');
  exit;
}

$page['name'] = $thread['title'];
$page['code'] = 'viewThread';
