<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista del área "Perfil" de la cuenta
 *
 *
 */
?>
<style type="text/css">
  .card-content.grey.lighten-4 input {
    color: black !important;
  }
</style>
<article id="memberAccountProfile">
  <div class="content">
    <div class="row">
      <div class="input-field col s6">
        <input name="name" placeholder="Placeholder" id="name" type="text" class="validate" value="<?php echo $session->memberData['name']; ?>" disabled>
        <label for="name">Nombre de usuario</label>
      </div>
      <div class="input-field col s6">
        <input name="full_name" id="full_name" type="text" class="validate" value="<?php echo $session->memberData['pp_full_name']; ?>" required style="background: white; color: black !important">
        <label for="full_name">Nombre completo</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <?php echo Core::model('account', 'members')->getTimezones($session->memberData['pp_timezone']); ?>
        <label for="timezone" class="active">Zona horaria</label>
      </div>
    </div>
    <!-- Traducciones GTranslate -->
    <div class="row">
      <div class="input-field col s12">
        <select class="browser-default" onchange="doGTranslate(this);">
          <option value="">Seleccionar idioma</option>
          <option value="en|en">English</option>
          <option value="en|fr">French</option>
          <option value="en|it">Italian</option>
          <option value="en|pt">Portuguese</option>
          <option value="en|es">Espa&ntilde;ol</option>
        </select>
      </div>
    </div>
  </div>
</article>