<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal para crear un nuevo retiro
 *
 *
 */

$page['name'] = 'Crear Retiro';
$page['code'] = 'createWithdrawal';

// Array para almacenar los mensajes de respuesta
$msg = [];

// Verificar si se ha enviado el formulario
if (isset($_POST['newWithdrawal']))
{
    $msg = []; // Inicializar el array de mensajes

    // Recoger los datos del formulario
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $binance_email = isset($_POST['binance_email']) ? $_POST['binance_email'] : '';
    $binance_id = isset($_POST['binance_id']) ? $_POST['binance_id'] : '';
    $binance_fullname = isset($_POST['binance_fullname']) ? $_POST['binance_fullname'] : '';

    /* Escapar los datos */
    $amount = escape($amount);
    $binance_email = escape($binance_email);
    $binance_id = escape($binance_id);
    $binance_fullname = escape($binance_fullname);

    // Validaciones de los datos
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
    if ($amount < 25)
    {
        $msg[] = ["El monto mínimo para retiro es de $25.00 USD"];
    }
    if ($amount > 150)
    {
        $msg[] = ["El monto máximo para retiro es de $150.00 USD"];
    }
    // Validar si el usuario tiene saldo suficiente (agrega tu lógica de validación aquí)
    if (loadClass('members/transactions')->getBalance() < $amount)
    {
        $msg[] = ["No tienes saldo suficiente para realizar el retiro"];
    }

    // Si no hay mensajes de error, proceder con la creación del retiro
    if (empty($msg))
    {
        // Crear el retiro
        if ($withdrawal_id = loadClass('wallet/wallettransactions')->createWithdrawal($m_id, $amount, $binance_email, $binance_id, $binance_fullname))
        {
            $msg[] = ["¡Retiro creado correctamente!"];
            setToast($msg);
            redirect('wallet/view_withdrawals');
            exit;
        }
        else
        {
            $msg[] = ["Error al crear el retiro."];
        }
    }
    setToast($msg);
}
