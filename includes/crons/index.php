<?php

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo inicial que ejecuta los crons
 *
 *
 */

// DEFINE LA CABECERA
define('SYC', TRUE);

// DEFINE DIRECTORIO PRINCIPAL
define('BG_DIR', str_replace("includes", '', dirname(__DIR__)));

// DEFINE DIRECTORIO DE IMAGENES
define('BG_IMAGES', BG_DIR . 'filestore' . DIRECTORY_SEPARATOR);

// Mostrar todos los errores
error_reporting(-1);
ini_set('display_errors', 1);

// Mostrar errores en el archivo error.log
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error.log');

// INCLUYE LA BASE DE DATOS
require 'database.php';

require 'functions.php';

require 'autorenuevacron.class.php';

// Ejecutar el cron
$autoRenuevaCron = new AutoRenuevaCron();
$autoRenuevaCron->processAutoRenewals();
