<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista del pie de un hilo
 *
 */

?>

<?php if ($session->is_member)
{ ?>
  <!-- Botón para contactar al usuario -->
  <div class="chip selectable" onclick="window.location.href='<?= gLink('mensajescon/' . $thread['member_id']) ?>';">
    <i class="em em-email" aria-role="presentation" aria-label="ARIES"></i>
    <strong>Contactar</strong>
  </div>
<?php }
else
{ ?>
  <!-- Tooltip para contactar al usuario cuando no se está logueado -->
  <div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Debes estar logueado para contactar con <?= $thread['user']['username'] ?>">
    <i class="em em-email" aria-role="presentation" aria-label="ARIES"></i>
    <strong>Contactar</strong>
  </div>
<?php } ?>

<!-- Botón para compartir el hilo en redes sociales -->
<div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Compartir">
  <span class="dropdown-toggle" data-bs-toggle="dropdown">
    <i class="em em-repeat" aria-role="presentation" aria-label="CLOCKWISE RIGHTWARDS AND LEFTWARDS OPEN CIRCLE ARROWS"></i>
    Compartir
  </span>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(gLink('forums/view.thread', ['thread_id' => $thread['id']])) ?>" target="_blank">Facebook</a></li>
    <li><a class="dropdown-item" href="https://twitter.com/intent/tweet?url=<?= urlencode(gLink('forums/view.thread', ['thread_id' => $thread['id']])) ?>&text=<?= urlencode($thread['title']) ?>" target="_blank">Twitter</a></li>
    <li><a class="dropdown-item" href="https://api.whatsapp.com/send?text=<?= urlencode($thread['title']) ?>%20<?= urlencode(gLink('forums/view.thread', ['thread_id' => $thread['id']])) ?>" target="_blank">WhatsApp</a></li>
  </ul>
</div>


<?php if (!$isFavorite)
{ ?>
  <div id="favoriteBtn-<?= $thread['id'] ?>" class="favoriteBtn chip selectable" data-thread-id="<?= $thread['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Favorito">
    <i class="em em-star2" aria-role="presentation" aria-label="GLOWING STAR"></i>Favorito
  </div>
<?php }
else
{ ?>
  <div id="favoriteBtn-<?= $thread['id'] ?>" class="favoriteBtn chip selectable isFavorite" data-thread-id="<?= $thread['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Favorito">
    <i class="em em-heart" aria-role="presentation" aria-label="STAR"></i>Favorito
  </div>
<?php } ?>

<!-- Botón para ver estadísticas -->
<div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Estadisticas">
  <i class="em em-bar_chart" aria-role="presentation" aria-label="BAR CHART"></i>
  Estadisticas
</div>

<!-- Botón para denunciar el hilo -->
<div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Denunciar">
  <i class="em em-warning" aria-role="presentation" aria-label="WARNING SIGN"></i>
  Denunciar
</div>

<?php if ($session->is_member && $thread['member_id'] == $m_id)
{ ?>
  <div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
    <a href="<?= gLink('forums/edit.thread', ['thread_id' => $thread['id']]) ?>">
      <i class="em em-wrench" aria-role="presentation" aria-label="WRENCH"></i>
      Editar
    </a>
  </div>
<?php } ?>

<style>
  .selectable {
    cursor: pointer;
  }

  .isFavorite {
    color: red !important;
  }
</style>