<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de los mensajes global
 *
 *
 */
require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<style type="text/css">
	#chat-container {
		width: 100%;
		background-color: #4f4e4e00;
		border-radius: 8px;
		overflow: hidden;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	.chat-header {
		background-color: #555;
		color: #fff;
		padding: 15px;
		text-align: center;
		border-bottom: 1px solid #666;
	}

	.chat-messages {
		padding: 15px;
		overflow-y: scroll;
		max-height: 55vh;
	}

	.message {
		margin-bottom: 15px;
		border-radius: 8px;
		padding: 8px;
		max-width: 100%;
		width: max-content;
		min-width: 200px;
	}

	.message-image {
		margin-bottom: 15px;
		border-radius: 8px;
		padding: 8px;
		max-width: 100%;
		width: max-content;
	}

	.message-image img {
		width: 100%;
		max-width: 400px;
		border-radius: 8px;
	}

	.message .sender {
		font-weight: bold;
		color: #4caf50;
	}

	.message .message-footer {
		margin-top: 15px;
		font-size: 12px;
		white-space: nowrap;
	}


	.message-sent {
		background-color: #4caf50;
		color: #fff;
		float: right;
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.message-received {
		background-color: #009688;
	}

	.message-referi {
		background-color: #262c51;
	}

	.chat-input {
		padding: 15px;
		border-top: 1px solid #262c51;
	}

	.notification-login {
		margin: 10px 0px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.notifications-log {
		overflow-y: scroll;
		height: 200px;
		display: flex;
		justify-content: center;
		flex-direction: column;
	}

	.container-message-sent {
		width: 100%;
		display: flex;
		justify-content: flex-end;
		align-items: flex-end;
	}

	.message-list {
		min-height: 56vh;
	}

	.message-body {
		padding: 0 10px 0 4px;
	}

	#scrollToBottomBtn {
		position: fixed;
		bottom: 180px;
		right: 9px;
		z-index: 9999;
	}
</style>


<section style="margin: 10px 0 65px 0;">
	<div class="container">
		<div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Mensajes: <?php echo $channel['name'] ?></div>
	</div>

	<!-- Mensajes -->
	<div style="margin: 0 15px; padding: 0 0 100px 0;">
		<div class="message-list">
			<?php if ($messages != false)
			{
			?>
				<div id="preloader-messages" class="center-align">
					<div class="preloader-wrapper big active">
						<div class="spinner-layer spinner-blue-only">
							<div class="circle-clipper left">
								<div class="circle"></div>
							</div>
							<div class="gap-patch">
								<div class="circle"></div>
							</div>
							<div class="circle-clipper right">
								<div class="circle"></div>
							</div>
						</div>
					</div>
				</div>
			<?php }
			else
			{ ?>
				<!-- Mensaje vacío -->
				<div class="center-align">No hay mensajes</div>
			<?php } ?>
		</div>
		<!-- Sección de envío de mensajes -->
		<div style="background: var(--darkgray);position: fixed;right: 0;width: 100vw;bottom: 65px;">
			<form id="sendMessageForm" style="display: flex;justify-content: center;align-items: center; padding: 0 10px">
				<div class="input-field" bis_skin_checked="1" style="width: 100%;">
					<textarea id="messageInput" name="message" class="validate valid materialize-textarea" data-length="1024"></textarea>
					<label for="messageInput" class="active">Mensaje</label>
				</div>
				<button class="btn waves-effect waves-light" type="submit" id="sendMessageBtn"><i class="material-icons notranslate">send</i></button>
			</form>
			<!--<form id="sendFileForm" method="post" enctype="multipart/form-data" action="<?php echo gLink('global_messages/view_messages') ?>" style="display: flex; justify-content: center; align-items: center;">
				<input type="hidden" name="channel_id" value="<?php echo $channel_id ?>">
				<!-- Input de archivo oculto 
				<input type="file" name="file_channel" id="fileInput" accept="image/png, image/jpeg, image/gif" hidden>&nbsp;
				<!-- Botón con icono de subir archivo 
				<button class="btn waves-effect waves-light" type="button" id="sendFileBtn">
					<i class="material-icons notranslate">file_upload</i>
				</button>
			</form>-->
			<button id="scrollToBottomBtn" class="btn " style="display: none; position: fix">
				<i class="material-icons notranslate">arrow_downward</i>
			</button>
		</div>
</section>

<script>
	scroll = true;
	channelsrc = '<?php echo $chanelsrc ?>';
	alreadyExecuted = false;
	/* Almacena los ID de los mensajes recibidos */
	var messagesIDS = [0];

	$(document).ready(function() {

		$('#messageInput').on('keypress', function(e) {
			if (e.key === 'Enter' && !e.shiftKey) {
				$('#sendMessageForm').submit();
				return false;
			}
		});

		// Evento click en el botón de enviar mensaje
		$('#sendMessageForm').submit(function() {
			// Obtener el mensaje del input
			var message = $('#messageInput').val();

			// Verificar si el mensaje está vacío
			if (message.trim() === '') {
				M.toast({
					html: 'El mensaje no puede estar vacío',
				});
				return false;
			} else {
				// Limpiar el campo de mensaje
				$('#messageInput').val('');

				// Realizar la petición AJAX
				$.ajax({
					url: "<?php echo gLink('global_messages/view_messages', array('sendMessage' => true, 'channel_id' => $channel_id)); ?>",
					type: 'post',
					data: {
						ajax: true,
						message: message
					},
					success: function(response) {

						// Parsear la respuesta JSON
						var data = JSON.parse(response);

						// Verificar el estado de la respuesta
						if (data.status === true) {
							// Agregar el nuevo mensaje al DOM
							//addMessageToDOM(data);

							getBasicDataChannel(false);

						} else {
							// Manejar cualquier mensaje de error
							M.toast({
								html: data.message,
							})
						}
					},
					error: function(error) {
						// Manejar errores si es necesario
						console.error('Error en la petición AJAX', error);
					}
				});
				return false;
			}
		});

		// Agregar evento click al botón de enviar mensaje
		$('#sendFileBtn').click(function() {
			// Simular clic en el input de archivo cuando se hace clic en el botón
			$('#fileInput').click();
		});

		// Agregar evento change al input de archivo
		$('#fileInput').change(function() {
			// Enviar el formulario cuando se selecciona un archivo
			$('#sendFileForm').submit();
		});

		// Iniciar la verificación al cargar la página
		getBasicDataChannel();

		// Detectar la posición de desplazamiento y cambiar la visibilidad del botón
		// Este evento se dispara cada vez que el usuario desplaza la página.
		// Se utiliza para ocultar o mostrar el botón "Ir al fondo" en función de la posición de desplazamiento.
		// Si es así, se oculta el botón utilizando button.hide(). De lo contrario, se muestra el botón utilizando button.show().
		$(window).scroll(function() {
			const scrollPosition = $(window).scrollTop();
			const messageListHeight = $('.message-list').height();
			const messageListBottom = messageListHeight + $('.message-list').offset().top;
			const button = $('#scrollToBottomBtn');

			if (scrollPosition > messageListBottom - window.innerHeight) {
				button.hide();
			} else {
				button.show();
			}
		});

		// Click event handler for scroll button
		$('#scrollToBottomBtn').click(function() {
			$('html, body').animate({
				scrollTop: $("#sendMessageForm").offset().top - 500
			}, 500);
		});


	});

	// Función para agregar un nuevo mensaje al DOM
	function addMessageToDOM(data) {
		var messageContainer;
		if (data.status) {

			/* Agregar id a la lista */
			messagesIDS.push(parseInt(data.data.id));

			message = data.data

			/** Si es una imagen */
			if (message.image_url != null) {

				messageContainer += '<div class="container-message-sent">' +
					'<div class="message-image message-sent">' +
					'<span class="sender">Tú:</span>' +
					'<div class="message-body"><img src="' + channelsrc + messages.image_url + '" class="materialboxed" alt="Imagen"></div>' +
					'</div></div>';

			} else {

				// Determinar la clase del contenedor de mensajes según el remitente
				if (message.member_id != <?php echo $m_id ?>) {
					messageContainer = '<div class="message message-received">' +
						'<span class="sender">' + message.member.name + ':</span>' +
						'<div style="display: flex;justify-content: space-between;align-items: center;align-items: flex-end;">' +
						'<div class="message-body">' + message.content + '</div>' +
						'<span class="message-footer">' + message.sent_at + '</span>' +
						'</div>' +
						'</div>';
				} else {
					messageContainer = '<div class="container-message-sent">' +
						'<div class="message message-sent">' +
						'<div class="message-body">' + message.content + '</div>' +
						'<span class="message-footer">' + message.sent_at + '</span>' +
						'</div></div>';

				}
			}

			// Agregar el nuevo mensaje al contenedor de mensajes
			$('.message-list').append(messageContainer);

			// Si el usuario está muy arriba, desplazar página para mostrar nuevo mensaje.
			if (!$('#scrollToBottomBtn').is(':visible')) {
				$('html, body').animate({
					scrollTop: $(document).height()
				}, 500);
			}
		} else {

			// Manejar cualquier mensaje de error
			M.toast({
				html: data.message,
			})
		}
	}

	oneScroll = true;
	// Función para cargar mensajes existentes al cargar la página
	function loadExistingMessages(messages) {

		//$('.message-list').html(''); // Clear the message container

		let messageContainer = '';

		// Loop through messages based on timestamps (keys)
		for (const i in messages) {
			const message = messages[i];

			/* Agregar ID de mensaje a la lista */
			messagesIDS.push(parseInt(message.id));

			/* Determinar la clase del contenedor de mensajes por remitente */
			/* Si es una Imagen */
			if (message.hasOwnProperty('image_url') && message.image_url !== null) {
				if (message.member_id != <?php echo $m_id ?>) {
					messageContainer += '<div class="container-message-received">' +
						'<div class="message-image message-received">' +
						'<span class="sender">' + message.member.name + '</span>' +
						'<div class="message-body"><img src="' + channelsrc + message.image_url + '" class="materialboxed" alt="Imagen"></div>' +
						'</div></div>';
				} else {
					messageContainer += '<div class="container-message-sent">' +
						'<div class="message-image message-sent">' +
						'<div class="message-body"><img src="' + channelsrc + message.image_url + '" class="materialboxed" alt="Imagen"></div>' +
						'</div></div>';
				}
				/* Es un mensaje simple */
			} else {
				if (message.member_id != <?php echo $m_id ?>) {
					// Mensaje entrante
					messageContainer += '<div class="message message-received">' +
						'<span class="sender">' + message.member.name + ':</span>' +
						'<div style="display: flex;justify-content: space-between;align-items: center;align-items: flex-end;">' +
						'<div class="message-body">' + message.content + '</div>' +
						'<span class="message-footer">' + message.sent_at + '</span>' +
						'</div></div>';
				} else {
					messageContainer += '<div class="container-message-sent">' +
						'<div class="message message-sent">' +
						'<div class="message-body">' + message.content + '</div>' +
						'<span class="message-footer">' + message.sent_at + '</span>' +
						'</div></div>';

				}
			}
		}

		// Si el usuario está muy arriba, desplazar página para mostrar nuevo mensaje.
		if (!$('#scrollToBottomBtn').is(':visible')) {
			$('html, body').animate({
				scrollTop: $(document).height()
			}, 500);
		}

		// Append the new message container to the message list
		$('.message-list').append(messageContainer);

		$('.materialboxed').materialbox();
	}

	// Función para verificar los mensajes periódicamente
	function getBasicDataChannel(repeat = true) {

		// Realizar la petición AJAX
		$.ajax({
			url: "<?php echo gLink('global_messages/view_messages', array('getBasicDataChannel' => true, 'channel_id' => $channel_id)); ?>",
			data: {
				ajax: true,
				maxID: Math.max.apply(Math, messagesIDS)
			},
			type: 'post',
			success: function(response) {
				//console.log(response)
				r = JSON.parse(response);

				/** No actualizar los mensajes si el usuario tiene una imagen abierta (materialbox) */
				if ($('#materialbox-overlay').length <= 0) {
					loadExistingMessages(r.messages)
				}

				if (repeat) {
					// Actualizar el tiempo restante cada segundo
					setTimeout(function() {
						getBasicDataChannel();
					}, 3000);
				}

				if (!alreadyExecuted) {
					alreadyExecuted = true;
					// Quitar preloader
					$('#preloader-messages').remove();
					// Desplazar hasta el final de la página
					$('html, body').animate({
						scrollTop: $(document).height()
					}, 500);

				}

			},
			error: function(error) {
				// Manejar errores si es necesario
				console.error('Error en la petición AJAX', error);
			}
		});
	}
</script>
<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->