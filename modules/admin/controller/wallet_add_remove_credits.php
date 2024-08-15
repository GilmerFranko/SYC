<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal que permite Sumar y Restar créditos a los usuarios
 *
 *
 */

$page['name'] = 'Añadir/Retirar Créditos';
$page['code'] = 'pendingDeposits';

/** Agrega créditos al usuario **/
if (isset($_POST['ajax']))
{
    if (isset($_POST['add_or_remove']) and isset($_POST['member_id']) and is_numeric($_POST['member_id']) and isset($_POST['amount']) and is_numeric($_POST['amount']))
    {
        $member_id = intval($_POST['member_id']);
        $amount = floatval($_POST['amount']);

        if ($_POST['add_or_remove'] == 'add')
        {
            /**
             * Añade creditos al usuario y maneja los errores
             */
            if (loadClass('members/transactions')->updateBalance($member_id, $amount, true, 'addForAdmin'))
            {
                $msg = ['msg' => 'Se ha añadido el crédito correctamente', 'status' => 'success'];
            }
            else
            {
                $msg = ['msg' => 'Se ha producido un error al añadir el crédito', 'status' => 'error'];
            }
        }
        elseif ($_POST['add_or_remove'] == 'remove')
        {
            /**
             * Resta creditos al usuario y maneja los errores
             */
            if (loadClass('members/transactions')->updateBalance($member_id, $amount, false, 'removeForAdmin'))
            {
                $msg = ['msg' => 'Se ha retirado el crédito correctamente', 'status' => 'success'];
            }
            else
            {
                $msg = ['msg' => 'Se ha producido un error al retirar el crédito', 'status' => 'error'];
            }
        }
        echo json_encode($msg);
        exit;
    }
}

/* Verifica que se haya pasado el id del usuario */
if (isset($_GET['member_id']) and is_numeric($_GET['member_id']))
{


    $member_id = intval($_GET['member_id']);

    /** Optiene datos del usuario **/
    if (!$member = loadClass('admin/members')->getMember($member_id))
    {
        gLink('admin/dashboard', null, true);
        exit;
    }

    if (isset($_GET['page'])) $page = $_GET['page'];

    else $page = 1;

    $transactions = loadClass('admin/transactions')->getTransactions($member_id, $page);

    $reasonAr = [
        'addForAdmin'   => 'Anadido por el administrador',
        'removeForAdmin' => 'Removido por el administrador',
        'withdrawalUser' => 'Retiro de saldo',
    ];
}
else
{
    /* Redirige al dashboard */
    gLink('admin/dashboard', null, true);
    exit;
}
