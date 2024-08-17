<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los creditos
 *
 *
 */
// HEADER
require Core::view('head', 'core');
// MENU
require Core::view('menu', 'core');
?>


<section class="first-section content" id="main">
	<?php require Core::view('submenu', 'core'); ?>

	<div class="container">

		<div class="row" class="">
			<?php for ($i = 0; $i < 12; $i++)
			{ ?>
				<div class="col-sm-12 col-md-6 col-lg-6" style="height: 10px 0">
					<div class="row" style="padding: 10px">
						<div class="" style="background: #f2e3f2; border-radius: 50px; display:flex;align-items: center;max-height: 65px;">
							<img src="https://web.archive.org/web/20171208204132im_/http://109.70.128.123/imagenes/pasion/i/contactos-hombres-i.gif" alt="Contactos hombres" width="70">
							<div class="categoria">
								<a title="Contactos hombres" href="/web/20171221060812/http://www.pasion.com/contactos-hombres/" class="cat1">Contactos hombres</a> &nbsp; <a title="Contactos hombres en madrid" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-madrid/" class="cat2">
									<nobr>Madrid</nobr>
								</a> &nbsp; <a title="Contactos hombres en barcelona" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-barcelona/" class="cat2">
									<nobr>Barcelona</nobr>
								</a> &nbsp; <a title="Contactos hombres en valencia" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-valencia/" class="cat2">
									<nobr>Valencia</nobr>
								</a> &nbsp; <a title="Contactos hombres en malaga" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-malaga/" class="cat2">
									<nobr>Málaga</nobr>
								</a> &nbsp; <a title="Contactos hombres en alicante" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-alicante/" class="cat2">
									<nobr>Alicante</nobr>
								</a> &nbsp; <a title="Contactos hombres en sevilla" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-sevilla/" class="cat2">
									<nobr>Sevilla</nobr>
								</a> &nbsp; <a title="Contactos hombres en las_palmas" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-las_palmas/" class="cat2">
									<nobr>Las Palmas</nobr>
								</a> &nbsp; <a title="Contactos hombres en murcia" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-murcia/" class="cat2">
									<nobr>Murcia</nobr>
								</a> &nbsp; <a title="Contactos hombres en cadiz" href="/web/20171221060812/http://www.pasion.com/contactos-hombres-en-cadiz/" class="cat2">
									<nobr>Cádiz</nobr>
								</a> &nbsp; <a title="Contactos hombres" href="/web/20171221060812/http://www.pasion.com/contactos-hombres/" class="cat2">[más...]</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

	</div>

</section>

<!-- FOOTER -->