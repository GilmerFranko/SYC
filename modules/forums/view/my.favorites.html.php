<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de hilos guardados por el usuario
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section>
  <div class="container">
    <div class="card">
      <!-- Título principal de la página -->
      <div class="card-title">
        <h2 class="text-center my-4" style="font-weight: bold; color: #333;"><span class="text-primary">Mis favoritos</span></h2>
      </div>
    </div>
    <div class="card-body">
      <div style="font-size: 12px; text-align: center; margin: 0 0 10px 0px">
        Encontrados <strong><?= $threads['rows'] ?></strong> anuncios
      </div>

      <?php if ($threads['rows'] > 0): ?>
        <?php foreach ($threads['data'] as $thread): ?>
          <?php require Core::view('my.favorites.piece', 'forums'); ?>
        <?php endforeach ?>
      <?php else: ?>
        <div class="card">
          <div class="card-content">
            <span class="card-title">
              No hay anuncios
            </span>
          </div>
        </div>
      <?php endif ?>
    </div>
    <div class="card-footer">
      <!--paginador-->
      <?php echo $threads['pages']['paginator']; ?>
      <!--fin_paginador-->
    </div>
  </div>
</section>

<?php require Core::view('footer', 'core'); ?>