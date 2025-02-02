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

		<?php if ($forums['rows'] > 0)
		{
			foreach ($forums['data'] as $contact)
			{ ?>
				<div class="forum-item card mb-4 shadow-sm">
					<div class="card-body">
						<div class=" d-flex justify-content-between align-items-center mb-3">
							<h2 class="h5 mb-0">
								<i class="bi bi-code-slash category-icon"></i>
								<!-- Titulo Foro -->
								<a href="<?= gLink('forums/view.searches', ['forum_id' => $contact['id']]) ?>" class=" cat1"><?= $contact['name'] ?></a>
								&nbsp;
							</h2>
							<a href="<?= gLink('forums/view.searches', ['forum_id' => $contact['id']]) ?>" class="see-all">Ver todo <i class="bi bi-chevron-right"></i></a>
						</div>
						<div>
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
		<?php }
		} ?>

	</div>

</section>


<style>
	.forum-item {
		border: none;
		border-left: solid 4px var(--primary-300);
	}

	.forum-item a {
		color: var(--primary-dark) !important;
		font-weight: 600;
	}

	.subforos-items {
		background-color: var(--primary-light);
		color: #2c3e50;
		padding: 4px 12px;
		border-radius: 20px;
		display: inline-block;
		margin: 4px;
		font-size: 14px;

		&:hover {
			background-color: var(--primary-200);
		}
	}
</style>

<!-- FOOTER -->
<?php require Core::view('footer', 'core'); ?>