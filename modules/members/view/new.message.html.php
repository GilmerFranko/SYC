<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página para enviar nuevo mensaje
 *
 */

require Core::view('head', 'core');

?>
<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section class="first-section">

  <div class="container">
    <div class="row">
      <div class="col col-sm-12 col-md-10">
        <div class="card message-card">
          <div class="card-header" style="background: #e2f0e0; font-size: 14px">
            <div><?php echo htmlspecialchars($memberReceiver['name']); ?></div>
          </div>

          <div class="card-body">
            <form id="sendMessageForm">
              <div class="mb-3">
                <label for="messageContent" class="form-label">Tu Mensaje</label>
                <textarea class="form-control" id="messageContent" rows="5" required></textarea>
              </div>
              <input type="hidden" id="memberReceiver" value="<?php echo htmlspecialchars($memberReceiver['member_id']); ?>">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
          </div>

          <div class="card-footer">
            <!-- Footer content if needed -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('#sendMessageForm').on('submit', function(e) {
      e.preventDefault();

      const messageContent = $('#messageContent').val();
      const memberReceiver = $('#memberReceiver').val();

      $.ajax({
        type: 'POST',
        url: 'send_message.php',
        data: {
          content: messageContent,
          to_member_id: memberReceiver
        },
        success: function(response) {
          if (response.success) {
            alert('Mensaje enviado exitosamente');
            $('#messageContent').val('');
          } else {
            alert('Error al enviar el mensaje');
          }
        },
        error: function() {
          alert('Error en la comunicación con el servidor');
        }
      });
    });
  });
</script>