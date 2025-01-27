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

if (!$thread = loadClass('forums/threads')->getThread($thread_id, $m_id, true))
{
  $msg[] = 'No existe el anuncio';
}

// Verifica si el hilo esta desactivado y el usuario no es el propietario y si el usuario no es administrador/moderador
if ($thread['status'] != 1 and $thread['member_id'] != $m_id and !$session->is_admod)
{
  $msg[] = 'Anuncio no disponible';
}

if (!empty($msg))
{
  setTI([$msg]);
  redirect('core/home-guest');
  exit;
}

// Optener subforo y foro
$subforum = loadClass('forums/subforums')->getSubforumById($thread['subforum_id']);
$contact = loadClass('forums/f_forums')->getForumById($subforum['forum_id']);

$isFavorite = $thread['member_favorites'] > 0 ? true : false;


$page['name'] = $thread['title'];
$page['code'] = 'viewThread';
