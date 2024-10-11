<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de vista de los mensajes
 *
 *
 */

$msg = [];

if (!isset($_GET['r_id']) or empty($_GET['r_id']))
{
  $msg[] = 'No se ha enviado el ID del usuario receptor.';
}

$receiverId = intval($_GET['r_id']);

// Obtener los datos del usuario receptor (para mostrar la conversación)
if (!$memberReceiver = getColumns('members', ['member_id', 'name', 'pp_thumb_photo'], ['member_id', $receiverId]))
{
  $msg[] = 'El usuario receptor no existe.';
}

// Verifica que el usuario receptor no sea el usuario actual
if ($m_id == $receiverId)
{
  $msg[] = 'No puedes enviarte un mensaje a ti mismo.';
  setTI([$msg]);
  redirect('mensajes/todos');
  exit;
}

if (!empty($msg))
{
  setTI([$msg]);
  redirect('core/home-guest');
  exit;
}

// Obtener los mensajes entre el usuario actual y el receptor
$messages = loadClass('members/messages')->getMessagesBetween($m_id, $receiverId);

// Marcar mensajes como leido
loadClass('members/messages')->markAllAsRead($m_id, $receiverId);


$page['name'] = 'Mensajes con ' . $memberReceiver['name'];
$page['code'] = 'membersRegister';
