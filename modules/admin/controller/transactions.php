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

$page['name'] = 'Movimientos';
$page['code'] = 'transacctions';

$transactions = loadClass('admin/transactions')->getAllTransactions();

$reasonAr = [
    'addForAdmin'   => 'Anadido por el administrador',
    'removeForAdmin' => 'Removido por el administrador',
    'withdrawalUser' => 'Retiro de saldo',
    'recharguePaypal' => 'Recarga mediante PayPal',
    'autoRenewal' => 'Auto Renovación',
];

if (isset($_POST['ajax']) && isset($_GET['page']))
{
    echo '1: ';
    require Core::view('transactions.area', 'admin');
    exit;
}
