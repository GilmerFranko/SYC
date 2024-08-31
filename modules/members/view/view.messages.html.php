<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de mensajes entre dos usuarios
 */

require Core::view('head', 'core');
$lastMessageId = 0; // Variable para almacenar el ID del último mensaje
?>

<section>
  <!-- Header -->
  <?php require Core::view('menu', 'core'); ?>
  <!-- / Header -->

  <div class="container">
    <div class="row">
      <div class="col col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <!--<img src="<?php echo htmlspecialchars($memberReceiver['profile_picture']); ?>" alt="<?php echo htmlspecialchars($memberReceiver['name']); ?>" class="rounded-circle me-2" style="width: 40px; height: 40px;">-->
              <span><?php echo htmlspecialchars($memberReceiver['name']); ?></span>
            </div>
          </div>
          <div class="card-body" id="messages-container">
            <?php if (!empty($messages)) : ?>
              <?php foreach ($messages as $message) : ?>
                <div class="d-flex <?php echo ($message['from_member_id'] == $m_id) ? 'justify-content-end' : 'justify-content-start'; ?>">
                  <div class="message <?php echo ($message['from_member_id'] == $m_id) ? 'message-sent' : 'message-received'; ?>">
                    <p><?php echo htmlspecialchars($message['content']); ?></p>
                    <small><?php echo loadClass('core/date')->getFormattedDate($message['sent_at']); ?></small>
                  </div>
                </div>
                <?php $lastMessageId = $message['id']; // Actualiza el ID del último mensaje 
                ?>

              <?php endforeach; ?>
            <?php else : ?>
              <p>No hay mensajes para mostrar. Escribe el primero.</p>
            <?php endif; ?>
          </div>
          <div class="card-footer">
            <form id="message-form" class="d-flex align-items-center" style="width: 100%;">
              <textarea id="messageContent" class="form-control me-2" rows="1" placeholder="Escribe un mensaje..."></textarea>
              <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $('#message-form').submit(function(event) {
      event.preventDefault();

      var messageContent = $('#messageContent').val();
      var receiverId = <?php echo $receiverId; ?>;

      $.ajax({
        type: 'POST',
        url: '<?= gLink('members/message.actions'); ?>',
        data: {
          do: 'sendMessage',
          ajax: true,
          messageContent: messageContent,
          to_member_id: receiverId
        },
        dataType: 'json',
        success: function(response) {
          if (response.status) {
            $('#messageContent').val(''); // Limpiar el campo de texto
            $('#messages-container').append('<div class="d-flex justify-content-end"><div class="message message-sent"><p>' + response.data.content + '</p><small>' + response.data.sent_at + '</small></div></div>');
            $('#messages-container').scrollTop($('#messages-container')[0].scrollHeight); // Desplazarse hacia abajo
            lastMessageId = response.data.id;
          } else {
            Toastify({
              text: response.msg,
              duration: 3000,
              close: true,
              gravity: "top",
              position: "right",
              backgroundColor: "#e74c3c",
              stopOnFocus: true
            }).showToast();
          }
        },
        error: function() {
          alert('Error en la comunicación con el servidor');
        }
      });
    });

    $('#messageContent').keypress(function(event) {
      if (event.key === 'Enter') {
        $('#message-form').submit();
      }
    });

    let lastMessageId = <?php echo $lastMessageId; ?>;

    function loadNewMessages() {
      $.ajax({
        type: 'POST',
        url: '<?= gLink('members/message.actions'); ?>',
        data: {
          ajax: true,
          do: 'loadNewMessages',
          lastMessageId: lastMessageId,
          to_member_id: <?php echo $receiverId; ?>
        },
        dataType: 'json',
        success: function(response) {
          console.log(response);
          if (response.status && response.data.rows > 0) {
            response.data.data.forEach(function(message) {
              $('#messages-container').append('<div class="d-flex ' + (message.from_member_id == <?php echo $m_id; ?> ? 'justify-content-end' : 'justify-content-start') + '"><div class="message ' + (message.from_member_id == <?php echo $m_id; ?> ? 'message-sent' : 'message-received') + '"><p>' + message.content + '</p><small>' + message.sent_at + '</small></div></div>');
              lastMessageId = message.id; // Actualiza el ID del último mensaje cargado
            });
          }
        },
        error: function() {
          alert('Error en la comunicación con el servidor');
        }
      });
    }

    // Llamar a la función cada cierto tiempo para cargar nuevos mensajes
    setInterval(loadNewMessages, 5000);
  });
</script>

<style>
  .card-header {
    background-color: var(--primary-200);
    color: white;
    padding: 10px;
    border-radius: 5px 5px 0 0;
  }

  .message {
    padding: 10px;
    margin-bottom: 10px;
    max-width: 75%;
    border-radius: 20px;
    font-size: 0.9rem;
  }

  .message-sent {
    background-color: var(--primary-200);
    color: white;
    text-align: right;
  }

  .message-received {
    background-color: #FFFFFF;
    text-align: left;
  }

  #messages-container {
    max-height: 500px;
    overflow-y: auto;
    padding: 10px;
    background-color: #E5DDD5;
  }

  .card-footer {
    background-color: #f7f7f7;
  }

  #messageContent {
    resize: none;
    border-radius: 20px;
  }
</style>