<?php defined('SYC') || exit;

/**
/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de enviar mensaje
 *
 *
 */

$page['name'] = 'Enviar mensaje';
$page['code'] = 'sendMessage';



if (isset($_POST['do']))
{
  $msg = [];

  if ($_POST['do'] == 'sendMessage')
  {
    if (!isset($_POST['messageContent']) or empty($_POST['messageContent']))
    {
      $msg = ['status' => false, 'msg' => 'Debes introducir un mensaje'];
    }
    if (!isset($_POST['to_member_id']) or empty($_POST['to_member_id']))
    {
      $msg = ['status' => false, 'msg' => 'Debes seleccionar un usuario'];
    }

    if (empty($msg))
    {
      $data = [
        'from_member_id' => $m_id,
        'to_member_id' => cleanString($_POST['to_member_id']),
        'content' => cleanString($_POST['messageContent'])
      ];

      if ($messageId = loadClass('members/messages')->sendMessage($data))
      {
        $message = loadClass('members/messages')->getMessageById($messageId);

        $msg = ['status' => true, 'msg' => 'El mensaje se ha enviado correctamente', 'data' => $message];
      }
      else
      {
        $msg = ['status' => false, 'msg' => 'No se ha podido enviar el mensaje'];
      }
    }
  }
  elseif ($_POST['do'] == 'loadNewMessages')
  {
    $data = [
      'from_member_id' => $m_id,
      'to_member_id' => cleanString($_POST['to_member_id']),
      'lastMessageId' => cleanString($_POST['lastMessageId'])
    ];

    if ($msg = loadClass('members/messages')->getNewMessages($data))
    {
      // Marca todos los mensajes del usuario actual con el usuario receptor como leídos
      loadClass('members/messages')->markAllAsRead($m_id, $data['to_member_id']);
      $msg = ['status' => true, 'msg' => 'Se han cargado los mensajes', 'data' => $msg];
    }
    else
    {
      $msg = ['status' => false, 'msg' => 'No se han podido cargar los mensajes'];
    }
  }
  echo json_encode($msg);
}
else
{

  $msg = [];

  if (!isset($_GET['member_id']) or empty($_GET['member_id']))
  {
    $msg[] = 'No existe el usuario';
  }

  $member_id = intval($_GET['member_id']);

  if (!$memberReceiver = loadClass('members/member')->getMemberFromID($member_id))
  {
    $msg[] = 'No existe el usuario';
  }

  if (empty($msg))
  {
  }

  else
  {
    setTI([$msg]);
    redirect('core/home-guest');
    exit;
  }
}
