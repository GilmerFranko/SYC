<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de un hilo, esta pieza se encarga de mostrar 
 * la información de un hilo en la página de los hilos de un foro
 *
 */
// Optiene imagenes del hilo
$images = loadClass('forums/threads')->getImagesByThreadId($thread['id']);
?>

<div class="card thread-card">
  <div class="card-header">
    <div><?php echo $contact['name']; ?></div>
    <div class="subheader">
      <div><?php echo $thread['member_name']; ?></div>
      <div class="btn-autorenueva"><a href="<?php echo $config['forum_url']; ?><?php echo $thread->locations['location_id']; ?>/<?php echo $thread['id']; ?>">AUTO·RENUEVA</a></div>
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
            <?php echo cutText(getPlainText($thread['content']), 512); ?>
          </p>
          <div style="margin: 5px 0;">
            <div><a href="<?php echo $config['thread_url']; ?><?php echo $thread['location_id']; ?>" class="btn btn-sm btn-primary">Ver Fotos</a></div>
          </div>
        </div>
        <div class="col col-3">
          <?php if ($images['rows'] > 0) : ?>
            <?php foreach ($images['data'] as $image) : ?>
              <div class="image-container">
                <a href="<?= $config['images_url'] ?>/<?= $image['image_url'] ?>" class="materialboxed">
                  <?php if ($image['image_url'] == null): ?>
                    <img src="<?= $config['default_thread_photo'] ?>" alt="" class="" width="100" height="100">
                  <?php else: ?>
                    <img src="<?= $config['threads_url'] ?>/<?= $image['image_url'] ?>" alt="" class="" width="100">
                  <?php endif; ?>
                </a>
              </div>
              <?php break ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <div class="chip"><i class="em em-email" aria-role="presentation" aria-label="ARIES"></i> <strong>Contactar</strong></div>
    <!-- Colocar telefono de existir -->

    <div class="chip"><i class="em em-repeat" aria-role="presentation" aria-label="CLOCKWISE RIGHTWARDS AND LEFTWARDS OPEN CIRCLE ARROWS"></i> Compartir</div>
    <div class="chip"><i class="em em-star2" aria-role="presentation" aria-label="GLOWING STAR"></i> Favorito</div>
    <div class="chip"><i class="em em-bar_chart" aria-role="presentation" aria-label="BAR CHART"></i></i> Estadisticas</div>
    <div class="chip"><i class="em em-warning" aria-role="presentation" aria-label="WARNING SIGN"></i></i> Denunciar</div>
  </div>
</div>