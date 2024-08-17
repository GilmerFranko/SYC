<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los formularios de contacto
 *
 *
 */

$page['name'] = 'Contactos';
$page['code'] = 'adminContactsViews';

// Optiene todos los contactos
$contacts = loadClass('admin/f_contacts')->getAllContacts();
