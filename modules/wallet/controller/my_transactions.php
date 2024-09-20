<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de las transacciones
 *
 *
 */

$page['name'] = 'Mis Transacciones';
$page['code'] = 'myTransactions';


if (isset($_GET['page'])) $page = $_GET['page'];

else $page = 1;

$transactions = loadClass('members/transactions')->getMyTransactions($page);

$reasonAr = [
	'addForAdmin'   => 'Anadido por el administrador',
	'removeForAdmin' => 'Removido por el administrador',
	'recharguePaypal' => 'Recarga mediante PayPal',
	'autoRenewal' => 'Auto Renovación',
];
