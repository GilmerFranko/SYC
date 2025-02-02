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

<section class="first-section">

  <div class="container">
    <div class="card">
      <!-- Título principal de la página -->
      <div class="card-title">
        <h2 class="text-center my-4" style="font-weight: bold; color: #333;"><span class="text-primary">Mis favoritos</span></h2>
      </div>
    </div>
    <div class="card-body">
      <br>
      <div style="font-size: 12px; text-align: center; margin: 0 0 10px 0px">
        Encontrados <strong><?= $threads['rows'] ?></strong> anuncios
      </div>

      <?php if ($threads['rows'] > 0): ?>
        <?php foreach ($threads['data'] as $thread): ?>
          <?php require Core::view('my.favorites.piece', 'forums'); ?>
        <?php endforeach ?>
      <?php else: ?>
        <div class="d-flex flex-column align-items-center justify-content-center py-4 px-3">
          <div class="rounded-circle bg-light p-3 mb-3">
            <i class="bi bi-search" style="font-size: 2rem;"></i>
          </div>
          <h3 class="h5 font-weight-bold mb-2">No se encontraron resultados</h3>
          <p class="text-center mb-3" style="max-width: 500px;">
            No hemos podido encontrar lo que buscas. Intenta ajustar los filtros o usar términos de búsqueda diferentes.
          </p>
          <!--<div class="d-flex gap-2">
                  <button class="btn btn-primary btn-outline-secondary btn-sm" onclick="window.location.reload()">
                    <i class="bi bi-arrow-clockwise mr-1" style="font-size: 1rem;"></i>
                    Reiniciar búsqueda
                  </button>
                </div>-->
        </div>
      <?php endif ?>
    </div>
    <br>
    <div class="card-footer">
      <!--paginador-->
      <?php echo $threads['pages']['paginator']; ?>
      <!--fin_paginador-->
    </div>
  </div>
</section>

<?php require Core::view('footer', 'core'); ?>