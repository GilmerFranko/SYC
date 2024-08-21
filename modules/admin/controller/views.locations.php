<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de la vista de ubicaciones (foros)
 *
 *
 */

$page['name'] = 'Ubicaciones';
$page['code'] = 'adminLocations';

$page_index = isset($_GET['page']) ? escape($_GET['page']) : 1;

$locations = loadClass('admin/locations')->getAllLocations($page_index);
