<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de inicio de sesión
 */

require Core::view('head', 'core');
?>

<style>
  .logo {
    display: flex;
    justify-content: center;
    padding-bottom: 30px;
  }
</style>
<?php require Core::view('menu', 'core') ?>
<!-- Body -->
<section class="first-section content" id="main">

  <div class="logo">
    <img src="<?php echo Core::model('extra', 'core')->getLogo(); ?>" alt="Logo" width="160" />
  </div>
  <div class="container d-flex justify-content-center">
    <div class="card p-4" style="max-width: 500px; width: 100%;">
      <form action="<?php echo $extra->generateUrl('members', 'login'); ?>" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">Usuario o Email</label>
          <input id="email" name="email" type="email" class="form-control" value="<?php echo Core::model('extra', 'core')->getInputValue('email'); ?>" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contrase&ntilde;a</label>
          <input id="password" name="password" type="password" class="form-control" required>
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="keepOpen" name="keepOpen" value="1" checked>
          <label class="form-check-label" for="keepOpen">
            Mantener sesiones anteriores abiertas
          </label>
        </div>

        <div class="d-grid">
          <button class="btn btn-primary" type="submit" name="login">Acceder</button>
        </div>

        <div class="mt-3 text-center">
          <a href="#modalRecuperar" class="btn btn-link" data-bs-toggle="modal">Olvidé mi contrase&ntilde;a / Email</a>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- / Body -->

<!-- Modal RECUPERAR CONTRASEÑA -->
<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="modalRecuperarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRecuperarLabel">Recuperar contrase&ntilde;a o Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <p>Si olvidaste tu contrase&ntilde;a, escribe tu email (correo) y toca el botón RECUPERAR.</p>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
              <input id="recover" name="recover" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
            </div>
          </div>

          <hr />

          <div class="mb-3">
            <p>Si olvidaste tu email (correo), escribe tu nombre de usuario y la contrase&ntilde;a y toca el botón RECUPERAR para recuperar tu correo.</p>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span>
              <input id="recoverEmail" name="recoverEmail" type="text" class="form-control" placeholder="Nombre de usuario" aria-label="Nombre de usuario" aria-describedby="basic-addon2" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3"><i class="fa fa-lock"></i></span>
              <input id="recoverEmailPass" name="recoverEmailPass" type="password" class="form-control" placeholder="Contrase&ntilde;a" aria-label="Contrase&ntilde;a" aria-describedby="basic-addon3" required>
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