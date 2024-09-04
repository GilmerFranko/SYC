<!-- Modal para denunciar el hilo -->
<!-- Modal para denunciar el hilo -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">Denunciar Hilo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="reportForm" action="<?php echo gLink('forums/threads.actions'); ?>" method="post">
          <input type="hidden" id="thread_id" name="thread_id">
          <input type="hidden" name="do" value="report">
          <input type="hidden" name="token" value="<?php echo $session->token; ?>">
          <input type="hidden" name="ajax" value="<?php echo $session->token; ?>">

          <div class="mb-3">
            <label for="threadTitle" class="form-label">Título del Hilo</label>
            <input type="text" class="form-control" id="threadTitle" name="threadTitle" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Razón de la Denuncia</label>
            <div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="reason" id="reason1" value="Contenido inapropiado" required>
                <label class="form-check-label" for="reason1">Contenido inapropiado</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="reason" id="reason2" value="Spam">
                <label class="form-check-label" for="reason2">Spam</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="reason" id="reason3" value="Incitación al odio">
                <label class="form-check-label" for="reason3">Incitación al odio</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="reason" id="reason4" value="Otra razón">
                <label class="form-check-label" for="reason4">Otra razón</label>
              </div>
            </div>
          </div>
          <div class="mb-3" id="customReasonContainer" style="display: none;">
            <label for="customReason" class="form-label">Especificar Razón</label>
            <small>Opcional</small>
            <textarea class="form-control" id="customReason" name="customReason" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar Denuncia</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  function openReportModal(threadId, threadTitle) {
    // Resetea el formulario y oculta el campo personalizado
    document.getElementById('reportForm').reset();
    document.getElementById('customReasonContainer').style.display = 'none';

    // Asigna los valores al formulario dentro del modal
    document.getElementById('thread_id').value = threadId;
    document.getElementById('threadTitle').value = threadTitle;

    // Muestra el modal
    var reportModal = new bootstrap.Modal(document.getElementById('reportModal'));
    reportModal.show();
  }

  // Mostrar u ocultar el campo de razón personalizada
  document.querySelectorAll('input[name="reason"]').forEach(radio => {
    radio.addEventListener('change', function() {
      if (this.value === 'Otra razón') {
        document.getElementById('customReasonContainer').style.display = 'block';
      } else {
        document.getElementById('customReasonContainer').style.display = 'none';
      }
    });
  });


  // Enviar el formulario de la manera habitual
  document.querySelector('#reportForm').addEventListener('submit', function(event) {
    // Cierra modal
    var reportModal = bootstrap.Modal.getInstance(document.getElementById('reportModal'));
    reportModal.hide();

    // 
    event.preventDefault();
    const formData = new FormData(this);
    fetch(this.action, {
        method: this.method,
        body: formData,
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          Toastify({
            text: data.message,
            duration: 3000,
            gravity: 'top',
            backgroundColor: 'linear-gradient(to right, #00b894, #00b894)',
            stopOnFocus: true, // Optional
          }).showToast();
          document.getElementById('reportModal').querySelector('.close').click();
        } else {
          Toastify({
            text: data.message,
            duration: 3000,
            gravity: 'top',
            backgroundColor: 'linear-gradient(to right, #ff6c6c, #ff6c6c)',
            stopOnFocus: true, // Optional
          }).showToast();
        }
      })
      .catch(error => {
        console.error(error);
        Toastify({
          text: 'Error al enviar el formulario',
          duration: 3000,
          gravity: 'top',
          backgroundColor: 'linear-gradient(to right, #ff6c6c, #ff6c6c)',
          stopOnFocus: true, // Optional
        }).showToast();
      });
  });
</script>