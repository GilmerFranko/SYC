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

if (!isset($_GET['location_url']) or empty($_GET['location_url']))
{
  redirect('core/home-guest');
}

$location_url = escape($_GET['location_url']);

if (!$location = getColumns('f_locations', ['id', 'short_url', 'contact_id'], ['short_url', $location_url]))
{
  redirect('core/home-guest');
}

if (!$threads = loadClass('forums/threads')->getThreadsByLocationId($location['id'], $location['short_url'], 4))
{
  $msg[] = 'No hay anuncios para mostrar';
}


if (!$contact = loadClass('forums/f_contacts')->getContactById($location['contact_id']))
{
  $msg[] = 'El contacto no existe';
}


if (!empty($msg))
{
  setTI([$msg]);
  redirect('core/home-guest');
  exit;
}

loadClass('forums/locations')->registerVisit($location['id'], $m_id, $session->memberData['ip_address']);

/* Se definen estas variables para el modulo search */
$_GET['location_id'] = $location['id'];
$_GET['contact_id'] = $contact['id'];

$page['name'] = $contact['name'];
$page['code'] = 'newThread';
