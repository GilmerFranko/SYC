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
$location_name = isset($_GET['location_name']) ? trim(escape($_GET['location_name'])) : '';
if (!empty($location_name) && strlen($location_name) < 3)
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
  'location_name' => $location_name
];

// Ejecutar la búsqueda con los parámetros validados
$search_results = $threads_model->searchThreadsByLocationName($params);

// Configurar la página
$page['name'] = "Anuncios en " . $location_name;
$page['code'] = 'searchResults';

// Mostrar la página
require Core::view('view.searches', 'forums');
