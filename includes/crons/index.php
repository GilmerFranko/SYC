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



ini_set('error_log', dirname(__FILE__) . '/error.log');

// INCLUYE LA BASE DE DATOS
require 'database.php';

require 'functions.php';

require 'autorenuevacron.class.php';


// Ejecutar el cron
$autoRenuevaCron = new AutoRenuevaCron();
$autoRenuevaCron->processAutoRenewals();
