<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista para mostrar el estado del depósito
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

<style type="text/css">
    .s-pending {
        color: var(--primary);
    }

    .s-completed {
        color: var(--green);
    }

    .s-canceled {
        color: var(--red);
    }
</style>
<section>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Estado del Depósito</span>
                    <ul class="collection with-header">
                        <li class="collection-item"><strong>Cantidad:</strong> $<?php echo $deposit['amount']; ?></li>
                        <li class="collection-item"><strong>Número de Referencia:</strong> <?php echo $deposit['reference']; ?></li>
                        <li class="collection-item"><strong>Nombre Completo:</strong> <?php echo $deposit['binance_fullname']; ?></li>
                        <li class="collection-item"><strong>ID de Binance:</strong> <?php echo $deposit['binance_id']; ?></li>
                        <li class="collection-item"><strong>Correo Electrónico:</strong> <?php echo $deposit['binance_email']; ?></li>
                        <li class="collection-item"><strong>Fecha:</strong> <?php echo date('Y-m-d H:i:s', $deposit['created_at']); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="center-align">
        <h4>
            <span>Estado:</span>
            <strong class="<?php echo $classStatus ?>"><?php echo ucfirst($statusAr[$deposit['status']]); ?></strong>
        </h4>
</section>

<?php require Core::view('footer', 'core'); ?>