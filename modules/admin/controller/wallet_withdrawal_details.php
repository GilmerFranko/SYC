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

$page['name'] = 'Detalles de retiro';
$page['code'] = 'withdrawalDetails';


/** Marca un retiro como pagado **/
if (isset($_GET['setStatus']) and isset($_GET['withdrawal_id']) and !empty($_GET['withdrawal_id']))
{
	$withdrawal_id = intval($_GET['withdrawal_id']);
	$status = intval($_POST['status']);

	/** El valor de $status debe ser entre 0 y 2 **/
	if (!in_array($status, [0, 1, 2]))

	{

		$message[] = array('Error al marcar el retiro como pagado', 'error');

		setToast($message);

		gLink('admin/wallet_withdrawal_details', ['withdrawal_id' => $withdrawal_id], true);

		exit;
	}


	if (loadClass('admin/wallet')->setWithdrawalStatus($withdrawal_id, $status))
	{
		/** Envia notificacion al usuario de que se marco el retiro como pagado **/
		if ($status == 1)
		{
			/** Optiene datos de retiro **/
			$withdrawal = loadClass('admin/wallet')->getWithdrawal($withdrawal_id);

			/** Enviar notificación al usuario **/
			newNotification($withdrawal['member_id'], $m_id, 'withdrawalCompleted', $withdrawal['id']);
		}
		/** Envia notificacion al usuario de que se marco el retiro como pagado **/
		elseif ($status == 2)
		{
			/** Optiene datos de retiro **/
			$withdrawal = loadClass('admin/wallet')->getWithdrawal($withdrawal_id);

			/** Enviar notificación al usuario **/
			newNotification($withdrawal['member_id'], $m_id, 'withdrawalCanceled', $withdrawal['id']);
		}

		$message[] = array('Estado cambiado', 'success');
	}
	else
	{
		$message[] = array('Error al marcar el retiro como pagado', 'error');
	}

	setToast($message);
	// Recargar Página
	gLink('admin/wallet_withdrawal_details', ['withdrawal_id' => $withdrawal_id], true);
	exit;
}

/** Verifica que se haya enviado el id del retiro **/
if (isset($_GET['withdrawal_id']) and !empty($_GET['withdrawal_id']))

{

	$withdrawal_id = intval($_GET['withdrawal_id']);

	if (!$withdrawal = loadClass('admin/wallet')->getWithdrawal($withdrawal_id))
	{
		setToast([['No se ha encontrado el retiro', 'error']]);
		gLink('admin/wallet_pending_withdrawals', null, true);

		exit;
	}
}
else
{
	/** Muestra mensaje de error  y redirige **/
	setToast([['No se ha enviado el id del retiro', 'error']]);
	gLink('admin/wallet_pending_withdrawals', null, true);
	exit;
}
