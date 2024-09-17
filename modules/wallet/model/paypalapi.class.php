<?php

class PayPalApi
{

  private $clientId = 'AZuS-tADF3ZPi4QpXiTXlLIMm5tq8U2JkDrrTf8eUaM4jrnMcj7VQ4Fg8-t3RJzJvgMM1bZGl3MeQeDr';
  private $secret = 'EKDxg6be2F21ZVNA64tXBdRa-_uLChb97hUq35wgP1eTs27UBOg6U0_Xjb6vz9-bkZh4zF1RPmjzbWL1';
  private $apiUrl = 'https://api-m.sandbox.paypal.com'; // Usar URL de producción si es necesario

  // Función para validar la orden con PayPal
  public function validarOrden($orderID)
  {
    // Obtener el token de acceso
    $token = $this->obtenerToken();

    if (!$token)
    {
      return ['status' => false, 'message' => 'No se pudo obtener el token de PayPal'];
    }

    // Hacer la solicitud para obtener los detalles de la orden
    $url = $this->apiUrl . "/v2/checkout/orders/" . $orderID;
    $headers = [
      "Authorization: Bearer " . $token,
      "Content-Type: application/json"
    ];

    $response = $this->hacerSolicitud('GET', $url, $headers);

    // Verificar si la respuesta es válida
    if ($response && isset($response['status']) && $response['status'] === 'COMPLETED')
    {
      return ['status' => 'COMPLETED', 'message' => 'Orden completada', 'response' => $response];
    }

    return ['status' => false, 'message' => 'Error en la validación de la orden', 'response' => $response];
  }

  // Función para obtener el token de acceso desde PayPal
  private function obtenerToken()
  {
    $url = $this->apiUrl . '/v1/oauth2/token';
    $headers = [
      "Authorization: Basic " . base64_encode($this->clientId . ":" . $this->secret),
      "Content-Type: application/x-www-form-urlencoded"
    ];

    $body = "grant_type=client_credentials";

    $response = $this->hacerSolicitud('POST', $url, $headers, $body);

    return $response['access_token'] ?? false;
  }

  // Función para realizar una solicitud HTTP
  private function hacerSolicitud($metodo, $url, $headers, $body = null)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($body)
    {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
  }
}

//$api = new PayPalApi();

//error_log(var_export($api->validarOrden('1D4464115F393013C'), 1));
