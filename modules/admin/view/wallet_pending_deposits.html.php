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



<section id="adminDeposits">
    <div class="container">
        <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Depósitos Pendientes</div>
        <?php if (!empty($pendingDeposits)): ?>
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Monto</th>
                        <th>N° Referencia</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendingDeposits['deposits'] as $deposit): ?>
                        <tr>
                            <td><?php echo $deposit['id']; ?></td>
                            <td><?php echo $deposit['username']; ?></td>
                            <td><?php echo $deposit['binance_email']; ?></td>
                            <td><?php echo $deposit['amount']; ?></td>
                            <td><?php echo $deposit['reference']; ?></td>
                            <td><?php echo date('Y-m-d H:i:s', $deposit['created_at']); ?></td>
                            <td><a href="<?php echo gLink('admin/wallet_deposit_details', array('deposit_id' => $deposit['id'])); ?>" class="btn"><i class="material-icons">visibility</i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Paginador -->
            <?php echo ($pendingDeposits['paginator']['paginator']) ?>
            <!-- FIN Paginador -->

        <?php else: ?>
            <p>No hay depósitos pendientes.</p>
        <?php endif; ?>
    </div>
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