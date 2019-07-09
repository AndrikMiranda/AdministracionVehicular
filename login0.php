<?php

session_start();

if (isset($_SESSION['user_id'])) {
	header('Location: /uberdost');
}

require 'funcs/database0.php';

if (!empty($_POST['nombreUsuario']) && !empty($_POST['contrasena'])) {
	$usu = mysqli_real_escape_string($mysqli,$_POST['nombreUsuario']);
	$pass = mysqli_real_escape_string($mysqli,$_POST['contrasena']);
	$message = '';
	$shal1_pass = sha1($pass);

	$sql = "SELECT idUsuario, nombreUsuario, contrasena FROM usuarios WHERE nombreUsuario = '$usu' AND contrasena = '$shal1_pass'";
	$result = $mysqli->query($sql);
	$rows = $result->num_rows;

	if ($rows > 0) {
		$row = $result->FETCH_ASSOC();
		$_SESSION['user_id'] = $row['idUsuario'];
		$_SESSION['tipoUsuario'] = $row['tipo'];
		header("Location: /uberdost");
}	else {
		$message = $pass;
	}
}

 ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>UberDostHP &mdash; AdministraciónUberDostHP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="AdministraciónUberDostHP" />
	<meta name="keywords" content="AdministraciónUberDostHP" />
	<meta name="author" content="AJMT" />


  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="icon" href="images/car.ico">

	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="css/simple-line-icons.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!--
	Default Theme Style
	You can change the style.css (default color purple) to one of these styles

	1. pink.css
	2. blue.css
	3. turquoise.css
	4. orange.css
	5. lightblue.css
	6. brown.css
	7. green.css

	-->
	<link rel="stylesheet" href="css/style.css">

	<!-- Styleswitcher ( This style is for demo purposes only, you may delete this anytime. ) -->
	<link rel="stylesheet" id="theme-switch" href="css/style.css">
	<!-- End demo purposes only -->


	<style>
	/* For demo purpose only */

	/* For Demo Purposes Only ( You can delete this anytime :-) */
	#colour-variations {
		padding: 10px;
		-webkit-transition: 0.5s;
	  	-o-transition: 0.5s;
	  	transition: 0.5s;
		width: 140px;
		position: fixed;
		left: 0;
		top: 100px;
		z-index: 999999;
		background: #fff;
		/*border-radius: 4px;*/
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	#colour-variations.sleep {
		margin-left: -140px;
	}
	#colour-variations h3 {
		text-align: center;;
		font-size: 11px;
		letter-spacing: 2px;
		text-transform: uppercase;
		color: #777;
		margin: 0 0 10px 0;
		padding: 0;;
	}
	#colour-variations ul,
	#colour-variations ul li {
		padding: 0;
		margin: 0;
	}
	#colour-variations li {
		list-style: none;
		display: block;
		margin-bottom: 5px!important;
		float: left;
		width: 100%;
	}
	#colour-variations li a {
		width: 100%;
		position: relative;
		display: block;
		overflow: hidden;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		-ms-border-radius: 4px;
		border-radius: 4px;
		-webkit-transition: 0.4s;
		-o-transition: 0.4s;
		transition: 0.4s;
	}
	#colour-variations li a:hover {
	  	opacity: .9;
	}
	#colour-variations li a > span {
		width: 33.33%;
		height: 20px;
		float: left;
		display: -moz-inline-stack;
		display: inline-block;
		zoom: 1;
		*display: inline;
	}


	.option-toggle {
		position: absolute;
		right: 0;
		top: 0;
		margin-top: 5px;
		margin-right: -30px;
		width: 30px;
		height: 30px;
		background: #f64662;
		text-align: center;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		color: #fff;
		cursor: pointer;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	.option-toggle i {
		top: 2px;
		position: relative;
	}
	.option-toggle:hover, .option-toggle:focus, .option-toggle:active {
		color:  #fff;
		text-decoration: none;
		outline: none;
	}
	</style>
	<!-- End demo purposes only -->


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<header role="banner" id="fh5co-header">
			<div class="container">
				<!-- <div class="row"> -->
			    <nav class="navbar navbar-default">
		        <div class="navbar-header">
		        	<!-- Mobile Toggle Menu Button -->
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
		         <a class="navbar-brand" href="index.html">UberDostHP</a>
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		          <ul class="nav navbar-nav navbar-right">
		            <li class="active"><a href="#" data-nav-section="Inicio"><span>Inicio</span></a></li>
								<li><a href="#" data-nav-section="contact"><span>Iniciar sesión</span></a></li>
								<li><a href="#" data-nav-section="Contacto con administrador"><span>Contacto con administrador</span></a></li>
		          </ul>
		        </div>
			    </nav>
			  <!-- </div> -->
		  </div>
	</header>

	<section id="fh5co-home" data-section="Inicio" style="background-image: url(images/uberdostfondo.jpg);" data-stellar-background-ratio="0.5">
		<div class="gradient"></div>
		<div class="container">
			<div class="text-wrap">
				<div class="text-inner">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h1 class="to-animate">UberDostHP.</h1>
							<h2 class="to-animate">Andministración de UberDost.</h2>
							<h2 class="to-animate"><a href="http://creativecommons.org/licenses/by/3.0/" target="_blank"></a></h2>

							<?php if (!empty($message)) : ?>
								<p><?= $message ?></p>
						 <?php endif;?>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="slant"></div>
	</section>


	<section id="fh5co-contact" data-section="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
					<h2 class="to-animate">Iniciar sesión</h2>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 subtext to-animate">
							<h3>Iniciar sesión con tu respectivo usuario y contraseña </h3>

											<div class="col-md-3 to-animate"></div>

										<div class="row row-bottom-padded-md">

											<form action="<?php $_SERVER['PHP_SELF']; ?>" class="col-md-6 to-animate"  action="" method="post">
												<div class="form-group">
													<label for="nombreUsuario" class="sr-onlyy">Usuario</label>
													<h1> </h1>
													<input name="nombreUsuario" id="nombreUsuario" class="form-control" placeholder="&#128100;   Usuario" type="text" required autofocus>
												</div>
												<h1> </h1>
												<div class="form-group">
													<label for="contrasena" class="sr-onlyy">Contraseña</label>
													<h1> </h1>
													<input name="contrasena" id="contrasena" class="form-control" placeholder="&#x1F512;   Contraseña" type="password" required autofocus>
												</div>
												<div class="form-group ">
													<input class="btn btn-primary btn-lg" value="Entrar" type="submit">
												</div>
												<a href="">¿Olvidaste tu contraseña?</a>
											</form>
											</div>

						</div>
					</div>
				</div>
			</div>

			</div>
		</div>
 </section>


 <section id="fh5co-work" data-section="Contacto con administrador" style="background-image: url(images/uberdostfondo.jpg);" data-stellar-background-ratio="0.5">
	 <div class="container">
		 <div class="row">
			 <div class="col-md-12 section-heading text-center">
				 <h2 class="to-animate">Contacto con administrador</h2>
				 <div class="row">
					 <div class="col-md-8 col-md-offset-2 subtext to-animate">
						 <h3>Si cuenta con alguna problemática con el sistema puede obtener
							 soporte con nuestros administradores.</h3>
					 </div>
				 </div>
			 </div>
		 </div>
		 <div class="row row-bottom-padded-sm">
			 <div class="col-md-4 col-sm-6 col-xxs-12">
				 <a href="images/person1.jpg" class="fh5co-project-item image-popup to-animate">
					 <img src="images/support.png" alt="Image" class="img-responsive">
					 <div class="fh5co-text">
					 <h2>Administrador</h2>
					 <span>Contacto1</span>
					 </div>
				 </a>
			 </div>

			 <div class="col-md-4 col-sm-6 col-xxs-12">
				 <a href="images/person2.jpg" class="fh5co-project-item image-popup to-animate">
					 <img src="images/support.png" alt="Image" class="img-responsive">
					 <div class="fh5co-text">
					 <h2>Administrador</h2>
					 <span>Contacto2</span>
					 </div>
				 </a>
			 </div>

			 <div class="clearfix visible-sm-block"></div>

			 <div class="col-md-4 col-sm-6 col-xxs-12">
				 <a href="images/person3.jpg" class="fh5co-project-item image-popup to-animate">
					 <img src="images/support.png" alt="Image" class="img-responsive">
					 <div class="fh5co-text">
					 <h2>Administrador</h2>
					 <span>Contacto3</span>
					 </div>
				 </a>
			 </div>
			  <div class="row">
			 <div class="col-md-12 text-center to-animate">
				 <p></p>
			 </div>
		 </div>
	 </div>
 </section>



	<footer id="footer" role="contentinfo">
		<a href="#" class="gotop js-gotop">Regresar<i class="icon-arrow-up2">Inicio</i></a>
		<div class="container">
			<div class="">
				<div class="col-md-12 text-center">
					<p>&copy; Elate Free HTML5. All Rights Reserved. <br>Created by <a href="http://freehtml5.co/" target="_blank">AJMT</a></p>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="social social-circle">
						<li><a href="#"><i class="icon-twitter"></i></a></li>
						<li><a href="#"><i class="icon-facebook"></i></a></li>
						<li><a href="#"><i class="icon-youtube"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>


	<!-- For demo purposes Only ( You may delete this anytime :-) -->
	<div id="colour-variations">
		<a class="option-toggle"><i class="icon-gear"></i></a>
		<h3>Preset Colors</h3>
		<ul>
			<li>
				<a href="javascript: void(0);" data-theme="style">
					<span style="background: #3f95ea;"></span>
					<span style="background: #52d3aa;"></span>
					<span style="background: #f2f2f2;"></span>
				</a>
			</li>
			<li>
				<a href="javascript: void(0);" data-theme="style2">
					<span style="background: #329998;"></span>
					<!-- E1E561 -->
					<span style="background: #6cc99c;"></span>
					<span style="background: #f2f2f2;"></span>
				</a>
			</li>
			<li>
				<a href="javascript: void(0);" data-theme="style3">
					<span style="background: #9f466e;"></span>
					<span style="background: #c24d67;"></span>
					<span style="background: #f2f2f2;"></span>
				</a>
			</li>
			<li>
				<a href="javascript: void(0);" data-theme="style4">
					<span style="background: #21825C;"></span>
					<span style="background: #A4D792;"></span>
					<span style="background: #f2f2f2;"></span>
				</a>
			</li>

		</ul>
	</div>
	<!-- End demo purposes only -->


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Counter -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>

	<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
	<script src="js/jquery.style.switcher.js"></script>
	<script>
		$(function(){
			$('#colour-variations ul').styleSwitcher({
				defaultThemeId: 'theme-switch',
				hasPreview: false,
				cookie: {
		          	expires: 30,
		          	isManagingLoad: true
		      	}
			});
			$('.option-toggle').click(function() {
				$('#colour-variations').toggleClass('sleep');
			});
		});
	</script>
	<!-- End demo purposes only -->

	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>

	</body>
</html>
