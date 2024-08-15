<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página que permite Sumar y Restar créditos a los usuarios
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

<br>
<section id="modAddRemoveCredits">
    <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Transacciones de <?php echo $member['name'] ?></div>
    <div style="display: flex;justify-content: center;">
        <div class="user-view" style="width: 200px;">
            <div class="col s4" bis_skin_checked="1">
                <a>
                    <img src="<?php echo $config['avatar_url'] . DS . $member['pp_thumb_photo'] ?>" width="100%" height="100%" alt="Tu avatar" class="circle responsive-img valign profile-image">
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Agregar Créditos</span>
                        <!-- Formulario para agregar créditos -->
                        <div class="input-field">
                            <input type="text" value="<?php echo $member['name']; ?>" readonly>
                            <label for="member_name">Nombre del Usuario</label>
                        </div>

                        <div class="input-field">
                            <input id="cantidad_agregar" type="number" name="cantidad_agregar" required>
                            <label for="cantidad_agregar">Cantidad a Agregar</label>
                        </div>
                        <div class="center-align">
                            <button class="btn waves-effect waves-light green" id="btn_add_credits" type="button">+</button>
                            <button class="btn waves-effect waves-light red" id="btn_remove_credits" type="button">-</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?php echo $member['name'] ?> Tiene <?php echo loadClass('members/transactions')->getBalance($member['member_id']) ?> USD</div>
    <?php if ($transactions): ?>
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
                        <td><?php echo $member['name']; ?></td>
                        <?php if ($transaction['transaction_type'] == '+')
                        { ?>
                            <td><span class="green-text">+<?php echo $transaction['amount']; ?></span></td>
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
<script>
    $(document).ready(function() {
        $('#btn_add_credits').click(function() {
            Swal.fire({
                title: '¿Estás seguro?',
                html: 'Esta acción agregará créditos al usuario <strong><?php echo $member['name'] ?></strong>.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, agregar créditos',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var member_id = <?php echo $member['member_id']; ?>;
                    var amount = $('#cantidad_agregar').val();
                    // Realizar la llamada AJAX para agregar créditos
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo gLink('admin/wallet_add_remove_credits') ?>',
                        data: {
                            ajax: true,
                            member_id: member_id,
                            amount: amount,
                            add_or_remove: 'add'
                        },
                        success: function(response) {
                            r = JSON.parse(response);
                            if (r.status) {
                                let timerInterval;
                                Swal.fire({
                                    title: r.msg,
                                    html: "",
                                    timer: 3000,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        const timer = Swal.getPopup().querySelector("b");
                                        timerInterval = setInterval(() => {
                                            timer.textContent = `${Swal.getTimerLeft()}`;
                                        }, 100);
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                swal.fire(r.msg, '', 'error')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

        $('#btn_remove_credits').click(function() {
            Swal.fire({
                title: '¿Estás seguro?',
                html: 'Esta acción quitará créditos al usuario <strong><?php echo $member['name'] ?></strong>.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, quitar créditos',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var member_id = <?php echo $member['member_id']; ?>;
                    var amount = $('#cantidad_agregar').val();
                    // Realizar la llamada AJAX para agregar créditos
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo gLink('admin/wallet_add_remove_credits') ?>',
                        data: {
                            ajax: true,
                            member_id: member_id,
                            amount: amount,
                            add_or_remove: 'remove'
                        },
                        success: function(response) {
                            r = JSON.parse(response);
                            if (r.status) {
                                let timerInterval;
                                Swal.fire({
                                    title: r.msg,
                                    html: "",
                                    timer: 3000,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        const timer = Swal.getPopup().querySelector("b");
                                        timerInterval = setInterval(() => {
                                            timer.textContent = `${Swal.getTimerLeft()}`;
                                        }, 100);
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                swal.fire(r.msg, '', 'error')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>


<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- Additional JS -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js"></script>