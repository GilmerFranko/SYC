<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página ver hilos
 *
 */

if (!isset($_GET['subforum_url']) or empty($_GET['subforum_url']))
{
  redirect('core/home-guest');
}

$subforum_url = escape($_GET['subforum_url']);

if (!$subforum = getColumns('f_subforums', ['id', 'short_url', 'forum_id'], ['short_url', $subforum_url]))
{
  redirect('core/home-guest');
}

if (!$threads = loadClass('forums/threads')->getThreadsBySubforumId($subforum['id'], $subforum['short_url'], 4))
{
  $msg[] = 'No hay anuncios para mostrar';
}


if (!$contact = loadClass('forums/f_forums')->getForumById($subforum['forum_id']))
{
  $msg[] = 'El foro no existe';
}


if (!empty($msg))
{
  setTI([$msg]);
  redirect('core/home-guest');
  exit;
}

if ($session->is_member)
  loadClass('forums/subforums')->registerVisit($subforum['id'], $m_id, $session->memberData['ip_address']);

/* Se definen estas variables para el modulo search */
$_GET['subforum_id'] = $subforum['id'];
$_GET['forum_id'] = $contact['id'];

$page['name'] = $contact['name'];
$page['code'] = 'newThread';
