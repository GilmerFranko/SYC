<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de busquedas
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

      <div class="col col-sm-12 col-md-10">
        <!-- Menu de busqueda -->
        <?php require Core::view('menu.search', 'core'); ?>

        <div style="font-size: 12px; text-align: center; margin: 0 0 10px 0px">
          Encontrados <strong><?= $search_results['pages']['results'] ?></strong> anuncios
        </div>
        <!--paginador-->
        <?php echo $search_results['pages']['paginator']; ?>
        <!--fin_paginador-->
        <?php if ($search_results['rows'] > 0): ?>
          <?php foreach ($search_results['data'] as $thread)
          {
            // Carga el contácto correspondiente
            $contact = loadClass('forums/f_contacts')->getContactById($thread['contact_id']);

            // Carga el foro correspondiente
            $location = loadClass('forums/locations')->getLocationById($thread['location_id']);

            require Core::view('thread.piece', 'forums');
          } ?>
        <?php else: ?>
          <div class="card">
            <div class="card-content">
              <span class="card-title">
                No hay anuncios
              </span>
            </div>
          </div>
        <?php endif ?>
        <!--paginador-->
        <?php echo $search_results['pages']['paginator']; ?>
        <!--fin_paginador-->
      </div>
      <div class="col hidden-xs hidden-sm col-md-3">
        <?php //require Core::view('forums.sidebar', 'forums'); 
        ?>
      </div>
    </div>
  </div>
</section>

<!-- Modal denunciar -->
<?php require Core::view('report.modal', 'forums'); ?>

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