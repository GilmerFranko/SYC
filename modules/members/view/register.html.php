<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de registro
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<!-- Body -->
<section id="membersRegister">
  <div class="container">
    <h2>Registro</h2>
    <form class="form col s12" action="" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Tu Nombre y Apellido" name="name" id="username" type="text" value="<?php echo Core::model('extra', 'core')->getInputValue('name', 'post'); ?>" class="validate" pattern="[ A-Za-z]{4,30}"
            title="Nombre. De entre: 4. A: 30 Letras" required>
          <label for="username">Tu Nombre y Apellido o Apodo. Ejemplo: Juan Perez</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Correo electr&oacute;nico" name="email" id="email" type="email" value="<?php echo Core::model('extra', 'core')->getInputValue('email', 'post'); ?>" class="validate" required>
          <label for="username">Tu Email (Correo Electronico)</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password" name="password" type="password" class="validate" minlength="6" required>
          <label for="password">Elije una Contrase&ntilde;a</label>
        </div>
        <div class="input-field col s6">
          <input id="confirmPassword" name="confirmPassword" type="password" class="validate" minlength="6" required>
          <label for="confirmPassword">Repite la Contrase&ntilde;a</label>
        </div>
      </div>
      <div class="row">
        <label>
          <input name="gender" type="radio" value="0" required />
          <span>Soy Hombre</span>
        </label>
        <label>
          <input name="gender" type="radio" value="1" required />
          <span>Soy Mujer</span>
        </label>
        <label>
          <input name="gender" type="radio" value="2" required />
          <span>Prefiero no decirlo</span>
        </label>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Tu fecha de Nacimiento" name="birthday" id="birthday" type="date" class="validate" required>
          <label for="birthday">Tu Fecha de Nacimiento</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <button class="btn btn-primary waves-effect waves-light darken-3 w100 btn-large" type="submit" name="register">Crear cuenta
            <i class="material-icons right">person_add</i>
          </button>
        </div>
      </div>
    </form>
    <a href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'login'); ?>" class="waves-effect waves-light btn btn-secondary btn-small w100 darken-3"><i class="material-icons right">lock</i>Ya tienes cuenta? Ingresa</a>
    <br /><br />
    <a href="<?php echo Core::model('extra', 'core')->generateUrl('site', 'pages', null, array('name' => 'explica')); ?>" class="waves-effect waves-light btn btn-small w100 purple darken-3"><i class="material-icons right">thumb_up_alt</i>No puedes registrarte? toca aqui!</a><br /><br />
  </div>
</section>