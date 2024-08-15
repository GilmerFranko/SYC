<?php
if (isset($_GET['page'])) $page = $_GET['page'];

else $page = 1;

//$transactions = loadClass('members/transactions')->getMyTransactions($page);

$reasonAr = [
	'addForAdmin'   => 'Anadido por el administrador',
	'removeForAdmin' => 'Removido por el administrador',
];

?>
<div id="modalWallet" class="modal modal-dark">
	<div class="modal-header">
		<div class="modal-title">
			<div style="    display: flex;align-items: center;">&nbsp;<i class="material-icons">wallet</i>Monedero</div><a href="#!" class="modal-close waves-effect waves-red btn-flat"><i class="material-icons">close</i></a>
		</div>
	</div>
	<div class="modal-content">
		<div class="sub-header">
			<div class="container">
				<div class="row">
					<div class="col s6">
						<span class="valign-wrapper">Tu saldo &nbsp;&nbsp;<i class="tiny material-icons">visibility</i></span>
						<span class="walletBalance">$<?php echo getBalance() ?> USDT</span>
					</div>
					<div class="col s6">
						<div style="height: 78px;display: flex;align-items: center;flex-wrap: wrap;justify-content: center">
							<a href="#"><img src="<?php echo $config['images_url'] . '/binance2-logo.png' ?>" width="32" alt="binance-logo"></a>
							<a href="#"><img src="<?php echo $config['images_url'] . '/paypal-logo.png' ?>" width="32"></a>
							<a href="#"><img src="<?php echo $config['images_url'] . '/spei-logo.png' ?>" width="64"></a>
							<a href="#"><img src="<?php echo $config['images_url'] . '/targetas-logo.png' ?>" width="96"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>

		<div class="modal-footer" style="text-align: center !important;">
			<button class="btn btn-dark" style="width: 49%;" onclick="sendMessage('deposit')">Depositar</button>
			<button class="btn btn-dark" style="width: 49%;" onclick="sendMessage('withdrawal')">Retirar</button>
		</div>
	</div>
</div>



<style type="text/css">
	.modal-dark {
		padding: 1px;
		font-weight: 600;
		border-radius: 10px;
	}

	#modalWallet .modal-content {
		padding: 5px;
		background-color: inherit !important;

	}

	.modal-dark .sub-header {
		margin: 0px 10px;
	}

	.modal-dark {
		background: linear-gradient(to bottom, var(--primary), #E5A400);
	}

	.modal-title {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.modal-header,
	.modal-footer {
		background-color: inherit !important;
	}

	.modal-body {
		padding: 10px;
		background-color: inherit !important;
		border-radius: 8px;
	}

	.modal-dark .modal-close {
		color: var(--primary-200);
		float: right;
	}

	.modal-dark .walletBalance {
		font-size: 38px;
		font-weight: 700;
	}

	.modal-dark .pagination li.active {
		background-color: var(--green-200);
	}

	.modal-dark table {
		color: var(--darkgray) !important;
		border-radius: 8px;
	}

	.modal-dark thead tr th {
		background-color: #37474f69;
	}

	.modal-dark tbody tr {
		width: 90%;
		backdrop-filter: blur(10px);
		background-color: inherit;
		color: var(--darkgray);
	}

	.modal-dark table span {
		color: var(--grey-200) !important;
	}

	.modal-dark span,
	.modal-dark {
		color: var(--primary-200) !important;
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		// Inicializa el modal
		$('#modalWallet').modal();
	});

	function sendMessage(accion) {
		// Número de teléfono de WhatsApp
		var numeroWhatsApp = '<?php echo $config['num_phone'] ?>'; // Reemplaza con tu número de WhatsApp

		// Mensaje dependiendo de la acción
		var mensaje = '';
		if (accion === 'deposit') {
			mensaje = 'Hola, deseo depositar saldo en <?php echo $config['script_name'] ?>';
		} else if (accion === 'withdrawal') {
			mensaje = 'Hola, deseo retirar saldo en <?php echo $config['script_name'] ?>';
		}

		// Crear el enlace de WhatsApp
		var enlaceWhatsApp = 'https://wa.me/' + numeroWhatsApp + '?text=' + encodeURIComponent(mensaje);

		// Abrir WhatsApp en una nueva pestaña
		window.open(enlaceWhatsApp, '_blank');
	}
</script>
</script>