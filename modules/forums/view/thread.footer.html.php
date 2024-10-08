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

<style>
  .small-in-movil {
    font-size: 11px !important;
  }
</style>

<?php if ($session->is_member)
{ ?>
  <?php if ($thread['member_id'] == $m_id): ?>
    <!-- Botón para renovar -->
    <div id="renewBtnModal-<?= $thread['id'] ?>" class="chip selectable" data-bs-toggle="modal" data-bs-target="<?= $isAutoRenewEnabled ? '#unRenewModal' : '#renewModal' ?>" data-thread-id="<?= $thread['id'] ?>">
      <i class="em em-recycle small-in-movil" aria-role="presentation" aria-label="BLACK UNIVERSAL RECYCLING SYMBOL"></i>
      <strong class="d-none d-sm-inline small-in-movil">Renovar</strong>
    </div>
  <?php else: ?>
    <!-- Botón para contactar al usuario -->
    <div class="chip selectable" onclick="window.location.href='<?= gLink('mensajescon/' . $thread['member_id']) ?>';">
      <i class="em em-email small-in-movil" aria-role="presentation" aria-label="ARIES"></i>
      <strong class="d-none d-sm-inline small-in-movil">Contactar</strong>
    </div>
  <?php endif; ?>
<?php }
else
{ ?>
  <!-- Tooltip para contactar al usuario cuando no se está logueado -->
  <div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Debes estar logueado para contactar con <?= $thread['member']['name'] ?>">
    <i class="em em-email small-in-movil" aria-role="presentation" aria-label="ARIES"></i>
    <span class="d-none d-sm-inline small-in-movil">Contactar</span>
  </div>
<?php } ?>

<!-- Botón para compartir el hilo en redes sociales -->
<div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Compartir">
  <span class="dropdown-toggle" data-bs-toggle="dropdown">
    <i class="em em-repeat small-in-movil" aria-role="presentation" aria-label="CLOCKWISE RIGHTWARDS AND LEFTWARDS OPEN CIRCLE ARROWS"></i>
    <span class="d-none d-sm-inline small-in-movil">Compartir</span>
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
    <i class="em em-star2 small-in-movil" aria-role="presentation" aria-label="GLOWING STAR"></i><span class="d-none d-sm-inline small-in-movil">Favorito</span>
  </div>
<?php }
else
{ ?>
  <div id="favoriteBtn-<?= $thread['id'] ?>" class="favoriteBtn chip selectable isFavorite" data-thread-id="<?= $thread['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Favorito">
    <i class="em em-heart small-in-movil" aria-role="presentation" aria-label="STAR"></i><span class="d-none d-sm-inline small-in-movil">Favorito</span>
  </div>
<?php } ?>

<!-- Botón para ver estadísticas -->

<div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Estadisticas" onclick="openStatsModal(<?= $thread['id'] ?>)">
  <i class="em em-bar_chart small-in-movil" aria-role="presentation" aria-label="BAR CHART"></i>
  <span class="d-none d-sm-inline small-in-movil">Estadisticas</span>
</div>

<!-- Botón para denunciar el hilo -->
<div class="chip selectable" onclick="openReportModal(<?= $thread['id'] ?>, '<?= $thread['title'] ?>')">
  <i class="em em-warning small-in-movil" aria-role="presentation" aria-label="WARNING SIGN"></i>
  <span class="d-none d-sm-inline small-in-movil">Denunciar</span>
</div>


<?php if ($session->is_member && $thread['member_id'] == $m_id)
{ ?>
  <div class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onclick="window.location.href='<?= gLink('mi-panel/editar', ['thread_id' => $thread['id']]) ?>'">
    <i class="em em-wrench small-in-movil" aria-role="presentation" aria-label="WRENCH"></i>
    <span class="small-in-movil">Editar</span>
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