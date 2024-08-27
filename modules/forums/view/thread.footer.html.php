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
  <div class="chip selectable" onclick="window.location.href='<?= gLink('members/view.messages', ['member_id' => $thread['member_id']]) ?>';">
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
  <div id="favoriteBtn" class="chip selectable" data-bs-toggle="tooltip" data-bs-placement="top" title="Favorito">
    <i class="em em-star2" aria-role="presentation" aria-label="GLOWING STAR"></i>Favorito
  </div>
<?php }
else
{ ?>
  <div id="favoriteBtn" class="chip selectable isFavorite" data-bs-toggle="tooltip" data-bs-placement="top" title="Favorito">
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

<style>
  .selectable {
    cursor: pointer;
  }

  .isFavorite {
    color: red !important;
  }
</style>

<script>
  $(document).ready(function() {
    $('#favoriteBtn').on('click', function() {
      // Obtener el ID del hilo
      var threadId = <?= $thread['id']; ?>;

      // Obtener el elemento HTML del botón
      var $this = $(this);

      // Realizar la solicitud AJAX para marcar como favorito
      $.ajax({
        url: '<?= gLink('forums/threads.actions'); ?>', // URL del controlador que maneja la solicitud
        type: 'POST',
        data: {
          ajax: true,
          do: 'addFavorite',
          thread_id: threadId
        },
        dataType: 'json',
        success: function(response) {
          // Verificar si la solicitud fue exitosa
          if (response.status) {
            // Comprobar si el hilo ya es favorito
            if ($this.hasClass('isFavorite')) {
              // Cambiar el ícono a otro cuando se guarde como favorito
              $this.html('<i class="em em-star2" aria-role="presentation" aria-label="GLOWING STAR"></i>Favorito');
              // Agregar tooltip para indicar que ya es favorito
              $this.attr('title', 'Ya es favorito');
              // Agregar clase para indicar que es favorito
              $this.removeClass('isFavorite');
            } else {
              // Cambiar el ícono a otro cuando se quita como favorito
              $this.html('<i class="em em-heart" aria-role="presentation" aria-label="STAR"></i> Favorito');
              // Agregar tooltip para indicar que no es favorito
              $this.attr('title', 'Pulsa para agregar a favoritos');

              // Quitar clase para indicar que no es favorito
              $this.addClass('isFavorite');
            }

            Toastify({
              text: response.message,
              backgroundColor: "linear-gradient(120deg, #7dd957, #7dd957)",
              className: "info",
              close: true
            }).showToast();
          } else {
            alert('No se pudo agregar a favoritos. Inténtalo de nuevo.');
          }
        },
        error: function() {
          alert('Hubo un error al procesar la solicitud.');
        }
      });
    });
  });
</script>