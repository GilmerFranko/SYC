<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de un hilo, esta pieza se encarga de mostrar 
 * la información de un hilo en la página de los hilos de un foro
 *
 */


if (!$subforum = getColumns('f_subforums', ['id', 'forum_id'], ['id', $thread['subforum_id']]))
{
  gourl('core/home-guest');
}

if (!$contact = loadClass('forums/f_forums')->getForumById($subforum['forum_id']))
{
  $msg[] = 'El foro no existe';
}

require Core::view('thread.piece', 'forums');
