<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de Detalles de Retiros
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

<section id="modWithdrawalDetails">
    <br>
    <?php if ($withdrawal): ?>

        <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Detalles de retiro</div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Información del Retiro</span>
                        <p><strong>ID:</strong> <?php echo $withdrawal['id']; ?></p>
                        <p><strong>Usuario:</strong> <?php echo $withdrawal['username']; ?></p>
                        <p><strong>Monto:</strong> <?php echo $withdrawal['amount']; ?>$</p>
                        <p><strong>Email Binance:</strong> <?php echo $withdrawal['binance_email']; ?></p>
                        <p><strong>ID Binance:</strong> <?php echo $withdrawal['binance_id']; ?></p>
                        <p><strong>Nombre Completo:</strong> <?php echo $withdrawal['binance_fullname']; ?></p>
                        <p><strong>Fecha de Creación:</strong> <?php echo date('Y-m-d H:i:s', $withdrawal['created_at']); ?></p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Estado del Retiro</span>
                        <form action="<?php echo gLink('admin/wallet_withdrawal_details', array('setStatus' => true, 'withdrawal_id' => $withdrawal['id'])); ?>" method="POST">
                            <p>
                                <label>
                                    <input name="status" type="radio" value="0" <?php echo $withdrawal['status'] == '0' ? 'checked' : ''; ?> />
                                    <span>Pendiente</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="status" type="radio" value="1" <?php echo $withdrawal['status'] == '1' ? 'checked' : ''; ?> />
                                    <span>Completado</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="status" type="radio" value="2" <?php echo $withdrawal['status'] == '2' ? 'checked' : ''; ?> />
                                    <span>Cancelado</span>
                                </label>
                            </p>
                            <button class="btn waves-effect waves-light" type="submit">Guardar</button>
                        </form>
                        <h5><a href="<?php echo gLink('admin/wallet_add_remove_credits', ['member_id' => $withdrawal['member_id']]) ?>"> Actualizar saldo</a></h5>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="center">
            <p>No se encontraron detalles para este retiro.</p>
        </div>
    <?php endif ?>
</section>

<!-- Include footer -->
<?php require Core::view('footer', 'core'); ?>

<!-- Additional JS -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js"></script>