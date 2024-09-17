<?php
// Este archivo debe estar en un entorno donde se cargue el sistema correctamente
// Simulación de un usuario autenticado
$m_id = 1; // Cambia este ID por el ID de un usuario válido

// Simulación de un hilo
$thread_id = 10; // Cambia este ID por el ID de un hilo válido

// URL del controlador donde se manejan las renovaciones (ajusta según tu ruta)
$url = 'http://localhost/javierimpulso/sexoycontacto/forums/autorenueva.actions'; // Cambia esta URL a la correcta

// 1. Prueba de renovación manual
$dataManualRenew = [
  'do' => 'manualRenew',
  'thread_id' => $thread_id,
  'ajax' => true,
];

$responseManual = sendPostRequest($url, $dataManualRenew);
echo "Respuesta de la renovación manual: " . $responseManual . "<br>";

// 2. Prueba de activar auto-renueva (con renovación instantánea)
$dataAutoRenew = [
  'do' => 'enableAutoRenew',
  'thread_id' => $thread_id
];

$responseAuto = sendPostRequest($url, $dataAutoRenew);
echo "Respuesta de activar auto-renueva: " . $responseAuto . "<br>";

/**
 * Función para enviar solicitudes POST a un servidor
 */
function sendPostRequest($url, $data)
{
  // Inicializar cURL
  $ch = curl_init();

  // Configurar cURL
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Enviar la solicitud y obtener la respuesta
  $response = curl_exec($ch);

  // Cerrar cURL
  curl_close($ch);

  return $response;
}
