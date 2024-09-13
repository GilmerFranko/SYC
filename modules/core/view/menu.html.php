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


    <div class="">
      <div class="row">

        <div class="col col-sm-2">
          <!-- Logo -->
          <a href="<?php echo $config['base_url'] ?>" style="font-weight: 600;">
            <img class="hide-on-small-only" src="<?php echo $config['images_url'] . '/pasion.gif' ?>" alt="" style="padding: 5px; width: 140px;">
          </a>
        </div>
        <div class="col d-none d-md-flex col-md-5 offset-md-1 align-items-center">
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
          <div class="col s3" style="display: flex;justify-content: flex-end;align-items: center; margin-right: 10px;">
            <!-- Notificaciones -->
            <a class="btn btn-sm text-primary d-flex justify-content-center" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'notifications'); ?>">
              <i class="material-icons">notifications</i>
              <?php if ($session->memberData['notifications'] > 0)
              {
                echo "($session->memberData['notifications'])";
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
            <!-- Cuenta -->
            <div class="dropdown btn">
              <a class="text-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo strtoupper($session->memberData['name']); ?>
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'account'); ?>">Mi cuenta</a></li>
                <?php if (loadClass('admin/members')->isAdmod($m_id) == 1): ?>
                  <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'configuration'); ?>">Configuraci&oacuten</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'logout', null, ['token' => $session->token]); ?>">Salir</a></li>
              </ul>
            </div>
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