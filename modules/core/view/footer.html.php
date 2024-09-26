<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que incluye el pie de página
 *
 *
 */

if ($session->is_member == true)
{
	require Core::view('wallet.modal', 'wallet');
}

if ($config['debug_mode'] == 1): ?>
	<span id="performance-data" class="grey-text text-lighten-4 right" style="position: fixed;right: 0;    bottom: 80px; background: rgba(0, 0, 0, 0.5); padding: 5px 5px 0 5px;">
		<?php Core::model('debug', 'core')->show($config['debug_mode']); ?>
		<br>
		<?php if (isset($_SESSION['models_used'])): ?>
			<?php foreach ($_SESSION['models_used'] as $key => $value): ?>
				<?php echo $value ?><br>
			<?php endforeach ?>
		<?php endif ?>
		<?php unset($_SESSION['models_used']); ?>
		<?php debugHTML() ?>
	</span>

<?php endif; ?>

<?php

?>

<?php // No mostrar en admin
if ($sModule != 'admin'): ?>
	<footer class="page-footer center" style="margin-bottom: 30px; padding: 5px 0">
		<div class="footer-copyright">
			<div class="row center-align">
				<div class="container">
					<div class="row">
						<div class="col col-sm-12">
							<a href="">CONDICIONES DE USO, PRIVACIDAD Y COOKIES</a> -
							<a href="">CONTACTAR</a> -
							<a href="">AGREGAR A FAVORITOS</a>
						</div>
						<div class="col col-sm-12" style="color: gray">
							&copy; <?php echo date('Y') . PHP_EOL . $config['script_name']; ?>
						</div>
						<?php /*<div class="col s12 m6">
				<!-- ESPAÑOL -->
				<a href="#" onclick="doGTranslate('es|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;">
					<img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Spanish" />
				</a>
				<!-- INGLÉS -->
				<a href="#" onclick="doGTranslate('es|en');return false;" title="English" class="gflag " style="background-size: 0px;">
					<img src="<?php echo $config['images_url'] . '/eeuu.png' ?>" height="20" width="24" alt="English" />
				</a>
				<!-- ITALIANO -->
				<a href="#" onclick="doGTranslate('en|it');return false;" title="Italian" class="gflag nturl" style="background-position:-600px -100px;">
					<img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Italian" />
				</a>
				<!-- PORTUGUÉS -->
				<a href="#" onclick="doGTranslate('es|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;">
					<img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Portuguese" />
				</a>
				<!-- FRANCÉS -->
				<a href="#" onclick="doGTranslate('en|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;">
					<img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="French" />
				</a>
			</div>
			*/ ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
<?php endif ?>

<?php if ($config['debug_mode'] == 0 and $sSection === 'view_messages'): ?>
	<div id="google_translate_element2"></div>
	<script type="text/javascript">
		function googleTranslateElementInit2() {
			new google.translate.TranslateElement({
				pageLanguage: 'es',
				autoDisplay: true
			}, 'google_translate_element2');
		}
	</script>
	<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
	<!-- Translate -->
	<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/translate.js"></script>
<?php endif ?>
</body>

</html>
<?php

?>