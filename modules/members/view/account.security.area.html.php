<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista del área "Contraseña" de la sección "Contraseña" en la cuenta
 *
 *
 */
?>

<article id="memberAccountSecurity">
    <div class="content">
        <div class="row">
            <div class="row">
                <div class="input-field col s12">
                    <input name="email" id="email" type="email" class="validate" value="<?php echo $session->memberData['email']; ?>" disabled>
                    <label for="email">Tu Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input name="currentPassword" id="currentPassword" type="password" class="validate" autocomplete="new-password">
                    <label for="currentPassword">Contrase&ntilde;a actual</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="newPassword" id="newPassword" type="password" class="validate">
                    <label for="newPassword">Nueva contrase&ntilde;a</label>
                </div>
                <div class="input-field col s6">
                    <input name="confirmPassword" id=confirmPassword type="password" class="validate">
                    <label for="confirmPassword">Confirme contrase&ntilde;a</label>
                </div>
            </div>
            <!--<div class="row">
                <p class="flow-text red-text" id="msgDelete"></p>
                <a class="waves-effect waves-light btn red darken-4 w100" href="javascript:deleteAccount();" id="deleteAccount">Eliminar Cuenta</a>
            </div>-->
        </div>
    </div>
</article>

<script>
    var token = '<?php echo $session->token; ?>';
</script>