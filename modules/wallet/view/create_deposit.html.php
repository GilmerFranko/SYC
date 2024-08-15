<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista del área "Creditos" de la Cuenta
 *
 *
 * Signature Key: b2z8eS6uAaB3y3a6FRhHKKB2wxdcgx
 * Shop ID: 114913
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/wallet.css" />

<style>
	/** oculta flechas en input number **/
	/* Para navegadores basados en WebKit */
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		appearance: none;
		margin: 0;
	}

	/* Para otros navegadores */
	input[type=number] {
		-moz-appearance: textfield;
		/* Firefox */
	}

	/** oculta flechas en input number **/
</style>
<section>
	<div class="card-panel green lighten-4 green-text text-darken-4 flow-text ">
		<p><strong>Instrucciones de Pago:</strong></p>
		<p>1. Deposita en la cuenta de Binance que aparece en pantalla el monto que deseas transferir. Asegúrate de que el monto esté entre $10 y $150 USD.</p>
		<p>2. Después de realizar el depósito, completa el campo "Número de referencia de Binance" con el número proporcionado por Binance para esta transacción.</p>
		<p>3. Ingresa tu nombre completo en el campo correspondiente. Si tienes un ID de Binance, también puedes ingresarlo, aunque es opcional.</p>
		<p>4. Proporciona tu correo de Gmail en el campo indicado. Este correo será utilizado para fines de contacto y confirmación.</p>
		<p>5. Una vez que hayas verificado que has realizado el pago correctamente, presiona el botón "He pagado" para confirmar la transacción.</p>
		<p>6. Después de presionar el botón, se procesará tu pago y se actualizará automáticamente la cantidad depositada en las credenciales de Binance.</p>
		<p><strong>Recuerda:</strong> El proceso de verificación y recarga puede tardar de 1 a 2 horas. ¡Gracias por tu paciencia!</p>
	</div>

	<div class="container">
		<div class="row">
			<div class="col s12 m6">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Datos de tu cuenta Binance</span>
						<form id="depositForm" method="post">
							<input type="hidden" name="app" value="wallet">
							<input type="hidden" name="section" value="create_deposit">
							<input type="hidden" name="newDeposit" value="true">
							<div class="input-field">
								<input type="email" id="email" name="binance_email" required>
								<label for="email">Email de tu Binance</label>
							</div>
							<div class="input-field">
								<input type="text" id="fullName" name="binance_fullname" required>
								<label for="fullName">Tu Nombre Completo</label>
							</div>
							<div class="input-field">
								<input type="text" id="binanceId" name="binance_id">
								<label for="binanceId">ID de tu Binance (opcional)</label>
							</div>
							<div class="input-field">
								<input type="text" id="referenceNumber" name="reference" required>
								<label for="referenceNumber">Número de referencia del pago de Binance</label>
							</div>
							<div class="input-field">
								<input type="number" id="amount" min="10" max="150" value="10" name="amount" required>
								<label for="amount">Monto ($10 - $150)</label>
							</div>
							<button class="btn waves-effect waves-light btn-primary" type="submit">He pagado</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col s12 m6">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Transfiere a esta cuenta Binance</span>
						<p><strong>Nombre del titular:</strong> Gilmer Franco</p>
						<p><strong>Número de cuenta:</strong> BINANCE123456789</p>
						<p><strong>Tipo de cuenta:</strong> Binance USDT</p>
						<p><strong>Correo de contacto:</strong> ejemplo@gmail.com</p>
						<h4><strong>Monto a depositar:</strong></h4>
						<h3 id="displayAmount"><span id="depositAmount">$10.00</span> USDT</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {

		// Actualizar cantidad a depositar en el lado de Binance
		$("#amount").keyup(function() {
			amount = $(this).val();

			$('#depositAmount').text('$' + amount);

			if (amount < 10) {
				$('#displayAmount').css('border-bottom', '2px solid red')
			} else if (amount > 10) {
				$('#displayAmount').css('border-bottom', '2px solid green')
			}

		});

		// Manejar envío del formulario
		// Realizar comprobaciones
		$('#depositForm').submit(function(e) {
			e.preventDefault(); // Prevenir envío por defecto

			// Obtener valores del formulario
			var amount = $('#amount').val();
			var referenceNumber = $('#referenceNumber').val();
			var fullName = $('#fullName').val();
			var binanceId = $('#binanceId').val();
			var email = $('#email').val();

			if (!referenceNumber || !fullName || !email) {
				alert('Por favor, completa todos los campos obligatorios.');
				return;
			}

			// Actualizar cantidad a depositar en el lado de Binance
			$('#depositAmount').text('$' + amount + ' USDT');

			// Mostrar alerta SweetAlert2
			Swal.fire({
				title: '¿Estás seguro?',
				html: `
                    <p>A continuación se muestran los datos que proporcionaste:</p>
                    <ul>
                        <li>Monto: ${amount}</li>
                        <li>N°: ${referenceNumber}</li>
                        <li>Nombre Completo: ${fullName}</li>
                        <li>Binance ID: ${binanceId}</li>
                        <li>Email: ${email}</li>
                    </ul>`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Sí, estoy seguro',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.isConfirmed) {
					// Aquí puedes enviar el formulario si el usuario confirma
					$('#depositForm')[0].submit();
				}
			});
		});
	});
</script>

<?php require Core::view('footer', 'core'); ?>