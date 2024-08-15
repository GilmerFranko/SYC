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


/** Marca un deposito como pagado **/
if (isset($_GET['mark_paid']) and isset($_GET['deposit_id']) and !empty($_GET['deposit_id']))
{
    $deposit_id = intval($_GET['deposit_id']);

    if (loadClass('admin/wallet')->completeDeposit($deposit_id))
    {
        $message[] = array('Deposito marcado como pagado', 'success');
    }
    else
    {
        $message[] = array('Error al marcar el deposito como pagado', 'error');
    }

    setToast($message);
    // Redirigir
    gLink('admin/wallet_pending_deposits', null, true);
    exit;
}

if (isset($_GET['page'])) $page = $_GET['page'];

else $page = 1;

$pendingDeposits = loadClass('admin/wallet')->getPendingDeposits($page);
