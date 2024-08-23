<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que incluye parte de la cabecera
 */

?>
<!DOCTYPE HTML>

<html lang="es" style="overflow-x: hidden">

<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168682834-1"></script>-->




	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-168682834-1');
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!--jQuery -->
	<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/jquery-3.3.1.min.js"></script>

	<!-- Si esa es el modulo admin, se inyecta el JS de materialize si no se utiliza bootstrap-->
	<script src="<?php echo $config['base_url'] . '/static/js/' . ($sModule == 'admin' ? 'materialize.min.js' : 'bootstrap.min.js'); ?>"></script>

	<!-- Import Toastify.js -->
	<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/toastify.js" />

	<!-- Custom JS -->
	<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/custom.js" />
	</script>
	<!-- SweetAlert -->
	<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/sweetalert.min.js" />
	</script>
	<title><?php echo isset($page['name']) ? $page['name'] : ucfirst($sModule) . ' - ' . $config['script_name']; ?></title>

	<!--Import Google Icon Font-->

	<link href="<?php echo $config['base_url'] ?>/static/css/materialize-icons.css" rel="stylesheet">

	<!--Import materialize.css or bootstrap-->
	<link rel="stylesheet" href="<?php echo $config['base_url'] . '/static/css/' . ($sModule == 'admin' ? 'materialize.min.css' : 'bootstrap.min.css'); ?>">

	<!-- Import toastify.css -->
	<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/toastify.css" />

	<!-- Importa estilos generales -->
	<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/custom.css?r=<?php echo time(); ?>" />
	<!-- Importa estilos solo para modulo admin -->
	<?php if ($sModule == 'admin')
	{ ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/admin.css?r=<?php echo time(); ?>" />
	<?php
		// Importa estilo cuando no es modulo admin 
	}
	else
	{
	?>
		<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/custom2.css?r=<?php echo time(); ?>" />
	<?php
	}
	?>

	<!--<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/sweetalert_dark.css" />-->


	<!--Import night.css-->

	<!--<link type="text/css" rel="stylesheet" href="<?php echo $config['base_url']; ?>/static/css/night.css?<?php echo time() ?>" />-->

	<!--Sitio optimizado para moviles-->

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Favicon -->

	<link rel="shortcut icon" href="<?php echo $config['images_url']; ?>/favicon.png">

	<script>
		var global = {

			url: '<?php echo $config['base_url']; ?>',

			page: '<?php echo $page['name']; ?>',

			page_c: '<?php echo isset($page['code']) ? $page['code'] : $sSection; ?>',

			page_n: '<?php echo $page['number']; ?>',

			images: '<?php echo $config['images_url']; ?>'

		};

		var member = {

			id: '<?php echo $session->memberData['member_id']; ?>',

			name: '<?php echo $session->memberData['name']; ?>',

			group: '<?php echo $session->memberData['group_id']; ?>',

			platform: '<?php echo $session->platform; ?>',

		};
	</script>

	<?php if ($session->platform == 'android' || $session->platform == 'app')
	{ ?>

		<style>
			nav a.left,

			nav a.right {

				width: 16.6666666667%;

			}
		</style>

	<?php } ?>

</head>

<body>

	<!-- mostrar preloader solo si no se esta en modo debug -->
	<?php //if($config['debug_mode'] == 0) { 
	?>
	<!--<div class="preloader-background">

			<div class="preloader-wrapper big active">

				<div class="spinner-layer spinner-blue-only">

					<div class="circle-clipper left">

						<div class="circle"></div>

					</div>

					<div class="gap-patch">

						<div class="circle"></div>

					</div>

					<div class="circle-clipper right">

						<div class="circle"></div>

					</div>

				</div>

			</div>

		</div>-->
	<?php //} 
	?>

	<?php
	if ($session->is_member and $sModule == 'admin')
	{
		require Core::view('sidenav', 'core');
	}
	?>