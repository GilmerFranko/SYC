<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página principal
 *
 *
 */

require Core::view('head', 'core');
?>

<style>
  .logo {
    display: flex;
    justify-content: center;
  }

  #modalRecover {
    background-color: #202123;
  }
</style>
<!-- Body -->
<section style="margin-top: 50px;">
  <div class="row" style="max-width: 500px">
    <!-- Logo -->
    <div class="col s12">
      <div class="logo">
        <img src="<?php echo Core::model('extra', 'core')->getLogo(); ?>" alt="Logo" width="160" />
      </div>
    </div>
    <form action="<?php echo $extra->generateUrl('members', 'login'); ?>" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate" value="<?php echo Core::model('extra', 'core')->getInputValue('email'); ?>">
          <label for="email">Usuario o Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Contrase&ntilde;a</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <button class="btn btn-primary btn-large w100 waves-effect waves-light" type="submit" name="login">Acceder
            <i class="material-icons right">send</i>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="keepOpen">
            <input name="keepOpen" type="checkbox" class="filled-in" id="keepOpen" value="1" checked="checked">
            <span>Mantener sesiones anteriores abiertas</span>
          </label>
        </div>
      </div>
      <br /><br />
      <div class="row">
        <!-- Modal RECUPERAR CONTRASEÑA -->
        <form action="" method="post">
          <div id="modalRecover" class="modal modal-fixed-footer">
            <div class="modal-content">
              <h4>Recuperar contrase&ntilde;a o Email</h4>
              <div class="row">
                <span>Si olvidaste tu contrase&ntilde;a, escribe tu email (correo) y toca el boton RECUPERAR</span>
                <div class="input-field col s12">
                  <input id="recover" name="recover" type="email" class="validate">
                  <label for="recover">Email</label>
                </div>
              </div>
              <span>Si olvidaste tu email (correo), escribe tu nombre de usuario y la contrase&ntilde;a y toca el boton RECUPERAR y se te dara tu correo</span>
              <div class="row">
                <div class="input-field col s12 l6">
                  <input id="recoverEmail" name="recoverEmail" type="text" class="validate">
                  <label for="recoverEmail">Nombre de usuario</label>
                </div>
                <div class="input-field col s12 l6">
                  <input id="recoverEmailPass" name="recoverEmailPass" type="password" class="validate">
                  <label for="recoverEmailPass">Contrase&ntilde;a</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-blue btn-flat">Cancelar</a>
              <button class="waves-effect waves-light btn w50 grey darken-3 autodisabled" type="submit" name="recoverBtn">Recuperar
                <i class="material-icons right">fingerprint</i>
              </button>
            </div>
          </div>
        </form>
        <!-- BOTONES INFERIORES -->
        <div class="row col s12">
          <a class="modal-trigger waves-effect waves-light btn w100 grey darken-3" href="#modalRecover"><i class="material-icons right">fingerprint</i>Olvide mi contrase&ntilde;a / Email</a>
        </div>
        <div class="row col s12">
          <a href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'register'); ?>" class="btn btn-secondary btn-large w100 waves-effect waves-light"><i class="material-icons right">group_add</i>Crear cuenta</a>
        </div>
      </div>
    </form>
  </div>
</section>
<!-- / Body -->

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->