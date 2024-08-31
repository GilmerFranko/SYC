<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página nueva publicacion
 *
 *
 */

$page['name'] = 'Mis anuncios';
$page['code'] = 'myThreads';

$page_index = isset($_GET['page']) ? escape($_GET['page']) : 1;

// Optiene todos los anuncios del usuario
$threads = loadClass('forums/threads')->getThreadsByMemberId($m_id, $page_index);
