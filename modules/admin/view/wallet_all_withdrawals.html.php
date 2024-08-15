<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de Retiros Pendientes
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

<section id="adminDeposits">
    <div class="container">
        <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Todos los retiros</div>
        <?php if (!empty($withdrawals)): ?>
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($withdrawals['data'] as $withdrawal): ?>
                        <tr>
                            <td><?php echo $withdrawal['id']; ?></td>
                            <td><?php echo $withdrawal['username']; ?></td>
                            <td><?php echo $withdrawal['binance_email']; ?></td>
                            <td><?php echo $withdrawal['amount']; ?></td>
                            <td><?php echo date('Y-m-d H:i:s', $withdrawal['created_at']); ?></td>
                            <td><?php echo $statusAr[$withdrawal['status']] ?></td>
                            <td><a href="<?php echo gLink('admin/wallet_withdrawal_details', array('withdrawal_id' => $withdrawal['id'])); ?>" class="btn"><i class="material-icons">visibility</i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Paginador -->
            <?php echo ($withdrawals['paginator']['paginator']) ?>
            <!-- FIN Paginador -->

        <?php else: ?>
            <p>No hay depósitos pendientes.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- Additional JS -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js"></script>