<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los formularios de foro
 *
 *
 */

$page['name'] = 'Foros';
$page['code'] = 'adminForumsViews';

// Optiene todos los foros
$forums = loadClass('admin/f_forums')->getAllForums();
