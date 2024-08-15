<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal para ver un depósito
 *
 *
 */

$page['name'] = 'Ver Deposito';
$page['code'] = 'viewDeposit';


/** Comprueba el deposit_id, lo valdeposit_ida y escapa */
if (isset($_GET['deposit_id']) && ctype_digit($_GET['deposit_id']))
{
	$deposit_id = $_GET['deposit_id'];

	if (!$deposit = loadClass('wallet/wallettransactions')->getDeposit($deposit_id))
	{
		/** Redirige al monedero **/
		setToast([['El deposito no existe', 'error']]);
		redirect('wallet/wallet');
		exit;
	}

	$statusAr = [0 => 'Pendiente', 1 => 'Completado', 2 => 'Cancelado'];
	switch ($deposit['status'])
	{
		case 0:
			$classStatus = 's-pending';
			break;
		case 1:
			$classStatus = 's-completed';
			break;
		case 2:
			$classStatus = 's-canceled';
			break;
	}
}
/** Redirige al monedero **/
else
{
	setToast([['El deposito no existe', 'error']]);
	redirect('wallet/wallet');
	exit;
}
