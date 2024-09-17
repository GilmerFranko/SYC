<?php

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que contiene funciones necesarias para los cronjobs
 *
 *
 */


/** Esta funcion es una copia identica a la de notifications.class.php
 * Se registra una notificaci�n
 * 
 * @param int $to_member
 * @param int $from_member SI ES 0 LO ENVIA LA ADMINISTRACION
 * @param string $key
 * @param int $item
 * @param int $subitem
 * @param text $content
 * @param boolean $myself (soy yo)
 * @param boolean $check (comprobar si ya existe)
 * @param int $time (Fecha de notificaci�n)
 * @return boolean
 */
function newNotification($to_member = null, $from_member = null, $key = 'general', $item = 0, $subitem = 0, $content = '', $myself = false, $check = false, $time = 'UNIX_TIMESTAMP()')
{
  global $db;

  error_log('hola');
  // EVITAR ENVIARME A M� MISMO
  //if($to_member != $from_member || $myself == true)
  if (true)
  {
    // GENERAR TEXTO DE NOTIFICACI�N
    //$content = $generateNotification($to_member, $from_member, $key, $item, $subitem);
    $content = '';

    // COMPROBAR SI YA EXISTE EN UN PERIODO DE UN MINUTO
    if ($check == true)
    {
      //$qcheck = $db->query('SELECT `id` FROM `members_notifications` WHERE `to_member` =  \''.$to_member.'\' && `from_member` = \''.$from_member.'\' && `not_key` = \'' . $db->real_escape_string($key) . '\' && `item_id` = \''.$item.'\' && `subitem_id` = \''.$subitem.'\' && `sent_time` > '.(time()-60).' LIMIT 1');
      $qcheck = $db->query('SELECT `id` FROM `members_notifications` WHERE `to_member` = \'' . $to_member . '\' && `sent_time` > ' . (time() - 60) . ' && `content` =  \'' . $db->real_escape_string($content) . '\' LIMIT 1');

      if ($qcheck->num_rows > 0)
      {
        return true;
      }
    }

    // CONSULTA A BD
    $query = $db->query('INSERT INTO `members_notifications` (`to_member`, `from_member`, `not_key`, `item_id`, `subitem_id`, `content`, `sent_time`) VALUES (\'' . $to_member . '\', \'' . $from_member . '\', \'' . $db->real_escape_string($key) . '\', \'' . $item . '\', \'' . $subitem . '\', \'' . $db->real_escape_string($content) . '\', ' . $time . ') ');

    if ($query == true)
    {
      // SUMAR ESTAD�STICA A USUARIO
      $db->query('UPDATE `members` SET `notifications` = `notifications` + 1 WHERE `member_id` = \'' . $to_member . '\' LIMIT 1');

      // TODO BIEN
      return true;
    }
  }
  //
  return false;
}
