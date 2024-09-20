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
    let lastMessageId = <?php echo $lastMessageId; ?>;
    let canSend = true; // Flag para determinar si se puede enviar un mensaje

    $('#message-form').submit(function(event) {
      event.preventDefault();

      if (!canSend) {
        Toastify({
          text: 'Espere 5 segundos antes de enviar otro mensaje',
        }).showToast();
        return false;
      }

      canSend = false; // No se permite enviar otro mensaje

      let messageContent = $('#messageContent').val();
      let receiverId = <?php echo $receiverId; ?>;
      $('#messageContent').val(''); // Limpiar el campo de texto

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
            $('#messages-container').append('<div class="d-flex justify-content-end"><div class="message message-sent"><p>' + response.data.content + '</p><small>' + response.data.sent_at_formatted + '</small></div></div>');
            $('#messages-container').scrollTop($('#messages-container')[0].scrollHeight); // Desplazarse hacia abajo
            lastMessageId = response.data.id;

            // Enviar correo al usuario
            if (response.data.sendEmail) {
              sendEmail(receiverId);
            }
            // Fin enviar correo al usuario

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
        },
        complete: function() {
          // Después de enviar el mensaje, permitir enviar otro mensaje después de 5 segundos
          setTimeout(function() {
            canSend = true;
          }, 5000);
        }
      });
    });

    $('#messageContent').keypress(function(event) {
      if (event.key === 'Enter') {
        $('#message-form').submit();
      }
    });

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
              $('#messages-container').append('<div class="d-flex ' + (message.from_member_id == <?php echo $m_id; ?> ? 'justify-content-end' : 'justify-content-start') + '"><div class="message ' + (message.from_member_id == <?php echo $m_id; ?> ? 'message-sent' : 'message-received') + '"><p>' + message.content + '</p><small>' + message.sent_at_formatted + '</small></div></div>');
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

  function sendEmail(receiverId) {
    $.ajax({
      type: 'POST',
      url: '<?= gLink('members/message.actions'); ?>',
      data: {
        do: 'sendEmail',
        ajax: true,
        to_member_id: receiverId
      },
      dataType: 'json',
      success: function(response) {
        console.log(response);
      }
    });
  }
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