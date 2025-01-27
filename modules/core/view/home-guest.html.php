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
			<?php if ($forums['rows'] > 0)
			{
				foreach ($forums['data'] as $contact)
				{ ?>
					<div class="col-sm-6 col-md-6 col-lg-6" style="height: 10px 0">
						<div class="row" style="padding: 10px">
							<div class="" style="background: var(--primary); border-radius: 4px; display:flex;align-items: center;max-height: 65px; height: 55px;">

								<div class="categoria">

									<!-- Titulo Foro -->
									<a href="<?= gLink('forums/view.searches', ['forum_id' => $contact['id']]) ?>" class=" cat1"><?= $contact['name'] ?></a>
									&nbsp;

									<!-- Subforos -->
									<?php
									$subforums = loadClass('forums/subforums')->getSubforumsByForumId($contact['id']);
									if ($subforums['rows'] > 0)
									{
										$count = 0;
										foreach ($subforums['data'] as $subforum): ?>
											<a class="subforos-items" title="<?= $subforum['name'] ?>" href="<?= $config['forum_url'] . $subforum['short_url'] ?>" class="cat2">
												<nobr><?= $subforum['name'] ?></nobr>
											</a> &nbsp;
											<?php $count++;
											if ($count >= 5)
											{
											?>
												<a class="subforos-items" title="más subforos" href="<?= gLink('forums/view.searches', ['forum_id' => $contact['id']]) ?>" class="cat2">
													<nobr>más</nobr>
												</a>
									<?php
												break;
											}
										endforeach;
									} ?>

									<!-- /Subforos -->
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