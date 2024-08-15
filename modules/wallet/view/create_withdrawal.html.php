<?php defined('SYC') || exit; ?>

<!-- Include header -->
<?php require Core::view('head', 'core'); ?>

<!-- Include menu -->
<?php require Core::view('menu', 'core'); ?>

<!-- CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/withdrawal_form.css" />

<!-- Withdrawal Form -->
<section id="withdrawalForm">
    <div class="card-panel green lighten-4 green-text text-darken-4 flow-text">
        <p><strong>Instrucciones de Retiro:</strong></p>
        <p>1. Retira fondos de tu cuenta de Binance. Asegúrate de que el monto esté entre $25 y $150 USD.</p>
        <p>2. Ingresa el ID del usuario o el nombre completo de Binance en el campo correspondiente. Si tienes un ID de Binance, también puedes ingresarlo, aunque es opcional.</p>
        <p>3. Proporciona tu correo electrónico de Binance en el campo indicado. Este correo será utilizado para fines de contacto y confirmación.</p>
        <p>4. Antes de enviar los datos, asegúrate de verificar correctamente la información ingresada.</p>
        <p>5. Una vez que estés seguro de los datos ingresados, presiona el botón "Generar Retiro" para enviar la solicitud.</p>
        <p>6. Después de enviar la solicitud, el proceso de verificación y procesamiento del retiro puede tardar de 1 a 2 horas. ¡Gracias por tu paciencia!</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Solicitud de Retiro</span>
                        <!-- Withdrawal Form -->
                        <form method="POST">
                            <input type="hidden" name="app" value="wallet">
                            <input type="hidden" name="section" value="create_withdrawal">
                            <input type="hidden" name="newWithdrawal" value="true">
                            <div class="input-field">
                                <input type="text" id="binance_fullname" name="binance_fullname" type="text" required>
                                <label for="binance_fullname">Usuario Binance</label>
                            </div>
                            <div class="input-field">
                                <input id="binance_email" type="email" name="binance_email" required>
                                <label for="binance_email">Email de Binance</label>
                            </div>
                            <div class="input-field">
                                <input id="amount" type="number" name="amount" required>
                                <label for="amount">Monto a Retirar</label>
                            </div>
                            <button class="btn waves-effect waves-light green" type="submit">Solicitar Retiro</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include footer -->
<?php require Core::view('footer', 'core'); ?>

<!-- Additional JS -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/withdrawal_form.js"></script>