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
  <?php if ($session->is_member == true)
  { ?>
    <ul id="userOptions" class="dropdown-content">
      <li><a href="<?php echo $extra->generateUrl('members', 'account'); ?>">Cuenta</a></li>
      <!--<li><a href="<?php echo $extra->generateUrl('members', 'vip'); ?>">VIP</a></li>-->
      <li class="divider"></li>
      <?php if ($session->is_admod)
      {
        if ($session->is_admod === 1)
        { ?>
          <li><a href="<?php echo $extra->generateUrl('admin', 'dashboard'); ?>" title="">Admin</a>
          </li>
        <?php } ?>
        </li>
        <li class="divider"></li>
      <?php
      }
      ?>
      <li onclick="location.href='<?php echo $extra->generateUrl('members', 'logout', NULL, array('token' => $session->token)); ?>'"><a href="<?php echo $extra->generateUrl('members', 'logout', NULL, array('token' => $session->token)); ?>">Salir</a></li>
    </ul>
  <?php } ?>
  <nav class="">
    <div class="container">
      <!-- Menu para miembros -->
      <?php if ($session->is_member) : ?>
        <div class="nav-wrapper">
          <!-- IZQUIERDA -->
          <?php if ($session->is_admod and ($sModule == 'admin' or $sModule == 'mod')) : ?>
            <a href="#" data-target="user-menu" class="sidenav-trigger left " style="">
              <i class="material-icons notranslate">menu</i>
            </a>
          <?php endif ?>
          <div class="icons">

            <!-- Logo -->
            <a href="" class="left" style="font-weight: 600;">
            </a>

            <div id="wallet-menu" onclick="$('#modalWallet').modal('open')" class="brand-logo center" style="display: flex;
              align-items: center; height:55px;">

              <div class="btn" style="display:flex;align-items:center;font-weight:700;box-shadow: none;background-color:#232323">
                $<?php echo loadClass('members/member')->getBalance() ?>&nbsp;<img src="<?php echo $config['images_url'] . '/tether-logo.png' ?>" width="14">

              </div>

              <button class="btn btn-primary btn-small">
                <!-- Para dispositivos de escritorio (tabletas y computadoras) -->
                <span class="hide-on-small-only">Monedero</span>

                <!-- Para dispositivos móviles -->
                <i class="material-icons hide-on-med-and-up" style="margin: 0; line-height: inherit;">wallet</i>
              </button>


            </div>

            <!-- NOTIFICACIONES -->
            <a href="<?php echo gLink('members/notifications') ?>" class="right" style="margin: 0 10px;">
              <i class="material-icons <?php echo ($session->memberData['notifications'] > 0 ? 'icon-badge' . ($session->memberData['notifications_photos'] > 0 ? ' orange-text' : '') : ''); ?>"><?php echo $session->memberData['notifications_photos'] > 0 ? 'notifications_active' : 'notifications_' . ($session->memberData['notifications'] > 0 ? 'active' : 'none'); ?></i>
              <?php echo ($session->memberData['notifications'] > 0 ? '<small id="notsCount" class="notification-badge ' . ($session->memberData['notifications_photos'] > 0 ? 'orange white-text' : 'white black-text') . '">' . $session->memberData['notifications'] . '</small>' : ''); ?>
            </a>

            <!-- PROFILE -->

            <?php if ($session->is_member == true)
            { ?>
              <a class="dropdown-trigger right" href="#!" data-target="userOptions" title="Perfil" style="margin: 0 10px;">
                <!--<i class="material-icons">account_box</i>--><i class="material-icons notranslate">person</i>
              </a>
            <?php }
            else
            { ?>
              <a href="<?php echo $extra->generateUrl('members', 'login'); ?>">
                <i class="material-icons right">account_circle</i>
              </a>
            <?php } ?>

            <!-- FIN DERECHA -->
          </div>
        </div>
      <?php else : ?>
        <div class="nav-wrapper">
          <!-- IZQUIERDA -->
          <a href="#" data-target="user-menu" class="sidenav-trigger left hide-on-med-and-down" style="">
            <i class="material-icons notranslate">menu</i>
          </a>
          <div class="icons">

            <!-- Logo -->
            <a href="<?php echo $config['base_url'] ?>" class="left" style="font-weight: 600;">
              <img class="hide-on-small-only" src="<?php echo $config['images_url'] . '/.png' ?>" alt="" style="padding: 5px; width: 108px;">

              <!-- Para dispositivos móviles -->
              <img class="hide-on-med-and-up" src="<?php echo $config['images_url'] . '/.png' ?>" alt="" style="padding: 5px; width: 65px; margin-top: 8px;">
            </a>
            <!--
            <a href="<?php echo Core::model('extra', 'core')->generateUrl('site', 'contact'); ?>" title="Contacto"><i class="material-icons right">contact_mail</i></a>
            <a href="<?php echo Core::model('extra', 'core')->generateUrl('site', 'pages', null, array('name' => 'faqs')); ?>" title="Preguntas Frecuentes"><i class="material-icons right">live_help</i></a>
            -->
            <!--
            <a href="<?php echo $extra->generateUrl('members', 'login'); ?>">
              <i class="material-icons right">account_circle</i>
            </a>
            -->
            <!-- FIN DERECHA -->
          </div>
        </div>

      <?php endif ?>
    </div>
  </nav>
  <?php
  if ($session->is_admod == true)
  {
    include Core::view('sidenav', 'core');
  ?>
    <!-- NOTIFICACIONES -->
    <ul id="sidenav-notifications" class="sidenav"></ul>
    <!-- ./NOTIFICACIONES -->
    <!-- NOTICIAS -->
    <?php if ($sModule !== 'admin')
    {
    } ?>
    <!-- NOTICIAS -->
  <?php } ?>



</header>
<style>
  .a-icon {
    width: 12.5vw;
  }

  .a-icon i {
    text-align: center;
  }

  nav {
    position: fixed;
    top: 0 !important;
    width: 100%;
  }
</style>