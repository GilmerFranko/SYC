<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista del sidebar de la administración
 *
 *
 */

?>
<li class="grey darken-4">
  <ul class="collapsible collapsible-accordion">
    <li <?php if ($sModule == 'admin')
        {
          echo ' class="active"';
        } ?>>
      <a class="collapsible-header white-text waves-effect waves-blue "><i class="material-icons white-text">settings_applications</i>Admin <i class="material-icons right white-text" style="margin-right:0;">arrow_drop_down</i></a>
      <div class="collapsible-body z-depth-1">
        <ul>
          <li <?php if ($sSection == 'configuration')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'configuration'); ?>">
              <i class="material-icons">settings</i>
              Configuraci&oacute;n
            </a>
          </li>
          <li <?php if ($sSection == 'members')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'members'); ?>">
              <i class="material-icons">group</i>
              Usuarios
            </a>
          </li>
          <li <?php if ($sSection == 'groups')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'groups'); ?>">
              <i class="material-icons">stars</i>
              Grupos
            </a>
          </li>
          <li <?php if ($sSection == 'contacts')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'contacts'); ?>">
              <i class="material-icons">contact_mail</i>
              Contactos
            </a>
          </li>
          <li <?php if ($sSection == 'reports')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'reports'); ?>">
              <i class="material-icons">warning</i>
              Reportes
            </a>
          </li>
          <hr>
          <li class="">
            <ul class="collapsible collapsible-accordion">
              <li <?php if ($sSection == 'contacts.view')
                  {
                    echo ' class="active"';
                  } ?>>
                <a class="collapsible-header white-text waves-effect waves-blue "><i class="material-icons white-text">description</i>Secciones<i class="material-icons right white-text" style="margin-right:0;">arrow_drop_down</i></a>
                <div class="collapsible-body z-depth-1">
                  <ul>
                    <li <?php if ($sSection == 'contacts.view')
                        {
                          echo ' class="active"';
                        } ?>>
                      <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'contacts.views'); ?>">
                        <i class="material-icons">description</i>
                        Contáctos
                      </a>
                    </li>
                  </ul>
                  <ul>
                    <li <?php if ($sSection == 'views.locations')
                        {
                          echo ' class="active"';
                        } ?>>
                      <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'views.locations'); ?>">
                        <i class="material-icons">description</i>
                        Ubicaciones
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </li>
          <hr>
          <li <?php if ($sSection == 'transactions')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'transactions'); ?>">
              <i class="material-icons">wallet</i>
              Transacciones
            </a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</li>