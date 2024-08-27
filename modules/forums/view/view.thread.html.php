<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de ver un hilo (anuncio)
 *
 */

require Core::view('head', 'core');

// Optiene imagenes del hilo
$images = loadClass('forums/threads')->getImagesByThreadId($thread['id']);
showlog($images);
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
        <div class="card thread-card">

          <div class="card-header" style="background: #e2f0e0; font-size: 14px">
            <div style="width: 100px;"> Ref: <?php echo $thread['id']; ?></div>
            <div><?php echo $contact['name']; ?></div>
            <div class=" subheader">
              <div class="subheader"><?php echo date('d/m/Y H:i', $thread['created_at']); ?></div>
            </div>
          </div>

          <div class="card-body">
            <div class="container">
              <div class="row">
                <div class="col col-9">
                  <strong class="thread-title">
                    <?= strtoupper($thread['title']); ?>
                  </strong>
                  <br>
                  <p class="thread-content">
                    <?php
                    $parser->parse($thread['content']);
                    echo $parser->getAsHTML();
                    ?>
                  </p>
                  <div style="margin: 5px 0;">
                    <div><a href="<?= gLink('forums/view.thread', ['thread_id' => $thread['id']]) ?>" class="btn btn-sm btn-primary">Ver Fotos</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <!-- Botones del footer -->
            <?php require Core::view('thread.footer', 'forums'); ?>
          </div>
        </div>

        <div class="" style="width: 200px;">
          <?php if ($images['rows'] > 0) : ?>
            <?php foreach ($images['data'] as $image) : ?>
              <div class="">

                <?php if ($image['image_url'] == null): ?>
                  <img src="<?= $config['default_thread_photo'] ?>" data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor: pointer;" width="100" height="100">
                <?php else: ?>
                  <img src="<?= $config['threads_url'] ?>/<?= $image['image_url'] ?>" data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor: pointer;" width="100">
                <?php endif; ?>

              </div>
              <?php break ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <div class="col hidden-xs hidden-sm col-md-3">
          <?php //require Core::view('forums.sidebar', 'forums'); 
          ?>
        </div>
      </div>
    </div>
    <div class="center-align">
      <div style="width: 800px">
        <!-- Menu de busqueda -->
        <?php require Core::view('menu.search', 'core'); ?>
      </div>
    </div>
</section>