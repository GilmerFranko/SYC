<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los detalles de un deposito
 *
 *
 */

$page['name'] = 'Detalles de deposito';
$page['code'] = 'depositDetails';


/** Marca un deposito como pagado **/
if (isset($_GET['setStatus']) and isset($_GET['deposit_id']) and !empty($_GET['deposit_id']))
{
	$deposit_id = intval($_GET['deposit_id']);
	$status = intval($_POST['status']);

	/** Compara que el valor de $status sea entre 0 y 2 **/

	if (!in_array($status, [0, 1, 2]))

	{

		$message[] = array('Error al marcar el deposito como pagado', 'error');

		setToast($message);

		gLink('admin/wallet_deposit_details', ['deposit_id' => $deposit_id], true);

		exit;
	}


	if (loadClass('admin/wallet')->setDepositStatus($deposit_id, $status))
	{
		/** Envia notificacion al usuario de que se marco el deposito como pagado **/
		if ($status == 1)
		{
			/** Optiene datos de deposito **/
			$deposit = loadClass('admin/wallet')->getPendingDeposit($deposit_id);

			/** Enviar notificación al usuario **/
			newNotification($deposit['member_id'], $m_id, 'depositCompleted', $deposit['id']);
		}
		$message[] = array('Estado cambiado', 'success');
	}
	else
	{
		$message[] = array('Error al marcar el deposito como pagado', 'error');
	}

	setToast($message);
	// Redirigir
	gLink('admin/wallet_deposit_details', ['deposit_id' => $deposit_id], true);
	exit;
}

/** Verifica que se haya enviado el id del deposito **/
if (isset($_GET['deposit_id']) and !empty($_GET['deposit_id']))

{

	$deposit_id = intval($_GET['deposit_id']);
	$deposit = loadClass('admin/wallet')->getPendingDeposit($deposit_id);
}
else
{
	/** Muestra mensaje de error  y redirige **/
	setToast([['No se ha enviado el id del deposito', 'error']]);
	gLink('admin/wallet_pending_deposits', null, true);
	exit;
}
