<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista para mostrar el estado del retiro
 *
 *
 */
?>
<!-- Incluimos el encabezado y menú -->
<?php require Core::view('head', 'core'); ?>
<?php require Core::view('menu', 'core'); ?>

<!-- Contenido de la página -->
<!-- Contenido de la página -->
<section id="viewWithdrawals">
    <div class="container">
        <h4>Estado de Retiros</h4>
        <?php if ($withdrawals['pages']['results'] > 0) : ?>
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>Retiro</th>
                        <th>Monto</th>
                        <th>Email de Binance</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($withdrawals['data'] as $withdrawal) : ?>
                        <tr>
                            <td><?php echo $withdrawal['id']; ?></td>
                            <td><?php echo $withdrawal['amount']; ?></td>
                            <td><?php echo $withdrawal['binance_email']; ?></td>
                            <td>
                                <span class="<?php echo $classStatusAr[$withdrawal['status']] ?>"><?php echo $statusAr[$withdrawal['status']] ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No hay retiros pendientes.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Incluimos el pie de página -->
<?php require Core::view('footer', 'core'); ?>