Socio<?php
session_start();
// LOGIN DE USUARIOS -----------------------------------------------------------------------------
if (!isset($_SESSION['tiempo'])) {
  	$_SESSION['tiempo']=time();
} else if (time() - $_SESSION['tiempo'] > 2120) {

	session_destroy();
    /* Aquí redireccionas a la url especifica */
  header("Location: index.php");
  die();
}
$_SESSION['tiempo']=time();

$errors = array();
require 'funcs/database0.php';
require 'funcs/funcs.php';

if(!isset($_SESSION["idUsuario"])){
  header("Location: login.php");
}

$idUsuario = $_SESSION['idUsuario'];

$sql = "SELECT idUsuario, nombreUsuario,tipo FROM usuarios WHERE idUsuario = '$idUsuario'";
$result = $mysqli->query($sql);

$row = $result->fetch_assoc();


// REGISTRO DE VEHICULO UBER

	if (!empty($_POST)) {
		$nombreS = $mysqli->real_escape_string($_POST['nombre']);
		$apellidoS = $mysqli->real_escape_string($_POST['apellido']);
		$fechaNS = $mysqli->real_escape_string($_POST['fechaN']);
		$telefonoS = $mysqli->real_escape_string($_POST['telefono']);
		$direccionS = $mysqli->real_escape_string($_POST['direccion']);
    $correoS = $mysqli->real_escape_string($_POST['correo']);
    $idEstadoS = $mysqli->real_escape_string($_POST['idEstado']);
    $idCiudadS = $mysqli->real_escape_string($_POST['idCiudad']);

		if (isNullSocio($nombreS, $apellidoS, $fechaNS, $telefonoS, $direccionS, $correoS,
    $idEstadoS, $idCiudadS)) {
			$errors[] = "Debe llenar todos los campos.";
		}


    if (count($errors) == 0) {

    $registroS = registrarSocio($nombreS, $apellidoS, $fechaNS, $telefonoS,
    $direccionS, $correoS, $idEstadoS, $idCiudadS);

      if ($registroS > 0) {
          $url = 'http://'.$_SERVER["localhost/uberdost"].'localhost/uberdost/inicio.php?';
          $asunto = 'Registro de socio - AdministracionUberDostHP';
          $cuerpo = "Estimado socio $nombreS: <br /><br /> Se le notifica
          que ya ha sido registrado en nuestra plataforma de administración
          de Uber y comenzar a trabajar con usted. Esperamos que nuestra
          asociación resulte gratificante para ambas partes.<br />
          Si cuenta con alguna duda puede contactarse al correo electronico del cual ha
          recivido este mensaje.";

          if (enviarEmail($correoS, $nombreS, $asunto, $cuerpo)) {
            echo "Se notificado al socio de su registro en la plataforma en
            el correo electronico: $correoS";
            echo "<br><a href='index.php'>Inicio</a>";
            exit;

          } else {
            $errors[] = "Error al enviar Email";
          }
      $message = 'Registro de socio exitoso.';
    } else {
      $errors[] = "Error al registrar socio.";
    }
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
<link rel="icon" href="images/favicon.ico">
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
              <?php if($_SESSION['tipo']==4 || $_SESSION['tipo']==1) { ?>
              <li><a href="#" data-nav-section= "RegistroSocio"><span>Registro de Socio</span></a></li>
              <?php } ?>
               <li><a href="#" data-nav-section=""><span> </span></a></li>
             </ul>
           </div>
				 </nav>
			 <!-- </div> -->
		 </div>
 </header>

 <section id="fh5co-home" data-section="home" style="background-image: url(images/full_image_2.jpg);" data-stellar-background-ratio="0.5">
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
             <?php if ($row['tipo'] == 1): ?>
               <br>Capturista
             <?php endif; ?>
             <?php if ($row['tipo'] == 2): ?>
               <br>Relación Socio-Conductor
             <?php endif; ?>
             <?php if ($row['tipo'] == 3): ?>
               <br>Revisión Semanal
             <?php endif; ?>
             <?php if ($row['tipo'] == 4): ?>
               <br>Administrador
             <?php endif; ?>

						 <h1> <?php echo '¡Bienvenid@ ',utf8_decode($row['nombreUsuario']),'!'; ?></h1>

             <a href="Inicio.php"><button type="button" name="button" class="btn btn-primary btn-lg">Regresar</button></a>

					 </div>
				 </div>
			 </div>
		 </div>
	 </div>
	 <div class="slant"></div>
 </section>

 <?php if($_SESSION['tipo']==4 || $_SESSION['tipo']==1) { ?>
 <section id="fh5co-testimonials" data-section="RegistroSocio">
   <div class="container">
     <div class="row">
       <div class="col-md-12 section-heading text-center">
         <h2 class="to-animate">Registro de Socio</h2>
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
       <form id="vehiculoform" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off" class="col-md-6 to-animate">
         <h3>Registrar nuevo socio</h3>
         <div id="vehiculoalert" style="display:none">
           <p>Error:</p>
           <span></span>
         </div>
         <div class="form-group ">
         <label for="nombre" class="sr-only">Nombre</label>
         <input id="nombre" class="form-control" placeholder="Nombre" name="nombre" type="text" value="<?php if (isset($nombreS)) echo $nombreS; ?>">
         </div>
         <div class="form-group ">
         <label for="apellido" class="sr-only">Apellido</label>
         <input id="apellido" class="form-control" placeholder="Apellido" name="apellido" type="text" value="<?php if (isset($apellidoS)) echo $apellidoS; ?>">
         </div>
         <div class="form-group ">
         <label for="fechaN" class="sr-only">Fecha de Nacimiento</label>
         <?php
         $aano = date('Y')-18;
         echo '<input id="fechaN" class="form-control" placeholder="Fecha de Nacimiento" name="fechaN" type="date" min="1920-01-01" max="'.$aano.'-01-01"value="">';
         ?>
         </div>
         <div class="form-group ">
         <label for="telefono" class="sr-only">Teléfono</label>
         <input id="telefono" class="form-control" placeholder="Teléfono" name="telefono" type="text" value="<?php if (isset($telefonoS)) echo $telefonoS; ?>">
         </div>
         <div class="form-group ">
         <label for="direccion" class="sr-only">Dirección</label>
         <input id="direccion" class="form-control" placeholder="Dirección" name="direccion" type="text" value="<?php if (isset($direccionS)) echo $direccionS; ?>">
         </div>
         <div class="form-group ">
           <label for="correo" class="sr-only">Correo</label>
         <input id="correo" class="form-control" placeholder="Correo" name="correo" type="email" value="<?php if (isset($correoS)) echo $correoS; ?>">
         </div>
         <div class="form-group">
           <select class="form-control" name="idEstado">
             <option selected value="-1">Estado</option>
             <option value="-2">----------------------------</option>
             <option value="1">Chihuahua</option>
             <option value="2">Durango</option>
             <option value="3">Zacatecas</option>
             <option value="4">Nayarit</option>
           </select>
         </div>
         <div class="form-group">
           <select class="form-control" name="idCiudad">
             <option selected value="-1">Ciudad</option>
             <option value="-2">----------------------------</option>
             <option value="1">Chihuahua</option>
             <option value="2">Juarez</option>
             <option value="3">Parral</option>
             <option value="4">Casas Grandes</option>
           </select>
         </div>

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

 <section id="fh5co-contact" data-section="contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12 section-heading text-center">
         <h2 class="to-animate">Get In Touch</h2>
         <div class="row">
           <div class="col-md-8 col-md-offset-2 subtext to-animate">
             <h3>Hello? Hello? Hello? Is there anybody in there? Just nod if you can hear me. Is there anyone at home? </h3>
           </div>
         </div>
       </div>
     </div>
     <div class="row row-bottom-padded-md ">
       <div class="col-md-3 to-animate">
         <h3>Contact Info</h3>
         <ul class="fh5co-contact-info">
           <li class="fh5co-contact-address ">
             <i class="icon-home"></i>
             5555 Love Paradise 56 New Clity 5655, <br>Excel Tower United Kingdom
           </li>
           <li><i class="icon-phone"></i> (123) 465-6789</li>
           <li><i class="icon-envelope"></i>info@yourmail.co</li>
           <li><i class="icon-globe"></i> <a href="#">freehtml5.co</a></li>
         </ul>
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