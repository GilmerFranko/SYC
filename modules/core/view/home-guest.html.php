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

	<div class="container">

		<div class="row" class="">
			<?php if ($contacts['rows'] > 0)
			{
				foreach ($contacts['data'] as $contact)
				{ ?>
					<div class="col-sm-6 col-md-6 col-lg-6" style="height: 10px 0">
						<div class="row" style="padding: 10px">
							<div class="" style="background: #f2e3f2; border-radius: 50px; display:flex;align-items: center;max-height: 65px; height: 55px;">

								<img src="<?php echo $config['contacts_url'] . '/' . $contact['image'] ?>" alt="Contactos hombres">
								<div class="categoria">

									<!-- Titulo Contacto -->
									<a href="<?= gLink('forums/view.searches', ['contact_id' => $contact['id']]) ?>" class=" cat1"><?= $contact['name'] ?></a>
									&nbsp;

									<!-- Ubicaciones -->
									<?php
									$locations = loadClass('forums/locations')->getLocationsByContactId($contact['id']);
									if ($locations['rows'] > 0)
									{
										$count = 0;
										foreach ($locations['data'] as $location): ?>
											<a class="ubicaciones-items" title="<?= $location['name'] ?>" href="<?= $config['forum_url'] . $location['short_url'] ?>" class="cat2">
												<nobr><?= $location['name'] ?></nobr>
											</a> &nbsp;
											<?php $count++;
											if ($count >= 5)
											{
											?>
												<a class="ubicaciones-items" title="más ubicaciones" href="<?= gLink('forums/view.searches', ['contact_id' => $contact['id']]) ?>" class="cat2">
													<nobr>más</nobr>
												</a>
									<?php
												break;
											}
										endforeach;
									} ?>

									<!-- /Ubicaciones -->
								</div>
							</div>
						</div>
					</div>
			<?php }
			} ?>
		</div>

	</div>

</section>

<!-- FOOTER -->
<?php require Core::view('footer', 'core'); ?>