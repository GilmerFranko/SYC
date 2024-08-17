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
</style>
<!-- Body -->
<section class="first-section content" id="main">
  <?php require Core::view('submenu', 'core'); ?>

  <div class="container center-align">
    <div class="row" style="max-width: 500px">

      <form class="form-horizontal" action="<?php echo $extra->generateUrl('members', 'login'); ?>" method="post">
        <div class="form-group">
          <label class="col-sm-10 control-label" for="email">Usuario o Email</label>
          <div class="col-sm-10">
            <input id="email" name="email" type="email" class="form-control" value="<?php echo Core::model('extra', 'core')->getInputValue('email'); ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-10 control-label" for="password">Contrase&ntilde;a</label>
          <div class="col-sm-10">
            <input id="password" name="password" type="password" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <input name="keepOpen" type="checkbox" class="filled-in" id="keepOpen" value="1" checked="checked" />
                Mantener sesiones anteriores abiertas
              </label>
            </div>
            <button class="btn btn-primary" type="submit" name="login">Acceder</button>
          </div>
        </div>
        <div class="row">
          <!-- BOTONES INFERIORES -->
          <div class="row col-sm-12">
            <a href="#modalRecuperar" class="btn btn-secondary" data-bs-toggle="modal">Olvide mi contrase&ntilde;a / Email</a>
          </div>
        </div>
    </div>
  </div>
</section>
<!-- / Body -->

<!-- Modal RECUPERAR CONTRASEÑA -->
<div class="modal fade" id="modalRecuperar" tabindex="-1" role="dialog" aria-labelledby="modalRecuperarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRecuperarLabel">Recuperar contrase&ntilde;a o Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <span>Si olvidaste tu contrase&ntilde;a, escribe tu email (correo) y toca el boton RECUPERAR</span>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
              </div>
              <input id="recover" name="recover" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
            </div>
          </div>
          <hr />
          <div class="row">
            <span>Si olvidaste tu email (correo), escribe tu nombre de usuario y la contrase&ntilde;a y toca el boton RECUPERAR y se te dara tu correo</span>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span>
              </div>
              <input id="recoverEmail" name="recoverEmail" type="text" class="form-control" placeholder="Nombre de usuario" aria-label="Nombre de usuario" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3"><i class="fa fa-lock"></i></span>
              </div>
              <input id="recoverEmailPass" name="recoverEmailPass" type="password" class="form-control" placeholder="Contrase&ntilde;a" aria-label="Contrase&ntilde;a" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name="recoverBtn" class="btn btn-primary">Recuperar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- / Modal RECUPERAR -->

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->