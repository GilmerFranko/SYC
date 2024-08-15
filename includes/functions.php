<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que contiene varias funciones intuitivas, rápidas e imprescindibles
 *
 *
 */

/**
 * Carga una clase de un modulo
 * @param  String $route Ruta
 * @return Class
 */
function loadClass(String $route)
{
    if ($route = explode('/', $route))
    {
        return Core::model($route[1], $route[0]);
    }
    return false;
}

/**
 * Carga la clase relacionada a una tabla
 * @param  String $tabla Nombre de la tabla
 * @return Class
 */
function db(String $table)
{
    return LoadTable::model($table . 'DB');
}

/**
 * Muestra un texto en la consola del navegador
 * @param  string $string
 */
function showlog($string = '', $var_export = true)
{
    if ($var_export)
    {
        $string = var_export($string, 1);
    }

    echo '<script>console.log(\'' . str_replace(array("'", '"'), array("\\'", '\"'), $string) . '\')</script>';
    setToast([$string]);
    error_log($string);
}


function setToast($data)
{
    loadClass('core/extra')->setToast($data);
}

function setSwal($data)
{
    loadClass('core/extra')->setSwal($data);
}
/**
 * Escapa un string de inyeccion sql
 */
function esc($string)
{
    return db()->real_escape_string($string);
}

/**
 * Genera un enlace
 * (funcion minimizada)
 */
function gLink($route = null, $params = null, $redirect = false)
{
    if ($route = explode('/', $route))
    {
        if (!isset($route[1]) or empty($route[1]))
        {
            $route[1] = '';
        }
        return loadClass('core/extra')->generateUrl($route[0], $route[1], null, $params, $redirect);
    }
}

/**
 * Redirige a un enlace
 * (funcion minimizada)
 */
function redirect($route = null, $params = null)
{
    if ($route = explode('/', $route))
    {
        return loadClass('core/extra')->generateUrl($route[0], $route[1], null, $params, true);
    }
}

function gourl($route, $params = null)
{
    if ($route = explode('/', $route))
    {
        $url = loadClass('core/extra')->generateUrl($route[0], $route[1], null, $params);

        echo '<meta http-equiv="refresh" content="0; url=' . $url . '">';
        exit;
    }
}



/**
 * 
 */
function escape($string, $connect = null)
{
    global $extra;
    if ($connect == null)
    {
        $connect = $extra->db;
    }
    return $connect->real_escape_string($string);
}

/**Envia notificacion al usuario **/
function newNotification($to_member = null, $from_member = null, $key = 'general', $item = 0, $subitem = 0, $content = '', $myself = false, $check = false, $time = 'UNIX_TIMESTAMP()')
{
    return loadClass('members/notifications')->newNotification($to_member, $from_member, $key, $item, $subitem, $content, $myself, $check, $time);
}

/* Establecer mensaje de debug */
function debug($string)
{
    $_SESSION['debug'][] = $string;
    error_log($string);
}

/* Devuelve mensajes de debug en HTML con colores */
function debugHTML()
{
    if (isset($_SESSION['debug']))
    {
        foreach ($_SESSION['debug'] as $string)
        {
            echo '<span class="blue-text">' . $string . '</span><br>';
        }
    }
    unset($_SESSION['debug']);
}

/**
 * Genera un identificador único
 */
function generateUUID($length = 28)
{
    $key = substr(md5(uniqid(true) . microtime()), 0, $length);
    //
    return $key;
}

/**
 * Optiene el saldo de un usuario
 */
function getBalance($member_id = null)
{
    return loadClass('members/member')->getBalance($member_id);
}
