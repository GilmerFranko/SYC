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
        <div class="col s9">
          Bienvenido: Usuario
          <br>
          Tu saldo: 1312$
          <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
          </a>
        </div>
      </div>
      <!-- FIN DERECHA -->
    </div>
  </nav>
</header>