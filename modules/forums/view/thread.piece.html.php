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

// Verifica si el usuario tiene el thread en favoritos
$query = $extra->db->query(
  'SELECT * FROM members_favorites WHERE member_id = ' . $m_id . ' AND thread_id = ' . $thread['id']
);

if ($query and $query->num_rows > 0)
{
  $isFavorite = true;
}
else
{
  $isFavorite = false;
}

// Registra a la visita del hilo (solo si no se ha visitado el mismo dia) (Primero se está cargando el hilo y luego se registra la visitta por lo que esta no estará reflejada en el momento)
loadClass('forums/threads')->registerVisit($thread['id'], $m_id, $session->memberData['ip_address']);


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
          <a href="<?= loadClass('forums/threads')->getThreadUrl($thread['id']) ?>" class="materialboxed">
            <strong class="thread-title">
              <?= strtoupper($thread['title']); ?>
            </strong>
          </a>
          <br>
          <p class="thread-content">
            <?php echo cutText(getPlainText($thread['content']), 512); ?>
          </p>
          <div style="margin: 5px 0;">
            <div><a href="<?= loadClass('forums/threads')->getThreadUrl($thread['id']) ?>" class="btn btn-sm btn-primary">Ver Fotos</a></div>
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
    <!-- Botones del footer -->
    <?php require Core::view('thread.footer', 'forums'); ?>
  </div>
</div>