<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Configuración del sitio
 *
 *
 */

// La dirección principal del sitio, sin slash final.
$config['base_url']     = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, -10);

// Dirección del sitio mediante carpetas, sin slash final.
$config['base_path']    = BG_DIR;

// Carpeta donde se alojan las imágenes del script
$config['images_url']   = $config['base_url'] . '/static/images';

// Dirección de avatares mediante url, sin el slash final.
$config['avatar_url']   = $config['base_url'] . '/filestore/uploads/avatar';

// Dirección del sitio mediante carpetas, sin el slash final.
$config['avatar_path']  = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'avatar';

// Carpeta donde se alojan las imagenes subidas a los canales
$config['channels_path'] = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'channels';
$config['channels_url']  = $config['base_url']  . '/filestore/uploads/channels/';

// Carpeta donde se alojan las imagenes subidas de las categoria contactos
$config['contacts_path'] = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'contacts';
$config['contacts_url']  = $config['base_url']  . '/filestore/uploads/contacts/';

// Carpeta donde se alojan los archivos con correos
$config['bulkemails_path']   = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'bulkemails';

/** Id predeterminado del referi principal **/
$config['referi_id'] = 1;

// Foto predefinida para usuarios registrados
$config['default_male_profile_photo']   = 'default-male-avatar-profile.png';
$config['default_female_profile_photo'] = 'default-female-avatar-profile.png';
