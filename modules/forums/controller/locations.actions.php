<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador que tiene lógica para las acciones de locations
 *
 *
 */


if (isset($_POST['ajax']))
{
  // Si se ha enviado el GET para obtener todas las ubicaciones de un contacto
  if (isset($_GET['getAllLocationByContact']))
  {
    $contactId = (int) $_GET['getAllLocationByContact'];
    $locations = loadClass('forums/locations')->getLocationsByContactId($contactId);
    echo json_encode($locations['data']);
    exit;
  }
}
