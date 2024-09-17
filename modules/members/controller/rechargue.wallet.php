<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para manejar la validación de pagos PayPal
 *
 *
 */

$page['name'] = 'Recargar Créditos';
$page['code'] = 'membersRechargueWallet';



if (isset($_POST['orderID']) && isset($_POST['token']) && $session->checkToken($_POST['token']) === true)
{
  $message = ['status' => false, 'message' => 'Error'];

  $orderID = escape($_POST['orderID']);
  $member_id = $m_id; // ID del usuario autenticado
  $creditos = isset($_POST['creditos']) ? escape($_POST['creditos']) : 0;
  $precio = isset($_POST['precio']) ? escape($_POST['precio']) : 0;

  // Verifica que se haya recibido un ID de la orden
  if (empty($orderID))
  {
    $message['message'] = 'Falta el ID de la orden';
  }
  else
  {
    // Instancia para PayPal API
    $paypalApi = loadClass('wallet/paypalapi');

    // Validar la orden con PayPal
    $validacion = $paypalApi->validarOrden($orderID);


    // Valida si la orden fue validada y completada correctamente
    if ($validacion['status'] === 'COMPLETED')
    {

      $amount = $validacion['response']['purchase_units'][0]['amount']['value'];
      $email = $validacion['response']['payer']['email_address'];
      $status = $validacion['status'];

      // Aplicar los créditos al usuario
      if (loadClass('members/transactions')->updateBalance($member_id, $amount, true, 'recharguePaypal') === true)
      {
        $message = ['status' => true, 'message' => 'Pago validado y créditos aplicados'];
      }
      else
      {
        $message['message'] = 'Error al aplicar los créditos';
      }
    }
    else
    {
      // La validación falló
      $message['message'] = 'Error en la validación de la orden con PayPal';
    }
  }

  // Responder con el resultado de la validación
  echo json_encode($message);
}
