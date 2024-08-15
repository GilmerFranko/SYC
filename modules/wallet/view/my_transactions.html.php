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
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section id="userTransactions">
    <br>
    <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Mis Transacciónes</div>
    <?php if ($transactions['pages']['results'] > 0): ?>

        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Monto</th>
                    <th>Razón</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions['transactions'] as $transaction): ?>
                    <tr>
                        <td><a href="<?php echo gLink('admin/wallet_add_remove_credits', ['member_id' => $session->memberData['member_id']]) ?>"><?php echo $session->memberData['name']; ?></td>
                        <?php if ($transaction['transaction_type'] == '+')
                        { ?>
                            <td><span class="white-text">+<?php echo $transaction['amount']; ?></span></td>
                        <?php }
                        else
                        { ?>
                            <td><span class="red-text">-<?php echo $transaction['amount']; ?></span></td>
                        <?php } ?>
                        <td><?php echo $reasonAr[$transaction['reason']]; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', ($transaction['timestamp'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Paginador -->
        <?php echo $transactions['pages']['paginator']; ?>
        <!-- FIN Paginador -->
    <?php else: ?>
        <div class="center">
            <p>No hay transacciones disponibles.</p>
        </div>
    <?php endif; ?>
</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>