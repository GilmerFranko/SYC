<?php defined('SYC') || exit; ?>



<!-- Modal para renovar hilo -->
<div class="modal fade" id="renewModal" tabindex="-1" aria-labelledby="renewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md"> <!-- Tamaño más pequeño para el modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="renewModalLabel" style="font-size: 1rem;">Renovar Hilo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="font-size: 0.85rem;">
        <!-- Información compacta -->
        <p><strong>Auto-renueva</strong>:</p>
        <ul>
          <li>Al activar la función de renovación, el hilo se renovará <strong>instantáneamente</strong>.</li>
          <li>A partir de esa renovación, se renovará automáticamente cada <strong>X horas</strong> según el intervalo que elijas.</li>
          <li>Cada renovación tiene un costo de <strong>0.2€</strong>, que será deducido automáticamente de tu saldo.</li>
          <li>Si no tienes saldo suficiente en el momento de la renovación, <strong>no se renovará el hilo</strong> y recibirás una notificación para recargar saldo.</li>
        </ul>

        <!-- Select para elegir el intervalo de renovación -->
        <form id="renewForm" action="<?php echo gLink('forums/autorenueva.actions'); ?>" method="post">
          <!-- Campo oculto para el thread_id -->
          <input type="hidden" id="thread_id_renueva" name="thread_id" value="<?php echo $thread['id']; ?>">
          <div class="mb-2">
            <label for="interval" class="form-label" style="font-size: 0.85rem;">Intervalo de renovación:</label>
            <select class="form-select form-select-sm" id="interval" name="interval">
              <option value="1">Cada 1 hora</option>
              <option value="2">Cada 2 horas</option>
              <option value="3">Cada 3 horas</option>
              <option value="4">Cada 4 horas</option>
              <option value="5">Cada 5 horas</option>
              <option value="6" selected>Cada 6 horas</option>
            </select>
          </div>

          <!-- Mostrar el costo por cada renovación -->
          <div class="alert alert-info" style="font-size: 0.75rem; padding: 5px;">
            Se cobrará <strong>0.2€</strong> por cada renovación.
          </div>

          <div style="display: flex; justify-content: space-between;">
            <button id="renewBtn" type="submit" class="btn btn-primary btn-sm">Activar Auto-renueva</button>
            <a href="<?= gLink('members/rechargue.wallet') ?>" class="btn btn-success btn-sm">Comprar Créditos</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal para desactivar auto-renueva -->
<div class="modal fade" id="unRenewModal" tabindex="-1" aria-labelledby="unRenewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md"> <!-- Tamaño más pequeño para el modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unRenewModalLabel" style="font-size: 1rem;">Desactivar Auto-renueva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="font-size: 0.85rem;">
        <p><strong>Auto-renueva</strong>:</p>
        <ul>
          <li>Si desactivas la función de renovación, el hilo no se renovará automáticamente.</li>
          <li>Si deseas renovar el hilo, deberás hacerlo manualmente.</li>
        </ul>

        <!-- Mostrar si ya está activado el auto-renueva -->
        <div id="is-auto-renueva" class="alert alert-success d-none" style="font-size: 0.75rem; padding: 5px;">
          <strong>Auto-renueva</strong> ya está activado.
        </div>

        <form id="unRenewForm" action="<?php echo gLink('forums/autorenueva.actions'); ?>" method="post">
          <!-- Campo oculto para el thread_id -->
          <input type="hidden" id="thread_id_unRenueva" name="thread_id" value="<?php echo $thread['id']; ?>">
          <div style="display: flex; justify-content: space-between;">
            <button id="unRenewBtn" type="submit" class="btn btn-danger btn-sm">Desactivar Auto-renueva</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    // Capturar el evento de submit del formulario de renovación
    $('#renewForm').submit(function(event) {
      event.preventDefault(); // Prevenir el envío normal del formulario

      // Recoger los datos del formulario
      var formData = {
        thread_id: $('#thread_id_renueva').val(), // ID del hilo (debe estar en el formulario)
        interval: $('#interval').val(), // Intervalo seleccionado
        do: 'enableAutoRenew', // Acción a realizar (activar auto-renueva)
        ajax: 'true',
        token: '<?php echo $session->token; ?>',
      };

      // Enviar la solicitud AJAX al controlador
      $.ajax({
        url: '<?php echo gLink('forums/autorenueva.actions'); ?>', // Ruta al controlador PHP 
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
          console.log(response)
          if (response.status) {
            // Mostrar mensaje de éxito
            Toastify({
              text: response.message,
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
              className: "info",
              close: true
            }).showToast();
            // Cierra modal
            $('#renewModal').modal('hide');
            // Cambia data-bs-target del boton
            $("#renewBtnModal").attr("data-bs-target", "#unRenewModal");
          } else {
            // Mostrar mensaje de error
            Toastify({
              text: response.message,
              backgroundColor: "linear-gradient(to right, #ff4161, #ff4b2b)",
              className: "error",
              close: true
            }).showToast();
          }
        },
        error: function(xhr, status, error) {
          console.error('Error en la solicitud:', error);
          alert('Ocurrió un error al intentar renovar el hilo.');
        }
      });

    });

    // Deshabilita funcion auto-renueva
    $('#unRenewForm').submit(function(event) {
      event.preventDefault(); // Prevenir el envío normal del formulario

      // Recoger los datos del formulario
      var formData = {
        thread_id: $('#thread_id_renueva').val(), // ID del hilo (debe estar en el formulario)
        do: 'disableAutoRenew', // Acción a realizar (activar auto-renueva)
        ajax: 'true',
        token: '<?php echo $session->token; ?>',
      };

      // Enviar la solicitud AJAX al controlador
      $.ajax({
        url: '<?php echo gLink('forums/autorenueva.actions'); ?>', // Ruta al controlador PHP 
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
          console.log(response)
          if (response.status) {
            // Mostrar mensaje de éxito
            Toastify({
              text: response.message,
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
              className: "info",
              close: true
            }).showToast();
            // Cierra modal
            $('#renewModal').modal('hide');
            // Cambia data-bs-target del boton
            $("#renewBtnModal").attr("data-bs-target", "#renewModal");
          } else {
            // Mostrar mensaje de error
            Toastify({
              text: response.message,
              backgroundColor: "linear-gradient(to right, #ff4161, #ff4b2b)",
              className: "error",
              close: true
            }).showToast();
          }
        },
        error: function(xhr, status, error) {
          console.error('Error en la solicitud:', error);
          alert('Ocurrió un error al intentar desactivar auto-renueva.');
        }
      });
    })

    // Mostrar el modal de renovación para el hilo correcto
    $('#renewModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Botón que activó el modal
      var threadId = button.data('thread-id'); // Obtener el ID del hilo del atributo data-thread-id

      // Asignar el thread_id al campo oculto del formulario
      $('#thread_id').val(threadId);
      $('#thread_id_unRenueva').val(threadId);
    });
  });

  // INSERVIBLE
  /*  document.addEventListener('DOMContentLoaded', function() {
     var renewModal = document.getElementById('renewModal');

     renewModal.addEventListener('show.bs.modal', function(event) {
       var button = event.relatedTarget; // Botón que activó el modal
       var threadId = button.getAttribute('data-thread-id'); // Obtén el dato del botón


     });
   }); */
</script>