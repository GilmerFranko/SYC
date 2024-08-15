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
$page['code'] = 'allWithdrawals';



if (isset($_GET['page'])) $page = $_GET['page'];

else $page = 1;

$withdrawals = loadClass('admin/wallet')->getAllWithdrawals($page);

$statusAr = [0 => 'Pendiente', 1 => 'Completado', 2 => 'Cancelado'];
