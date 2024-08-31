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


if (!$location = getColumns('f_locations', ['id', 'contact_id'], ['id', $thread['location_id']]))
{
  gourl('core/home-guest');
}

if (!$contact = loadClass('forums/f_contacts')->getContactById($location['contact_id']))
{
  $msg[] = 'El contacto no existe';
}

require Core::view('thread.piece', 'forums');
