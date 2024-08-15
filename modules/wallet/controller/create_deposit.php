<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal para crear un nuevo depósito
 *
 *
 */

$page['name'] = 'Crear Deposito';
$page['code'] = 'createDeposit';

// Array para almacenar los mensajes de respuesta
$msg = [];

// Verificar si se ha enviado el formulario
if (isset($_POST['newDeposit']))
{
    $msg = []; // Inicializar el array de mensajes

    // Recoger los datos del formulario
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $binance_email = isset($_POST['binance_email']) ? $_POST['binance_email'] : '';
    $binance_id = isset($_POST['binance_id']) ? $_POST['binance_id'] : '';
    $binance_fullname = isset($_POST['binance_fullname']) ? $_POST['binance_fullname'] : '';
    $reference = isset($_POST['reference']) ? $_POST['reference'] : '';

    /* Escapar los datos */
    $amount = escape($amount);
    $binance_email = escape($binance_email);
    $binance_id = escape($binance_id);
    $binance_fullname = escape($binance_fullname);
    $reference = escape($reference);


    if (empty($amount))
    {
        $msg[] = ["El monto es obligatorio."];
    }
    if (empty($binance_email))
    {
        $msg[] = ["El correo electrónico de Binance es obligatorio."];
    }
    if (empty($binance_fullname))
    {
        $msg[] = ["El nombre completo de Binance es obligatorio."];
    }
    if (empty($reference))
    {
        $msg[] = ["La referencia es obligatoria."];
    }
    if ($amount > 150)
    {

        $msg[] = ["El monto debe ser menor a $150.00 USD"];
    }
    if ($amount < 10)
    {

        $msg[] = ["El monto debe ser mayor a $10.00 USD"];
    }

    // Si no hay mensajes de error, proceder con la creación del depósito
    if (empty($msg))
    {
        // Crear el depósito
        if ($deposit_id = loadClass('wallet/wallettransactions')->createDeposit($m_id, $amount, $binance_email, $binance_id, $binance_fullname, $reference))
        {
            $msg[] = ["¡Depósito creado correctamente!"];
            setToast($msg);
            redirect('wallet/view_deposit', ['deposit_id' => $deposit_id]);
            exit;
        }
        else
        {
            $msg[] = ["Error al crear el depósito."];
        }
    }
    setToast($msg);
}
