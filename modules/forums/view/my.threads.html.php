<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de hilos creados por el usuario
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section>
  <div class="container">
    <div class="row">
      <!-- Título principal de la página -->
      <div class="col-12">
        <h2 class="text-center my-4" style="font-weight: bold; color: #333;"><span class="text-primary">Mis anuncios</span></h2>
      </div>
      <div class="col-12 text-center">
        <a href="<?= gLink('forums/new.thread') ?>" class="btn btn-primary">Crear Anuncio</a>
        <br>
        <hr>
      </div>
    </div>
    <div class="row">
      <?php if ($threads['rows'] > 0) : ?>
        <?
        // Iterar sobre los hilos y crear una tarjeta para cada uno
        foreach ($threads['data'] as $thread):
        ?>
          <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
              <div class="card-body" style="min-height:150px;">
                <h5 class="card-title"><?= htmlspecialchars($thread['title']); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Publicado el <?= date('d/m/Y', $thread['created_at']); ?></h6>
                <p class="card-text">
                  <?php
                  echo cutText(getPlainText($thread['content']), 64);
                  ?>
                </p>
              </div>
              <div class="card-footer">
                <div class="d-flex justify-content-between">
                  <a href="<?= loadClass('forums/threads')->getThreadUrl($thread['id']) ?>" class="btn btn-sm">Ver</a>
                  <a href="<?= gLink('mi-panel/editar', array('thread_id' => $thread['id'])) ?>" class="btn btn-sm">Modificar</a>
                  <a href="#" class="btn btn-sm">Eliminar</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="col-12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">No has creado anuncios</span>
              <p>Para crear un anuncio haz clic en el botón "Crear Anuncio" en la parte superior izquierda de esta pantalla.</p>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require Core::view('footer', 'core'); ?>