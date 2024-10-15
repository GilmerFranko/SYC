<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de pagina que muestra los anuncios con spam
 *
 *
 */

$page['name'] = 'Anuncios';
$page['code'] = 'adminThreads';

// PREFERENCIAS DE BÚSQUEDAS
$search = '';
if (isset($_REQUEST['search']))
{
  // DEFINIR
  $search = htmlspecialchars($_REQUEST['search']);
  $_SESSION['threads']['search'] = $search;
}
else
{
  if (isset($_SESSION['search']))
  {
    $search = $_SESSION['threads']['search'];
  }
}

// REDIRIGIR
if ((isset($_POST['search']) && !empty($_POST['search'])) || (isset($_SESSION['threads']['search']) && !isset($_GET['search'])))
{
  if (!isset($_POST['ajax']) && !empty($search))
  {
    Core::model('extra', 'core')->generateUrl('admin', 'threads', null, array('search' => $search), true);
  }
}


if ((!isset($_POST['ajax'])) or (isset($_POST['ajax']) && isset($_GET['page'])))
{
  $search = isset($_GET['search']) ? escape($_GET['search']) : '';
  $params['threads_spam'] = true;

  if ($search != '')
    $params['search'] = $search;


  // Optiene todos los hilos (anuncios)
  $threads = loadClass('admin/thread')->getAllThreadsWithSpam($params);
  if (isset($_POST['ajax']))
  {
    echo '1: ';
    require Core::view('t_with_spams.area', 'admin');
    exit;
  }
}
