<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de búsquedas
 *
 */

// Validar y obtener el ID de la categoría (forum_id)
$forum_id = isset($_GET['forum_id']) ? (int)escape($_GET['forum_id']) : null;
if ($forum_id && !is_numeric($forum_id))
{
  // Si el ID de la categoría no es válido
  $errors[] = "Categoría inválida.";
}

// Validar y obtener el ID de la ubicación (subforum_id)
$subforum_id = isset($_GET['subforum_id']) ? (int)escape($_GET['subforum_id']) : null;
if ($subforum_id && !is_numeric($subforum_id))
{
  // Si el ID de la ubicación no es válido
  $errors[] = "Ubicación inválida.";
}

// Validar las palabras clave
$words = isset($_GET['words']) ? trim(escape($_GET['words'])) : '';
if (!empty($words) && strlen($words) < 3)
{
  // Si las palabras clave son demasiado cortas
  $errors[] = "Las palabras clave deben tener al menos 3 caracteres.";
}

// Validar el orden de la búsqueda
$order_by = isset($_GET['order_by']) ? escape($_GET['order_by']) : '';
if ($order_by && !in_array($order_by, ['asc', 'desc']))
{
  $errors[] = "Orden de búsqueda inválido.";
}

// Si hay errores, se muestran al usuario
if (!empty($errors))
{
  // Aquí puedes redirigir al usuario a la página anterior o mostrar los errores
  setTI([$errors]);
  gourl('forums/view.searches');
  exit;
}

// Si no hay errores, proceder con la búsqueda
$threads_model = loadClass('forums/threads');
$params = [
  'forum_id' => $forum_id,
  'subforum_id' => $subforum_id,
  'words' => $words,
  'order_by' => $order_by
];

// Ejecutar la búsqueda con los parámetros validados
$search_results = $threads_model->searchThreads($params);

// Configurar la página
$page['name'] = "Búsqueda de Anuncios";
$page['code'] = 'searchResults';
