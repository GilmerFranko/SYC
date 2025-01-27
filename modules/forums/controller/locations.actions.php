<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador que tiene lógica para las acciones de subforums
 *
 *
 */


if (isset($_POST['ajax']))
{
  // Si se ha enviado el GET para obtener todas las subforos de un foro
  if (isset($_GET['getAllSubforumByForum']))
  {
    $contactId = (int) $_GET['getAllSubforumByForum'];
    $subforums = loadClass('forums/subforums')->getSubforumsByForumId($contactId);
    echo json_encode($subforums['data']);
    exit;
  }
}
