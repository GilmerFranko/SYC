<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los reportes
 *
 *
 */

$page['name'] = 'Reportes';
$page['code'] = 'reports';

if (isset($_POST['ajax']) && isset($_POST['token']) && $session->checkToken($_POST['token']) === true)
{
  if (isset($_POST['suspend']) and !empty($_POST['suspend']))
  {
    $ban_member = escape($_POST['suspend']);

    if ($ban_member == $m_id)
    {
      $message = array('success' => false, 'msg' => 'No puedes suspenderte a ti mismo');
    }
    elseif (loadClass('admin/members')->isAdmod($ban_member) === true)
    {
      $message = array('success' => false, 'msg' => 'No puedes suspender a un administrador o moderador');
    }
    else
    {
      $reason = isset($_POST['reason']) ? escape($_POST['reason']) : 1;

      if (loadClass('admin/members')->banMember($ban_member, $reason))
      {
        $message = array('success' => true);
      }
      else
      {
        $message = array('success' => false, 'msg' => 'No se ha podido suspender al usuario');
      }
    }

    echo json_encode($message);
  }
}

else
{

  if (isset($_GET['byThreadId']) && !empty($_GET['byThreadId']))
  {
    $bythreadId = escape($_GET['byThreadId']);
    $reports = loadClass('admin/reports')->getReportsByThreadId($_GET['byThreadId']);
    if ($reports === false or $reports['rows'] <= 0)
    {
      gourl('admin/reports');
      exit;
    }
  }
  else
  {
    // Carga todo los reportes agrupados por hilo
    $reports = loadClass('admin/reports')->getAllReportsGroupByThread();
  }
}
