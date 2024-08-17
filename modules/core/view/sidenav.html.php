<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que incluye el ménú lateral
 *
 *
 */

$sidenav_fixed = ($sModule == 'admin' or $sModule == 'mod') ? 'sidenav-fixed' : '';
?>

<ul id="user-menu" class="sidenav <?php echo $sidenav_fixed ?>">
  <li>
    <div class="user-view">
      <div class="col s4" bis_skin_checked="1">
        <a href="<?php echo gLink('members/account') ?>">
          <img src="<?php echo $config['avatar_url'] . DS . $session->memberData['pp_thumb_photo'] ?>" width="100%" height="100%" alt="Tu avatar" class="circle responsive-img valign profile-image">
        </a>
      </div>
      <a href="#name"><span class="name"><?php echo $session->memberData['name'] ?></span></a>
      <a href="#email"><span class="email"><?php echo $session->memberData['email'] ?></span></a>
    </div>
  </li>
  <li>
    <a href="<?php echo gLink('admin/dashboard') ?>"><i class="material-icons">home</i>Principal</a>
  </li>
  <li class="divider" tabindex="-1"></li>

  <!-- ./MENU  -->
  <?php if ($session->is_admod == 1)
  {
    include Core::view('index.sidebar', 'admin'); // ADMINISTRACIÓN
  }
  if ($session->is_admod)
  {
    //include Core::view('index.sidebar', 'mod'); // MODERACIÓN
  } ?>

</ul>