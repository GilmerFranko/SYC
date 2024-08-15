<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de Depositos Pendientes
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<!-- CSS ADICIONAL -->
<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/admin.css" />

<section id="modDepositDetails">
	<br>
	<?php if ($deposit): ?>

		<h3>Detalles del Depósito</h3>
		<div class="row">
			<div class="col s12 m6">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Información del Depósito</span>
						<p><strong>ID:</strong> <?php echo $deposit['id']; ?></p>
						<p><strong>Usuario:</strong> <?php echo $deposit['username']; ?></p>
						<p><strong>Monto:</strong> <?php echo $deposit['amount']; ?>$</p>
						<p><strong>Email Binance:</strong> <?php echo $deposit['binance_email']; ?></p>
						<p><strong>ID Binance:</strong> <?php echo $deposit['binance_id']; ?></p>
						<p><strong>Nombre Completo:</strong> <?php echo $deposit['binance_fullname']; ?></p>
						<p><strong>N° Referencia:</strong> <?php echo $deposit['reference']; ?></p>
						<p><strong>Fecha de Creación:</strong> <?php echo $deposit['created_at']; ?></p>
					</div>
				</div>
			</div>
			<div class="col s12 m6">
				<div class="card">
					<div class="card-content">
						<span class="card-title">Estado del Depósito</span>
						<form action="<?php echo gLink('admin/wallet_deposit_details', array('setStatus' => true, 'deposit_id' => $deposit['id'])); ?>" method="POST">
							<p>
								<label>
									<input name="status" type="radio" value="0" <?php echo $deposit['status'] == '0' ? 'checked' : ''; ?> />
									<span>Pendiente</span>
								</label>
							</p>
							<p>
								<label>
									<input name="status" type="radio" value="1" <?php echo $deposit['status'] == '1' ? 'checked' : ''; ?> />
									<span>Pagado</span>
								</label>
							</p>
							<p>
								<label>
									<input name="status" type="radio" value="2" <?php echo $deposit['status'] == '2' ? 'checked' : ''; ?> />
									<span>Cancelado</span>
								</label>
							</p>
							<button class="btn waves-effect waves-light" type="submit">Guardar</button>
						</form>
						<h5><a href="<?php echo gLink('admin/wallet_add_remove_credits', ['member_id' => $deposit['member_id']]) ?>"> Actualizar saldo</a></h5>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="center">
			<p>No se encontraron detalles para este depósito.</p>
		</div>
	<?php endif ?>
</section>

<script>
	$(".mark-paid").click(function() {
		let button = $(this)
		// Mostrar alerta de confirmación
		swal.fire({
				title: "¿Estás seguro?",
				text: "Una vez marcado como pagado, no podrás deshacer esta acción.",
				icon: "warning",
				showCancelButton: true,
				buttons: true,
				dangerMode: true,
			})
			.then((willMarkPaid) => {
				if (willMarkPaid.isConfirmed) {
					// Si el usuario confirma, redirigir o realizar la acción de marcado como pagado
					window.location.href = button.data('url');
				}
			});
		return false;
	});
</script>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- Additional JS -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js"></script>