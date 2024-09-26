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

      <div class="col col-sm-12 col-md-9 col-lg-10">
        <div class="preAviso mt-4"></div>

        <div class="preAviso0" style="display: <?= (isset($_COOKIE['hasAcceptedAdultContent']) ? 'block' : 'none') ?>;">
          <!-- Menu de busqueda -->
          <?php require Core::view('menu.search', 'core'); ?>

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
            <div class="card">
              <div class="card-content">
                <span class="card-title">
                  No hay anuncios
                </span>
              </div>
            </div>
          <?php endif ?>
        </div>
      </div>
      <div class="menu-sidebar1 col d-none d-sm-none d-md-flex col-md-3 col-lg-2">
        <!-- SIDEBAR Solo para escritorio -->
        <?php require Core::view('sidebar', 'forums'); ?>
      </div>
    </div>
</section>

<!-- Modal denunciar -->
<?php require Core::view('report.modal', 'forums'); ?>

<!-- Modal Renovar -->
<?php require Core::view('renovar.modal', 'forums'); ?>

<!-- Aviso -->
<?php require Core::view('preaviso.modal', 'forums'); ?>

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