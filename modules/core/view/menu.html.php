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

<style>
  .menu-member {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    font-weight: 700;
  }

  .menu-head-left {
    margin-right: 10px;
    width: 80%;
  }

  .menu-balance {
    box-shadow: 0px 1px 3px -1px var(--primary-300);
    background: var(--primary);
    color: white !important;
    margin: 0 0 0 8px;
  }

  .brand-logo {
    padding: 5px;
    width: 420px;
    margin-left: 103px;

    img {
      width: 100%;
    }
  }

  .body-menu-head {
    display: flex;
    align-items: center;
    height: 160px
  }

  @media only screen and (max-width: 1000px) {
    .brand-logo {
      margin-left: 30px;
    }

    .footer-menu-head {
      font-size: 12px;
    }
  }

  @media only screen and (max-width: 767px) {
    .brand-logo {
      margin-left: 10px;
      width: 200px;
    }

    .menu-head-left-mobile {
      width: 70%;
    }

    .body-menu-head {
      height: max-content;
    }

    .menu-member {
      flex-wrap: wrap;
    }

    nav {
      height: max-content;
    }

    .footer-menu-head {
      font-size: 10px;
      padding: 10px;
    }
  }
</style>
<header>
  <nav>
    <div class="body-menu-head">
      <div class="align-items-center brand-logo">
        <!-- Logo -->
        <img class="" src="<?= $extra->getLogo() ?>" alt="" onclick="location.href='<?php echo $config['base_url'] ?>'">
      </div>

      <div class="menu-head-left">
        <div class="menu-member">
          <?php if ($session->is_member): ?>
            <!-- Menu para miembros -->
            <!-- Cuenta -->
            <div class="dropdown btn btn-head">
              <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- Imagen del usuario -->
                <img src="<?= $config['avatar_url'] . '/' . $session->memberData['pp_main_photo']  ?>" alt="Imagen de perfil" style="width: 26px; height: 26px; border-radius: 10%; object-fit: cover; margin-right: 8px;" class="d-inline-block">

                <!-- Nombre del usuario (se oculta en pantallas pequeñas) -->
                <span class="d-none d-md-inline">
                  <?php echo strtoupper($session->memberData['name']); ?>
                </span>
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <!-- MI CUENTA -->
                <li>
                  <a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'profile'); ?>">Mi perfil</a>
                </li>
                <li>
                  <a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('wallet', 'my_transactions'); ?>">Monedero</a>
                </li>
                <!-- Mis anuncios -->
                <li>
                  <a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('mi-panel', 'anuncios'); ?>">Mis anuncios</a>
                </li>
                <!-- Favoritos -->
                <li>
                  <a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('anuncios', 'favoritos'); ?>">Favoritos</a>
                </li>
                <li>
                  <a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'account'); ?>">Mi cuenta</a>
                </li>
                <hr>
                <!-- CONFIGURACION (solo para admins) -->
                <?php if (loadClass('admin/members')->isAdmod($m_id) == 1): ?>
                  <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'configuration'); ?>">Configuraci&oacuten</a></li>
                <?php endif; ?>
                <hr>
                <!-- CERRAR SESION -->
                <li>
                  <a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'logout', null, ['token' => $session->token]); ?>">Salir</a>
                </li>
              </ul>


              <!-- Notificaciones -->
              <a class="btn btn-sm d-flex justify-content-center" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'notifications'); ?>">
                <i class="material-icons">notifications</i>
                <?php if ($session->memberData['notifications'] > 0)
                {
                  echo "(" . $session->memberData['notifications'] . ")";
                } ?>
              </a>
              <!-- Mensajes -->
              <?php if (!isset($session->memberData['unread_messages']) or $session->memberData['unread_messages']  <= 0): ?>
                <a class="btn btn-sm d-flex justify-content-center" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'messages'); ?>">
                  <i class="material-icons">mail</i>
                </a>
              <?php else: ?>
                <!-- Si hay mensajes sin leer -->
                <a class="btn btn-sm d-flex justify-content-center dark" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'messages'); ?>">
                  <i class="material-icons">mail</i>
                  <?php echo $session->memberData['unread_messages']; ?>
                </a>
              <?php endif; ?>
            </div>

          <?php else: ?>
            <!-- Menu para no miembros -->

            <a class="btn btn-sm d-flex justify-content-center dark btn-head" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'login'); ?>"><strong>INICIAR<br>SESION</strong>
            </a>
            <a class="btn btn-sm d-flex justify-content-center dark btn-head" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'register'); ?>"><strong>REGISTRO</strong></a>

          <?php endif; ?>
        </div>
        <div class="mt-3 menu-member">
          <a class="btn btn-sm d-flex justify-content-center btn-head" href="<?= gLink('forums/new.thread') ?>"><strong>&nbsp;PUBLICAR<br>&nbsp;ANUNCIOS</strong>
          </a>
          <a class="btn btn-sm d-flex justify-content-center btn-head" href="<?= gLink('mi-panel/anuncios') ?>"><strong>&nbsp;MODIFICAR<br>&nbsp; ANUNCIOS</strong></a>
          <a class="btn btn-sm d-flex justify-content-center btn-head" href="<?= gLink('anuncios/favoritos') ?>"><strong>&nbsp; ANUNCIOS<br>&nbsp;FAVORITOS</strong></a>
        </div>
      </div>
      <!-- Botones -->
      <?php require Core::view('menu.head.mobile', 'core'); ?>
    </div>

    <div class="footer-menu-head d-flex align-items-center justify-content-center text-white">
      <strong><?= strtoupper($config['script_name']) ?> </strong>&nbsp; &nbsp; Anuncios de contactos para tener <?= $_ENV['Sup'] ?>
    </div>
  </nav>
  <?php require Core::view('submenu.search', 'core'); ?>
</header>