<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los depositos pendientes
 *
 *
 */

$page['name'] = 'Depositos Pendientes';
$page['code'] = 'pendingDeposits';



if (isset($_GET['page'])) $page = $_GET['page'];

else $page = 1;

$pendingDeposits = loadClass('admin/wallet')->getAllDeposits($page);
