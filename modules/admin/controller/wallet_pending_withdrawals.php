<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los retiros pendientes
 *
 *
 */

$page['name'] = 'Retiros Pendientes';
$page['code'] = 'pendingWithdrawal';

if (isset($_GET['page'])) $page = $_GET['page'];

else $page = 1;

$pendingWithdrawals = loadClass('admin/wallet')->getPendingWithdrawals($page);
