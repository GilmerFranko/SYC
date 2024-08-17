<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que incluye parte de la cabecera
 */
?>
<header>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <nav class="">

    <!-- Menu para miembros -->
    <div class="">
      <div class="row">

        <div class="col s3">
          <!-- Logo -->
          <a href="<?php echo $config['base_url'] ?>" style="font-weight: 600;">
            <img class="hide-on-small-only" src="<?php echo $config['images_url'] . '/pasion.gif' ?>" alt="" style="padding: 5px; width: 140px;">
          </a>
        </div>
        <div class="col s3">
          <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $session->memberData['name']; ?>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'account'); ?>">Mi cuenta</a></li>
              <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'configuration'); ?>">Configuraci&oacuten</a></li>
              <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'logout'); ?>">Salir</a></li>
            </ul>
          </div>
        </div>

      </div>
      <!-- FIN DERECHA -->
    </div>
  </nav>
</header>