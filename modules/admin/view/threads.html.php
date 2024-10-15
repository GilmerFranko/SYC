<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de anuncios
 *
 *
 */

require Core::view('head', 'core');
?>

<section id="adminThreads">
  <!-- BUSCADOR -->
  <nav class="teal darken-1">
    <div class="nav-wrapper">
      <form class="" action="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'threads'); ?><?php echo isset($_GET['threads_spam']) ? '&threads_spam=1' : ''; ?>" method="get">
        <div class="input-field">
          <input id="search" name="search" type="search" placeholder="Buscar..." value="<?php echo $search; ?>">
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>
  <!-- ./BUSCADOR -->
  <blockquote>Anuncios publicados: <?php echo $threads['total']; ?></blockquote>

  <div class="sectionThreads">
    <?php include Core::view('threads.area'); ?>
  </div>

</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->


<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>