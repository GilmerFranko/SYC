<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de usuarios
 *
 */

require Core::view('head', 'core');
?>


<section id="userTransactions" class="">
    <!-- Header -->
    <?php require Core::view('menu', 'core'); ?>
    <!-- / Header -->

    <div class="alert alert-success text-center fw-bold">Mis Transacciones</div>

    <!-- Botón de Recargar -->
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo gLink('members/rechargue.wallet') ?>" class="btn btn-primary">
            <i class="bi bi-arrow-clockwise"></i> Recargar créditos
        </a>
    </div>

    <!-- Tabla de Transacciones -->
    <?php if ($transactions['pages']['results'] > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Razón</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions['transactions'] as $transaction): ?>
                        <tr>
                            <td>
                                <a href="<?php echo gLink('admin/wallet_add_remove_credits', ['member_id' => $session->memberData['member_id']]) ?>">
                                    <?php echo $session->memberData['name']; ?>
                                </a>
                            </td>
                            <td>
                                <?php if ($transaction['transaction_type'] == '+'): ?>
                                    <span class="badge bg-success">+<?php echo $transaction['amount']; ?></span>
                                <?php else: ?>
                                    <span class="badge bg-danger">-<?php echo $transaction['amount']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $reasonAr[$transaction['reason']]; ?></td>
                            <td><?php echo date('Y-m-d H:i:s', ($transaction['timestamp'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginador -->
        <?php echo $transactions['pages']['paginator']; ?>

    <?php else: ?>
        <div class="text-center my-4">
            <p>No hay transacciones disponibles.</p>
        </div>
    <?php endif; ?>
</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->