<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de usuarios
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- CARGA EDITOR DE USUARIO -->
<section>
    <?php require Core::view('transactions.area', 'admin') ?>
</section>
<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>