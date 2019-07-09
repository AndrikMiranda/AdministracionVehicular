<?php
session_start();

if (!isset($_SESSION['tiempo'])) {
  	$_SESSION['tiempo']=time();
} else if (time() - $_SESSION['tiempo'] > 2120) {

	session_destroy();
    /* Aquí redireccionas a la url especifica */
  header("Location: index.php");
  die();
}
$_SESSION['tiempo']=time();

require 'funcs/database0.php';
require 'funcs/funcs.php';
$errors = array();

// CHECA QUE ESTE LOGEADO --------------------------------------------------------

if(!isset($_SESSION["idUsuario"])){
  header("Location: login.php");
}

$idUsuario = $_SESSION['idUsuario'];

$sql = "SELECT idUsuario, nombreUsuario,tipo FROM usuarios WHERE idUsuario = '$idUsuario'";
$result = $mysqli->query($sql);

$row = $result->fetch_assoc();


// REGISTRO DE USUARIOS -----------------------------------------------------


if (!empty($_POST)) {
	$nombreU = $mysqli->real_escape_string($_POST['nombreUsuario']);
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$apellido = $mysqli->real_escape_string($_POST['apellido']);
	$telefono = $mysqli->real_escape_string($_POST['telefono']);
	$correo = $mysqli->real_escape_string($_POST['correo']);
	$contrasena = $mysqli->real_escape_string($_POST['contrasena']);
	$con_contrasena = $mysqli->real_escape_string($_POST['contrasena_con']);
	$tipo = $mysqli->real_escape_string($_POST['tipo']);
	$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);

	$activo = 0;

	$secret = '6Lf5m3cUAAAAACW0ADTldZIYa2tTDqQPgbJYXOM0';

	if (!$captcha) {
		$errors[] = "Porfavor verifica el captcha";
	}

	if (isNull($nombreU, $nombre, $apellido, $telefono, $correo, $contrasena,
	$con_contrasena, $tipo)) {
		$errors[] = "Debe llenar todos los campos";
	}

	if (!isEmail($correo)) {
		$errors[] = "Dirreción de correo inválida";
	}

	if (!validaPassword($contrasena, $con_contrasena)) {
		$errors[] = "Las contraseñas no coinciden";
	}

	 if (usuarioExistente($nombreU)) {
	 	$errors[] = "El nombre de usuario $nombreU ya existe";
	 }

	 if (emailExistente($correo)) {
	  $errors[] = "El correo electronico $correo ya existe";
	 }

	 if (count($errors) == 0) {
	 		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

			$arr = json_decode($response, TRUE);

			if ($arr['success']) {

				$pass_hash = hashPassword($contrasena);
				$token = generateToken();

				$registro = registraUsuario($nombreU, $nombre, $apellido, $telefono, $correo, $pass_hash, $activo, $token, $tipo);

			if ($registro > 0) {
					$url = 'http://'.$_SERVER["localhost/uberdost"].'localhost/uberdost/activar.php?id='.$registro.'&val='.$token;
					$asunto = 'Activacion de cuenta - Administracio
					nUberDostHP';
					$cuerpo = "Estimado $nombre: <br /><br /> Para continuar con el
					proceso de registro, es indispensable de click en la siguiente
					liga: <a href='$url'> Activar Cuenta</a>";

					if (enviarEmail($correo, $nombre, $asunto, $cuerpo)) {
						echo "Para terminar el proceso de registro siga las instrucciones
						que le hemos enviado a la direccion de correo electronico: $correo";
						echo "<br><a href='index.php'>Iniciar Session</a>";
						exit;

					} else {
						$errors[] = "Error al enviar Email";
					}

			} else {
				$errors[] = "Error al registrar";
			}

			} else {
				$errors[] = 'Error al comprobar Captcha';
			}

	 }

}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<script src='https://www.google.com/recaptcha/api.js'></script>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>UberDostHP &mdash; AdministraciónUberDostHP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="AdministraciónUberDostHP" />
	<meta name="keywords" content="AdministraciónUberDostHP" />
	<meta name="author" content="AJMT" />

  <!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FREEHTML5.CO

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

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
						<div class="nav navbar-nav navbar-right">
            <a href="logout.php"><button type="button" name="button" class="btn btn-primary btn-lg">Salir</button></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
 						 <ul class="nav navbar-nav navbar-right">
 							 <li class="active"><a href="#" data-nav-section="home"><span>Inicio</span></a></li>
								<?php if($_SESSION['tipo']==4) { ?>
                <li><a href="#" data-nav-section= "Registro"><span>Registro de usuarios</span></a></li>
              	<?php } ?>
								<li><a href="#" data-nav-section=""><span> </span></a></li>
		          </ul>
		        </div>
			    </nav>
			  <!-- </div> -->
		  </div>
	</header>

	<section id="fh5co-home" data-section="home" style="background-image: url(images/registro.jpg);" data-stellar-background-ratio="0.5">
		<div class="gradient"></div>
		<div class="container">
			<div class="text-wrap">
				<div class="text-inner">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h1 class="to-animate">UberDostHP.</h1>
 						 <h2 class="to-animate"> Administración de las actividades realizadas en UberDostHP. Versión 1.0</h2>
							<?php if(!empty($message)): ?>
								<p><?= $message ?></p>
							<?php endif; ?>
              <?php if ($row['tipo'] == 4): ?>
                <br>Administrador
              <?php endif; ?>

							<h1> <?php echo '¡Hola ',utf8_decode($row['nombreUsuario']),'!'; ?></h1>
              <a href="Inicio.php"><button type="button" name="button" class="btn btn-primary btn-lg">Regresar</button></a>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="slant"></div>
	</section>

	<?php if($_SESSION['tipo']==4) { ?>
	<section id="fh5co-contact" data-section="Registro">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
					<h2 class="to-animate">Registro de usuario</h2>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 subtext to-animate">
							<h3>Recuerda verificar que todos los datos sean correctos antes de registrarlo en la plataforma.</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row row-bottom-padded-md">
				<div class="col-md-3 to-animate">

				</div>

				<form id="signupform" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off" class="col-md-6 to-animate">
					<h3>Registrar nuevo usuario</h3>
					<div id="signupalert" style="display:none">
						<p>Error:</p>
						<span></span>
					</div>
					<div class="form-group ">
						<label for="nombreUsuario" class="sr-only">Nombre del usuario</label>
						<input id="nombreUsuario" class="form-control" placeholder="Usuario" name="nombreUsuario" type="text" value="<?php if (isset($nombreU)) echo $nombreU; ?>">
					</div>
					<div class="form-group ">
						<label for="nombre" class="sr-only">Nombre</label>
						<input id="nombre" class="form-control" placeholder="Nombre" name="nombre" type="text" value="<?php if (isset($nombre)) echo $nombre; ?>"required>
					</div>
					<div class="form-group ">
						<label for="apellido" class="sr-only">Apellidos</label>
						<input id="apellido" class="form-control" placeholder="Apellido" name="apellido" type="text" value="<?php if (isset($apellido)) echo $apellido; ?>">
					</div>
					<div class="form-group ">
						<label for="telefono" class="sr-only">Telefono</label>
						<input id="telefono" class="form-control" placeholder="Telefono" name="telefono" type="text" value="<?php if (isset($telefono)) echo $telefono; ?>">
					</div>
					<div class="form-group ">
						<label for="correo" class="sr-only">Correo</label>
						<input id="correo" class="form-control" placeholder="Correo" name="correo" type="email" value="<?php if (isset($correo)) echo $correo; ?>">
					</div>
					<div class="form-group ">
						<label for="contrasena" class="sr-only">Contraseña</label>
						<input id="contrasena" class="form-control" placeholder="contraseña" name="contrasena" type="password">
					</div>
					<div class="form-group ">
						<label for="contrasena_con" class="sr-only">Confirmar Contraseña</label>
						<input id="contrasena_con" class="form-control" placeholder="confirmar contraseña" name="contrasena_con" type="password">
					</div>
					<div class="form-group">
						<select class="form-control" name="tipo">
							<option selected value="-1">Selecciona una opción</option>
							<option value="-2">----------------------------</option>
							<option value="1">Capturista</option>
   						<option value="2">Relación Socio-Conductor</option>
   						<option value="3">Revisión Semanal</option>
   						<option value="4">Administrador</option>
						</select>
					</div>
					<div class="g-recaptcha" data-sitekey="6Lf5m3cUAAAAAO-Ph_4NL08rjMraupQzsjT5DceX"></div>
					<div class="form-group ">
						<br>
						<input class="btn btn-primary btn-lg" type="submit">
					</div>
					</form>
					<?php echo resultBlock($errors); ?>
				</div>

			</div>
		</div>
	</section>
	<?php } ?>

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
