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
    margin-right: 10px;
    width: 40%;
    font-weight: 700;
  }

  .menu-balance {
    box-shadow: 0px 1px 3px -1px var(--primary-300);
    background: var(--primary);
    color: white !important;
    margin: 0 0 0 8px;
  }

  .brand-logo {
    padding: 5px;
    width: 125px;
    max-width: 140px;
    margin-left: 12px;

    img {
      width: 100%;
    }
  }

  @media only screen and (max-width: 767px) {
    .menu-member {
      width: 73%;
    }
  }


  @media only screen and (max-width: 550px) {
    .menu-member {
      width: 75%;
    }

    .brand-logo {
      width: 100px;
    }
  }

  @media only screen and (max-width: 500px) {
    .menu-member {
      width: 73%;
    }

    .brand-logo {
      width: 100px;
    }
  }

  @media only screen and (max-width: 450px) {
    .menu-member {
      width: 69%;
    }

    .brand-logo {
      width: 100px;
    }
  }


  @media only screen and (max-width: 400px) {
    .menu-balance {
      display: none !important;
    }

    .brand-logo {
      width: 80px;
    }
  }

  @media only screen and (max-width: 330px) {
    .menu-member {
      width: 65%;
    }
  }
</style>
<header>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <nav style="display: flex;align-items: center;">


    <div class="">
      <div class="row" style="width: 100vw; max-width: 995px;">

        <div class="align-items-center brand-logo">
          <!-- Logo -->
          <img class="" src="<?php echo $config['images_url'] . '/pasion.gif' ?>" alt="" onclick="location.href='<?php echo $config['base_url'] ?>'">
        </div>
        <div class="col d-none d-md-flex align-items-center">
          <?php if ($sSection == 'home-guest'): ?>
            SEXOYCONTACTO.es - lider en anuncios de contactos
          <?php elseif ($sSection == 'view.thread'): ?>
            <div class="beacrumb" style="">
              <span class="">SEXOYCONTACTO.es - LIDER EN ANUNCIOS DE CONTACTOS</span>

            </div>
          <?php endif; ?>
        </div>
        <?php if ($session->is_member)
        { ?>
          <!-- Menu para miembros -->
          <div class="menu-member">
            <!-- Cuenta -->
            <div class="dropdown btn">
              <a class="text-primary dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- Imagen del usuario -->
                <img src="<?= $config['avatar_url'] . '/' . $session->memberData['pp_main_photo']  ?>" alt="Imagen de perfil" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; margin-right: 8px;" class="d-inline-block">

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
            </div>

            <!-- Notificaciones -->
            <a class="btn btn-sm text-primary d-flex justify-content-center" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'notifications'); ?>">
              <i class="material-icons">notifications</i>
              <?php if ($session->memberData['notifications'] > 0)
              {
                echo "(" . $session->memberData['notifications'] . ")";
              } ?>
            </a>
            <!-- Mensajes -->
            <?php if (!isset($session->memberData['unread_messages']) or $session->memberData['unread_messages']  <= 0)
            { ?>
              <a class="btn btn-sm text-primary d-flex justify-content-center" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'messages'); ?>">
                <i class="material-icons">mail</i>
              </a>
            <?php }
            // Si hay mensajes sin leer
            else
            { ?>
              <a class="btn btn-sm d-flex justify-content-center text-primary-dark" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'messages'); ?>">
                <i class="material-icons">mail</i>
                <?php echo $session->memberData['unread_messages']; ?>
              </a>
            <?php } ?>

            <a class="menu-balance btn btn-sm text-primary d-flex justify-content-center " href="<?= gLink('wallet/my_transactions') ?>">
              <?php echo getBalance(); ?>€
            </a>
          </div>
        <?php }
        else
        { ?>
          <!-- Menu para miembros -->
          <div class="col s3" style="display: flex;justify-content: flex-end;align-items: center; margin-right: 10px;">
            <a class="btn btn-sm btn-secondary ms-2" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'login'); ?>">Iniciar</a>
            <a class="btn btn-sm btn-primary ms-2" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'register'); ?>">Registrarse</a>
          </div>


        <?php  } ?>

      </div>
      <!-- FIN DERECHA -->
    </div>
  </nav>
</header>