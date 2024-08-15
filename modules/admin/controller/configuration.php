<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de la configuración del sitio
 *
 *
 */

$page['name'] = 'Configuraci&oacute;n - Administraci&oacute;n';
$page['code'] = 'adminConfiguration';
//
if (isset($_POST['save']))
{
    if (ctype_alnum($_POST['cookie_name']))
    {
        // NOMBRE DEL SITIO
        $data['script_name'] = empty($_POST['script_name']) ? 'SYC' : htmlspecialchars($_POST['script_name']);

        // CODIGO PUBLICIDAD 300X250
        $data['ad_300x250'] = empty($_POST['ad_300x250']) ? '' : $_POST['ad_300x250'];
        // ESTABLECER NOMBRE DE COOKIE
        $data['cookie_name'] = htmlspecialchars($_POST['cookie_name']);
        // ESTABLECER DURACIÓN DE COOKIE
        $data['cookie_time'] = empty($_POST['cookie_time']) ? 15 : (int)$_POST['cookie_time'];
        // CANTIDAD DE MENSAJES POR CANAL
        $data['limit_globals_messages'] = empty($_POST['limit_globals_messages']) ? 100 : (int)$_POST['limit_globals_messages'];
        // ESTABLECER NUMERO DE TELÉFONO
        $data['num_phone'] = escape($_POST['num_phone']);
        // ELEGIR RANGO POR DEFECTO
        $data['reg_group'] = empty($config['reg_group']) ? '3' : $config['reg_group'];
        // ELEGIR ESTADO DE VALIDACIÓN POR CORREO
        $data['reg_validate'] = empty($_POST['reg_validate']) ? '0' : '1';
        // ELEGIR ESTADO DE MANTENIMIENTO
        $data['maintenance'] = empty($_POST['maintenance']) ? '0' : '1';
        // ELEGIR ESTADO DE DEPURACIÓN
        $data['debug_mode'] = empty($_POST['debug_mode']) ? '0' : '1';
        // USUARIO QUE GUARDA
        $data['save_user'] = $session->memberData['member_id'];
        // IP QUE GUARDA
        $data['save_ip'] = Core::model('extra', 'core')->getIp();
        // FECHA DE GUARDADO
        $data['save_date'] = time();
        //
        $data['saved'] = Core::model('configuration', 'admin')->saveConfig($data);
        if (is_int($data['saved']))
        {
            $message[] = array('Configuraci&oacute;n actualizada. <a href="' . Core::model('extra', 'core')->generateUrl('admin', 'configuration', NULL, array('area' => 'delete', 'id' => $data['saved'])) . '" class="btn-flat toast-action">Deshacer</a>', 'success');
        }
        else
        {
            $message[] = array('No se pudieron guardar los cambios', 'error');
        }
    }
    else
    {
        $message[] = array('El nombre de la cookie debe ser alfanum&eacute;rico', 'error');
    }
    // ESTABLECER MENSAJE EN LA SESION
    $extra->setToast($message);
    //
    Core::model('extra', 'core')->generateUrl('admin', 'configuration', NULL, null, true);
}
else
{
    $save_name = isset($config['save_user']) ? Core::model('db', 'core')->getColumns('members', 'name', array('member_id', $config['save_user'])) : 'el sistema';
    $save_date = isset($config['save_date']) ? date('d/m/Y \a \l\a\s H:i', $config['save_date']) : 'siglo pasado';
}
