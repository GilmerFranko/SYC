<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de Recargar Créditos
 *
 *
 */

require Core::view('head', 'core');

// Opciones de recarga de créditos
$recargas = [
  1 => ['creditos' => 10, 'precio' => 10],
  2 => ['creditos' => 20, 'precio' => 20],
  3 => ['creditos' => 30, 'precio' => 30],
  4 => ['creditos' => 40, 'precio' => 40],
  5 => ['creditos' => 50, 'precio' => 50],
];

// Configuración PayPal Sandbox
$SandBox = true;
$Paypal_IDClient = $SandBox ? "AZuS-tADF3ZPi4QpXiTXlLIMm5tq8U2JkDrrTf8eUaM4jrnMcj7VQ4Fg8-t3RJzJvgMM1bZGl3MeQeDr" : "Adqlpy5FFy9G-ClEOckkhUMfgtiQT3qS7qVWK3JIjI2z3klpsfmHsnBSYpdfiML9eo7P9n3zi9cWXi6m";

?>

<style>
  .recarga-container {

    text-align: center;
  }

  .recarga-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #343a40;
  }

  .recarga-cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
  }

  .recarga-card {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    width: 250px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
  }

  .recarga-card:hover {
    transform: translateY(-5px);
  }

  .recarga-card h4 {
    font-size: 20px;
    color: var(--primary-300);
  }

  .recarga-card p {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 20px;
  }

  .paypal-button-container {
    text-align: center;
    margin-top: 10px;
  }

  .info-text {
    font-size: 12px;
    color: #495057;
    margin-top: 30px;
    text-align: center;
  }
</style>

<section class="recarga-container">
  <!-- Header -->
  <?php require Core::view('menu', 'core'); ?>
  <!-- / Header -->
  <br>
  <!-- Título -->
  <h1 class="recarga-title">Recargar Créditos</h1>
  <!-- Texto informativo -->
  <p class="info-text">Selecciona el monto de créditos que deseas comprar y completa la transacción con PayPal.</p>

  <i>Si tienes algún problema con el pago, no dudes en <a href="<?php echo gLink('site', 'contact'); ?>">comunicarte con nosotros</a> y estaremos encantados de ayudarte.</i>
  <br><br>

  <!-- Tarjetas de recarga -->
  <div class="recarga-cards">
    <?php foreach ($recargas as $id => $recarga): ?>
      <div class="recarga-card">
        <h4><?php echo $recarga['creditos']; ?> €</h4>
        <p>Precio: <?php echo $recarga['precio']; ?> €</p>
        <div class="paypal-button-container" id="paypal-button-container-<?php echo $id; ?>"></div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Texto informativo -->
  <p class="info-text">Selecciona el monto de créditos que deseas comprar y completa la transacción con PayPal.</p>
</section>

<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $Paypal_IDClient ?>&enable-funding=venmo&disable-funding=paylater&currency=USD" data-sdk-integration-source="button-factory"></script>

<script type="text/javascript">
  <?php foreach ($recargas as $id => $recarga): ?>
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'black',
        layout: 'vertical',
        label: 'paypal',
        size: 'small'
      },
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            description: "<?php echo $recarga['creditos']; ?> Créditos",
            amount: {
              value: "<?php echo $recarga['precio']; ?>"
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          $.ajax({
            url: "<?php echo gLink('members/rechargue.wallet'); ?>",
            type: "POST",
            data: {
              orderID: data.orderID,
              creditos: <?php echo $recarga['creditos']; ?>,
              precio: <?php echo $recarga['precio']; ?>,
              email: details.payer.email_address,
              nombre: details.payer.name.given_name,
              ajax: true,
              token: "<?php echo $session->token; ?>"
            },
            dataType: "json",
            success: function(response) {
              console.log(response)
              if (response.status === true) {
                Toastify({
                  text: "Pago confirmado y créditos agregados.",
                  duration: 3000,
                  gravity: "top",
                  position: "right",
                  backgroundColor: "#00b894",
                  stopOnFocus: true
                }).showToast();
              } else {
                Toastify({
                  text: "Error en la validación del pago.",
                  duration: 3000,
                  gravity: "top",
                  position: "right",
                  backgroundColor: "#e74c3c",
                  stopOnFocus: true
                }).showToast();
              }
            }
          });
        });
      }
    }).render('#paypal-button-container-<?php echo $id; ?>');
  <?php endforeach; ?>
</script>

<!-- FOOTER -->
<?php require Core::view('footer', 'core'); ?>