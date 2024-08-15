<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la configuración del usuario
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<!-- Body -->
<style type="text/css">
</style>
<section id="memberAccount">
    <br>
    <div class="row">
        <form action="<?php echo Core::model('extra', 'core')->generateUrl('members', 'account', 'save'); ?>" method="post" enctype="multipart/form-data">
            <div class="card">

                <!--<div class="card-content">
                    <p>Aqu&iacute; puedes editar la informaci&oacute;n de tu perfil</p>
                </div>-->
                <div class="card-image avatar" style="display:flex;justify-content: center;">
                    <img class="responsive-img materialboxed" src="<?php echo $config['avatar_url'] . DS . Core::model('member', 'members')->getAvatar($m_id, false); ?>">
                    <span class="card-title notranslate"><?php echo $session->memberData['name']; ?></span>
                    <div class="file-field input-field btn-floating halfway-fab waves-effect waves-light red pulse" bis_skin_checked="1">
                        <i class="material-icons notranslate">add_a_photo</i>
                        <input name="avatar_pc" id="file1" type="file" accept="image/*" onchange="$('#btnSaveAccount').click();">
                    </div>
                </div>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a href="#tinfo">Informaci&oacute;n</a></li>
                        <li class="tab"><a href="#tpass" <?php echo $sSection == 'account.password' ? 'class="active"' : ''; ?>>Seguridad</a></li>
                    </ul>
                </div>
                <div class="card-content grey lighten-4">
                    <!-- Tab INFO -->

                    <div id="tinfo">
                        <?php include Core::view('account.profile.area'); ?>
                    </div>
                    <!-- TAB SEGURIDAD -->
                    <div id="tpass">
                        <?php include Core::view('account.security.area'); ?>
                    </div>
                    <!-- TAB PRIVACIDAD -->


                </div>


                <!-- BOTON DE PERFIL -->
                <div class="card-action center">
                    <button type="submit" class="waves-effect waves-light btn btn-small darken-2 w80" name="saveAccount" id="btnSaveAccount"><i class="large material-icons">save</i></button>
                </div>
                <!-- BOTON DE GUARDADO -->
                <div class="fixed-action-btn">
                    <button type="submit" class="btn-floating btn-large btn-primary darken-4" name="saveAccount" id="btnSaveAccount"><i class="large material-icons">save</i></button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- / Body -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/images.js" />
</script>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->