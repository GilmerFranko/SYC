<?php defined('SYC') || exit; ?>

<style>
  .navbar {
    background-color: var(--primary);
    padding: 1rem 0;
  }

  .navbar-brand img {
    max-width: 200px;
    height: auto;
  }

  .nav-link {
    color: white !important;
    font-weight: 700;
  }

  .btn-head {
    color: white;
    background-color: rgba(255, 255, 255, 0.1);
    border: none;
    margin: 0 0.25rem;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    line-height: 1.2;
    transition: background-color 0.3s ease;
  }

  .btn-head:hover {
    background-color: rgba(255, 255, 255, 0.2);
  }

  .dropdown-menu {
    background-color: var(--primary);
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
  }

  .dropdown-item {
    color: white;
  }

  .dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }

  .footer-menu-head {
    background-color: var(--primary-dark);
    color: white;
    padding: 0.5rem 0;
    font-size: 0.875rem;
  }

  @media (max-width: 991.98px) {
    .navbar-nav {
      background-color: var(--primary-dark);
      padding: 1rem;
      border-radius: 0.25rem;
    }
  }
</style>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="<?php echo $config['base_url'] ?>">
        <img class="hide-on-small-only" src="<?php echo $config['images_url'] . '/logo.png' ?>" alt="" style="width: 128px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <?php if ($session->is_member): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= $config['avatar_url'] . '/' . $session->memberData['pp_main_photo'] ?>" alt="Imagen de perfil" style="width: 26px; height: 26px; border-radius: 50%; object-fit: cover; margin-right: 8px;">
                <span class="d-none d-lg-inline"><?php echo strtoupper($session->memberData['name']); ?></span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'profile'); ?>">Mi perfil</a></li>
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('wallet', 'my_transactions'); ?>">Monedero</a></li>
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('mi-panel', 'anuncios'); ?>">Mis anuncios</a></li>
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('anuncios', 'favoritos'); ?>">Favoritos</a></li>
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'account'); ?>">Mi cuenta</a></li>
                <?php if (loadClass('admin/members')->isAdmod($m_id) == 1): ?>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'configuration'); ?>">Configuración</a></li>
                <?php endif; ?>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'logout', null, ['token' => $session->token]); ?>">Salir</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'notifications'); ?>">
                <i class="material-icons">notifications</i>
                <?php if ($session->memberData['notifications'] > 0) echo "(" . $session->memberData['notifications'] . ")"; ?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'messages'); ?>">
                <i class="material-icons">mail</i>
                <?php if (isset($session->memberData['unread_messages']) && $session->memberData['unread_messages'] > 0) echo $session->memberData['unread_messages']; ?>
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="btn" href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'login'); ?>">Iniciar sesión</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary-200 " href="<?php echo Core::model('extra', 'core')->generateUrl('members', 'register'); ?>">Registrarse</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!--<div class="footer-menu-head text-center">
    <div class="container">
      <strong><?= strtoupper($config['script_name']) ?></strong> &nbsp; &nbsp; Anuncios de foros para tener <?= $_ENV['Sup'] ?>
    </div>
  </div>-->
</header>

<?php if ($sSection != 'login')
{
  require Core::view('submenu.search', 'core');
}
?>