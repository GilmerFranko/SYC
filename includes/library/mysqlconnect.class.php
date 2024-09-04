<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de crear la conexion con la base de datos
 *
 *
 */

/* Archivo de configuración de la base de datos */
require BG_DIR . 'config.db.php';

/* Creamos la conexión */
$dbconnect = new MySQLi($db['hostname'], $db['username'], $db['userpass'], $db['database']);


/* Si hay algún error, lo mostramos */
if ($dbconnect->connect_errno)
{
  die('Error al conectar: ' . $dbconnect->connect_error);
}

/*  */
$dbconnect->set_charset("utf8mb4");
