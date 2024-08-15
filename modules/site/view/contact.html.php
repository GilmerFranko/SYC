<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 * @Description Vista de contacto
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
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600);

    body {
        font-family: 'Open Sans', sans-serif;
    }

    form {
        position: relative;
        margin: 20px auto;
        width: 300px;
    }

    h3 {
        font-size: 16px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.8)
    }
</style>
<section id="<?php echo $page['code']; ?>">
    <div class="row">
        <article class="col s12 m6 offset-m3">
            <blockquote class="flow-text">Utiliza este formulario para ponerte en contacto con el administrador del sitio. <strong>Nadie m&aacute;s leer&aacute; el mensaje.</strong></blockquote>
            <form id="sendform" method="POST" action="">
                <input type="hidden" name="member_id" value="<?php echo $session->memberData['member_id']; ?>">
                <input type="hidden" name="contact" value="">

                <?php if ($session->is_member == false)
                { ?>
                    <div class="input-field">
                        <i class="material-icons prefix">perm_identity</i>
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="<?php echo Core::model('extra', 'core')->getInputValue('name', 'post', $session->memberData['name']); ?>" required>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">email</i>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo Core::model('extra', 'core')->getInputValue('email', 'post', $session->memberData['email']); ?>" required>
                    </div>
                <?php } ?>
                <div class="input-field">
                    <i class="material-icons prefix">title</i>
                    <label for="title">T&iacute;tulo corto del mensaje</label>
                    <input type="text" name="title" id="title" value="<?php echo Core::model('extra', 'core')->getInputValue('title', 'post'); ?>" required>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">mode_edit</i>
                    <label for="content">Escribe aqu&iacute; tu Mensaje</label>
                    <textarea name="content" id="content" rows="10" class="materialize-textarea" length="1000" required><?php echo Core::model('extra', 'core')->getInputValue('content', 'post'); ?></textarea>
                </div>
                <div class="h-captcha" data-sitekey="ac48f6bb-17c3-4fcb-a43a-d1be043d20fb"></div>
                <br>
                <button class="btn" type="submit"><i class="material-icons right notranslate">send</i>Enviar</button>
            </form>
        </article>
    </div>
</section>
<script src="https://hcaptcha.com/1/api.js" async defer></script>
<!-- / Body -->
<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->