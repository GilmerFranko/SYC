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
<!-- / Header -->
<!-- CSS ADICIONAL -->
<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/wallet.css" />
<!-- Body -->
<section>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <a href="<?php echo gLink('wallet/my_transactions') ?>">
          <div class="card">
            <div class="card-content card-wallet white-text">
              <div class="wallet-icon">
                <i class="material-icons large">account_balance</i>
              </div>
              <div class="wallet-data">
                <h5><strong>BANCO</strong></h5>
                <h7>Saldo</h7>
                <h6>$150.00 USDT</h6>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col s12">
        <a href="<?php echo gLink('wallet/create_deposit') ?>">
          <div class="card">
            <div class="card-content card-wallet white-text">
              <div class="wallet-icon">
                <i class="material-icons large">wallet</i>
              </div>
              <div class="wallet-data">
                <h5><strong>DEPOSITAR</strong></h5>
                <h7>Monto min. $10 USDT</h7>
                <h6>$150.00 USDT</h6>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col s12">
        <a href="<?php echo gLink('wallet/create_withdrawal') ?>">
          <div class="card">
            <div class="card-content card-wallet white-text">
              <div class="wallet-icon">
                <i class="material-icons large">local_atm</i>
              </div>
              <div class="wallet-data">
                <h5><strong>RETIRAR</strong></h5>
                <h7>Monto min. $25 USDT</h7>
                <h6>$150.00 USDT</h6>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>