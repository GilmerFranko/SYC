<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de ver hilos de un foro
 *
 */

require Core::view('head', 'core');
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>

<section>
  <!-- Header -->
  <?php require Core::view('menu', 'core'); ?>
  <!-- / Header -->
  <div class="container">
    <div class="row">

      <div class="col col-sm-12 col-md-9 col-lg-12">
        <div class="preAviso mt-4"></div>

        <div class="preAviso0" style="display: <?= (isset($_COOKIE['hasAcceptedAdultContent']) ? 'block' : 'none') ?>;">
          <div style="font-size: 12px; text-align: center; margin: 0 0 10px 0px">
            Encontrados <strong><?= $threads['total'] ?></strong> anuncios en "<?= $contact['name'] ?>"
          </div>

          <?php if ($threads['rows'] > 0): ?>
            <?php // Desactivado por ahoraecho $threads['pages']['paginator']; 
            ?>
            <?php foreach ($threads['data'] as $thread): ?>
              <?php require Core::view('thread.piece', 'forums'); ?>
            <?php endforeach ?>
            <!-- Paginador -->
            <?php echo $threads['pages']['paginator']; ?>
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
      </div>
    </div>
</section>

<!-- Modal denunciar -->
<?php require Core::view('report.modal', 'forums'); ?>

<!-- Modal Renovar -->
<?php require Core::view('renovar.modal', 'forums'); ?>

<!-- Aviso -->
<?php require Core::view('preaviso.modal', 'forums'); ?>

<!-- Estadisticas -->
<?php require Core::view('stats.modal', 'forums'); ?>

<script>
  function adjustTextLength() {
    $('.thread-content').each(function() {
      var originalText = $(this).text().trim();
      var maxLength = window.innerWidth < 768 ? 100 : originalText.length;

      if (originalText.length > maxLength) {
        var truncatedText = originalText.substring(0, maxLength) + '...';
        $(this).text(truncatedText);
      } else {
        $(this).text(originalText); // Restaurar el texto completo si es necesario
      }
    });
  }

  // Ejecutar la función al cargar la página
  adjustTextLength();

  // Recalcular al cambiar el tamaño de la ventana
  $(window).resize(function() {
    adjustTextLength();
  });
</script>

<!-- FOOTER -->
<?php require Core::view('footer', 'core'); ?>