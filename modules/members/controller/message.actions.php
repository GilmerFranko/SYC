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

      // Optiene el ultimo mensaje que ha recibido el usuario receptor en este chat
      $lastMessage = loadClass('members/messages')->getLastMessage($data['from_member_id'], $data['to_member_id']);

      if ($messageId = loadClass('members/messages')->sendMessage($data))
      {
        $message = loadClass('members/messages')->getMessageById($messageId);

        if ($lastMessage != false)
        {
          // Verifica si el mensaje debe enviar correo al usuario (si han pasado 60 segundos desde el ultimo mensaje)
          $message['sendEmail'] = ((time() - $lastMessage['sent_at']) >= 60) ? true : false;
          error_log((time() - $lastMessage['sent_at']));
        }
        else
        {
          $message['sendEmail'] = false;
        }


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

  elseif ($_POST['do'] == 'sendEmail')
  {
    /* Enviar correo al usuario */
    // Optiene usuario to_member
    $to_member_id = cleanString($_POST['to_member_id']);
    $to_member = loadClass('admin/members')->getMember($to_member_id);
    // Envia correo
    loadClass('core/email')->sendEmail('newmessage', $to_member['email'], array('from_member' => $session->memberData, 'to_member' => $to_member));
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
