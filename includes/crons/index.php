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

ini_set('error_reporting', E_ALL); // Report all errors (including E_STRICT)
ini_set('display_errors', 1); // Enable error display


// INCLUYE LA BASE DE DATOS
require 'database.php';
