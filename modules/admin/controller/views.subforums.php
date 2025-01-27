<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de la vista de subforos (foros)
 *
 *
 */

$page['name'] = 'Ubicaciones';
$page['code'] = 'adminSubforums';

$page_index = isset($_GET['page']) ? escape($_GET['page']) : 1;

$subforums = loadClass('admin/subforums')->getAllSubforums($page_index);
