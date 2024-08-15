<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de los mensajes global
 *
 *
 */
$page['name'] = 'Mensajes';
$page['code'] = 'global_messages';

if (isset($_POST['ajax']))
{
    /**
     * Devuelve los mensajes de un canal
     */
    if (isset($_GET['getBasicDataChannel']))
    {
        $channel_id = intval($_GET['channel_id']);
        //$limit = escape($_GET['limit']);

        $maxID = isset($_POST['maxID']) ? escape($_POST['maxID']) : 0;

        /** Verifica que exista el canal */
        if (loadClass('global_messages/channels')->isChannelExist($channel_id))
        {

            /**
             * Optiene mensajes 
             */
            $data['status'] = true;
            $data['messages'] = loadClass('global_messages/messages')->getMessages($channel_id, $config['limit_globals_messages'], $maxID);
        }
        else
        {
            $data['status'] = false;
        }
        echo json_encode($data);
    }
}

/** Sube un achivo al canal **/
if (isset($_FILES['file_channel']) and isset($_POST['channel_id']))
{

    $channel_id = intval($_POST['channel_id']);

    // Llamamos a la función para subir una imagen
    if ($uploadResult = loadClass('global_messages/messages')->uploadFileInChannel($_FILES['file_channel'], $channel_id, $m_id))
    {
        $message[] = ($uploadResult);
    }
    else
    {
        $message[] = ('Error al subir el archivo');
    }



    setToast($message);

    /* Redirige */
    gLink('global_messages/view_messages', array('channel_id' => $channel_id), true);

    exit;
}


/**
 * Envia un mensaje en un canal
 */
elseif (isset($_GET['sendMessage']))
{
    $channel_id = intval($_GET['channel_id']);

    $message = escape($_POST['message']);

    /* El mensaje no puede tener mas de 1024 caracteres */
    if (strlen($message) > 1024)
    {
        $response = ['status' => false, 'message' => 'El mensaje no puede contener mas de 1024 caracteres'];
    }

    /* Comprueba que el canal exista */
    if (!$channel = loadClass('global_messages/channels')->getChannel($channel_id))
    {
        $response = ['status' => false, 'message' => 'El canal no existe'];
    }

    if (empty($response))
    {
        /** Envía el mensaje **/
        if ($data = loadClass('global_messages/messages')->sendMessage($channel_id, $m_id, $message))
        {
            /** Se envió el mensaje correctamente **/
            $response = array(
                'status' => true,
                'data' => $data
            );
        }
        else
        {
            $response = ['status' => false, 'message' => 'No se ha podido enviar el mensaje'];
        }
    }
    echo json_encode($response);
    exit;
}
elseif (!isset($_POST['ajax']))
{
    // Obtiene el id del canal
    $channel_id = 1;
    // Genera la URL del canal
    $chanelsrc = $config['channels_url'] . 'ID-' . $channel_id . '/';

    // Obtiene los últimos 5 mensajes del canal
    $messages = loadClass('global_messages/messages')->getMessages($channel_id, 5);

    // Obtiene el objeto del canal
    $channel = loadClass('global_messages/channels')->getChannel($channel_id);
}
