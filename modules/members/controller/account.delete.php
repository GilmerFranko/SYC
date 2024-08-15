<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de sección "Eliminar" en la cuenta
 *
 *
 */

if (isset($_POST['token']) && isset($_POST['currentPassword']))
{
    if ($session->checkToken($_POST['token']) === true)
    {
        if (password_verify($_POST['currentPassword'], $session->memberData['password']) === true)
        {
            // ELIMINAR CUENTA
            if (Core::model('access', 'members')->deleteAccount($session->memberData['member_id'], $session->memberData['group_id']) == true)
            {
                $message[] = array(
                    'Cuenta eliminada',
                    1
                );
            }
            else
            {
                $message[] = array(
                    'Problema al eliminar cuenta',
                    0
                );
            }
        }
        else
        {
            $message[] = array(
                'Contrase&ntilde;a actual incorrecta',
                0
            );
        }
    }
    else
    {
        $message[] = array(
            'Token incorrecto',
            0
        );
    }
}
else
{
    $message[] = array(
        'Faltan datos',
        0
    );
}

// FINALIZAR SCRIPT
die($message[0][1] . ':' . $message[0][0]);
