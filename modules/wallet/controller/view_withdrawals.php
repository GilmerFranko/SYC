<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal para ver un retiro
 *
 *
 */

$page['name'] = 'Mis retiros';
$page['code'] = 'viewWithdrawals';




if (!$withdrawals = loadClass('wallet/wallettransactions')->getWithdrawals($m_id))
{
	/** Redirige al monedero **/
	setToast([['El retiro no existe', 'error']]);
	redirect('wallet/wallet');
	exit;
}

$statusAr = [0 => 'Pendiente', 1 => 'Completado', 2 => 'Cancelado'];
$classStatusAr = [0 => 'text-orange', 1 => 'text-green', 2 => 'text-red'];
