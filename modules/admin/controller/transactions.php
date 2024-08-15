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

$page['name'] = 'Transacciones';
$page['code'] = 'transacctions';

if (isset($_GET['page'])) $page = $_GET['page'];

else $page = 1;

$transactions = loadClass('admin/transactions')->getAllTransactions($page);

$reasonAr = [
    'addForAdmin'   => 'Anadido por el administrador',
    'removeForAdmin' => 'Removido por el administrador',
    'withdrawalUser' => 'Retiro de saldo',
];
