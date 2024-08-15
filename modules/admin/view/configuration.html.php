<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de configuración de la administración
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<!-- CSS ADICIONAL -->
<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/admin.css" />

<section>
  <div class="sectionConfiguration">
    <blockquote class="flow-text">
      Guardado por <?php echo $save_name; ?> el <?php echo $save_date; ?>
    </blockquote>
    <div class="row">
      <form action="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'configuration'); ?>" method="post" class="col s12">

        <!-- NOMBRE DEL SITIO -->
        <div class="row">
          <div class="input-field col s12">
            <input id="script_name" name="script_name" type="text" class="validate" value="<?php echo $config['script_name']; ?>" required="required">
            <label for="script_name" class="active">Nombre del sitio</label>
          </div>
        </div>
        <!-- NOMBRE DE LA COOKIE -->
        <div class="row">
          <div class="input-field col s6">
            <input id="cookie_name" name="cookie_name" type="text" class="validate" value="<?php echo $config['cookie_name']; ?>" required="required">
            <label for="cookie_name" class="active">Nombre de cookie</label>
          </div>
          <div class="input-field col s6">
            <input id="cookie_time" name="cookie_time" type="number" class="validate" value="<?php echo $config['cookie_time']; ?>" required="required">
            <label for="cookie_time" class="active">Tiempo de cookie (d&iacute;as)</label>
          </div>
        </div>


        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          <input type="tel" id="num_phone" name="num_phone" class="validate" value="<?php echo $config['num_phone']; ?>">
          <label for="num_phone">Número de teléfono (Añadir codigo +)</label>
        </div>
        <!-- CONFIGURACIÓN EXTRA -->
        <div class="row">
          <div class="input-field col s6">
            <div class="switch">
              <label>
                <input type="checkbox" value="1" name="maintenance" id="maintenance" <?php echo $config['maintenance'] == 1 ? 'checked="checked"' : ''; ?>>
                <span class="lever"></span>

              </label>
            </div>
            <label for="maintenance" class="active">Mantenimiento</label>
          </div>
          <div class="input-field col s6">
            <div class="switch">
              <label>

                <input type="checkbox" value="1" name="debug_mode" id="debug_mode" <?php echo $config['debug_mode'] == 1 ? 'checked="checked"' : ''; ?>>
                <span class="lever"></span>

              </label>
            </div>
            <label for="debug_mode" class="active">Depuraci&oacute;n</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <div class="switch">
              <label>
                <input type="checkbox" value="1" name="reg_validate" id="reg_validate" <?php echo $config['reg_validate'] == 1 ? 'checked="checked"' : ''; ?>>
                <span class="lever"></span>

              </label>
            </div>
            <label for="reg_validate" class="active">Validar por correo</label>
          </div>
        </div>

        <!-- CONFIGURACION DE AVATAR -->
        <blockquote class="flow-text">Avatar</blockquote>



        <!-- PUBLICIDAD -->
        <blockquote class="flow-text">Publicidad</blockquote>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="ad300250" name="ad_300x250" class="materialize-textarea"><?php echo $config['ad_300x250']; ?></textarea>
            <label for="ad300250">Publicidad 300x250</label>
          </div>
        </div>



        <!-- BOTON GUARDAR -->
        <button class="btn waves-effect waves-light grey darken-3" type="submit" name="save">Guardar cambios
          <i class="material-icons right">save</i>
        </button>

      </form>
    </div>
  </div>
</section>


<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>