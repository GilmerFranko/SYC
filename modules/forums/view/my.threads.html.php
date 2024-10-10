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


<section>
  <!-- Header -->
  <?php require Core::view('menu', 'core'); ?>
  <!-- / Header -->
  <div class="container">
    <div class="row">
      <!-- Título principal de la página -->
      <div class="col-12">
        <h2 class="text-center my-4" style="font-weight: bold; color: #333;">
          <span class="text-primary">Mis anuncios</span>
        </h2>
      </div>
      <div class="col-12 text-center">
        <a href="<?= gLink('forums/new.thread') ?>" class="btn btn-primary">Crear Anuncio</a>
        <br>
        <hr>
      </div>
    </div>
    <div class="row">
      <?php if ($threads['rows'] > 0) : ?>
        <?php
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
                  <a href="<?= loadClass('forums/threads')->getThreadUrl($thread['id']) ?>" class="btn btn-sm text-primary">Ver</a>
                  <a href="<?= gLink('mi-panel/editar', array('thread_id' => $thread['id'])) ?>" class="btn btn-sm text-primary">Modificar</a>
                  <form id="delete-form-<?= $thread['id']; ?>" action="<?= gLink('forums/threads.actions') ?>" method="post">
                    <input type="hidden" name="thread_id" value="<?= $thread['id']; ?>" />
                    <input type="hidden" name="do" value="delete" />
                    <input type="hidden" name="csrf_token" value="<?= $session->token; ?>" />
                    <input type="hidden" name="ajax" value="true">
                    <button type="button" class="btn btn-sm text-primary delete-button" data-thread-id="<?= $thread['id']; ?>">Eliminar</button>
                  </form>
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

<script>
  // Esperar a que el DOM esté completamente cargado
  $(document).ready(function() {
    // Manejar el evento click del botón de eliminar
    $('.delete-button').on('click', function(e) {
      e.preventDefault(); // Prevenir el comportamiento predeterminado del botón

      // Obtener el ID del hilo
      var threadId = $(this).data('thread-id');

      // Mostrar alerta de confirmación con SweetAlert
      Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás deshacer esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          // Si el usuario confirma, enviar el formulario por AJAX
          var form = $('#delete-form-' + threadId);
          $.ajax({
            url: form.attr('action'), // URL del formulario
            method: 'POST',
            data: form.serialize(), // Serializar los datos del formulario
            dataType: 'json',
            success: function(response) {
              console.log(response)
              // Asumimos que la respuesta es un objeto JSON
              if (response.success) {
                Swal.fire('Eliminado', response.msg, 'success');
                form.closest('.col-md-6').remove(); // Remover el anuncio del DOM
              } else {
                Swal.fire('Error', response.msg, 'error');
              }
            },
            error: function() {
              Swal.fire('Error', 'Hubo un problema con la solicitud', 'error');
            }
          });
        }
      });
    });
  });
</script>