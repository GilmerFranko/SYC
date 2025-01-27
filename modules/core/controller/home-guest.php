<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página principal
 *
 *
 */

$page['name'] = 'Inicio';
$page['code'] = 'homeGuest';


// Optiene todos los foros
$forums = loadClass('admin/f_forums')->getAllForums();
