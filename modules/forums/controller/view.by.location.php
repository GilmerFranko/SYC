<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de búsqueda por ubicación
 *
 */


// Validar las palabras clave
$subforum_name = isset($_GET['subforum_name']) ? trim(escape($_GET['subforum_name'])) : '';
if (!empty($subforum_name) && strlen($subforum_name) < 3)
{
  // Si las palabras clave son demasiado cortas
  $errors[] = "Las palabras clave deben tener al menos 3 caracteres.";
}

// Si hay errores, se muestran al usuario
if (!empty($errors))
{
  // redirigir al usuario a la página anterior o mostrar los errores
  setTI([$errors]);
  gourl('forums/view.searches');
  exit;
}

// Si no hay errores, proceder con la búsqueda
$threads_model = loadClass('forums/threads');
$params = [
  'subforum_name' => $subforum_name
];

// Ejecutar la búsqueda con los parámetros validados
$search_results = $threads_model->searchThreadsBySubforumName($params);

// Configurar la página
$page['name'] = "Anuncios en " . $subforum_name;
$page['code'] = 'searchResults';

// Mostrar la página
require Core::view('view.searches', 'forums');
