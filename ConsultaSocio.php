<?php
session_start();
define('MYSQL_ASSOC',MYSQLI_ASSOC);
if (!isset($_SESSION['tiempo'])) {
  	$_SESSION['tiempo']=time();
} else if (time() - $_SESSION['tiempo'] > 2120) {

	session_destroy();
    /* Aquí redireccionas a la url especifica */
  header("Location: index.php");
  die();
}
$_SESSION['tiempo']=time();
// LOGIN DE USUARIOS -----------------------------------------------------------------------------
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
// CONSULTA DE Socio UBER

$where = "";
if (!empty($_POST)) {
  $valor = $_POST['nombre'];
  if (!empty($valor)) {
    $where = "WHERE nombre LIKE '%$valor%'";
  }
}
$consulta = "SELECT * FROM socio $where";
$resultado = $mysqli->query($consulta);

 ?>



<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
 <head>
 <meta charset="utf-8">
 <script src="js/jquery-3.1.1.min.js"></script>
 	<script src="js/bootstrap.min.js"></script>
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
 <script src="js/jquery-3.1.1.min.js"></script>
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
              <li><a href="#" data-nav-section= "RegistroSocio"><span>Consulta de Socio</span></a></li>
              <?php } ?>
               <li><a href="#" data-nav-section=""><span> </span></a></li>
             </ul>
           </div>
				 </nav>
			 <!-- </div> -->
		 </div>
 </header>

 <section id="fh5co-home" data-section="home" style="background-image: url(images/UberDost2.jpg);" data-stellar-background-ratio="0.5">
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

						 <h1> <?php echo '¡Hola ',utf8_decode($row['nombreUsuario']),'!'; ?></h1>

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
   <div class="row">
     <div class="col-md-12 section-heading text-center">
       <h2 class="to-animate">Consulta de Socio</h2>
       <div class="row">
         <div class="col-md-10 col-md-offset-1 subtext to-animate">
             <h3 class="to-animate">Consulta (Prueba)</h3>
             <form class="" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                 <h3>Buscar por nombre</h3>

                   <label for="nombre" class="sr-only">Nombre</label>
                   <input id="nombre" class="form-control" placeholder="Nombre" name="nombre" type="text">
                   <br>
                   <input class="btn btn-primary btn-lg" type="submit">
                 </form>
                 <br>
                 <br>
                 <br>
             <table>
               <thead>
                 <tr>
                   <th width="200">Nombre</th>
                   <th width="200">Apellidos</th>
                   <th width="200">Fecha de nacimiento</th>
                   <th width="200">Teléfono</th>
                   <th width="200">Dirección</th>
                   <th width="200">Correo</th>
                   <th width="200">Estado</th>
                   <th width="200">Ciudad</th>
                   <th width="100"> </th>
                   <th width="100"> </th>
                 </tr>
               </thead>


               <?php
                 while ($row = $resultado ->fetch_array(MYSQL_ASSOC)) {
                   $consulta2 = "SELECT nombreCiudad FROM ciudad WHERE idCiudad = ".$row['idCiudad']."";
                   $resultado2 = $mysqli->query($consulta2);
                   $row2 = $resultado2 ->fetch_array(MYSQL_ASSOC);

                   $consulta3 = "SELECT nombreEstado FROM estado WHERE idEstado = ".$row['idEstado']."";
                   $resultado3 = $mysqli->query($consulta3);
                   $row3 = $resultado3 ->fetch_array(MYSQL_ASSOC);
                     ?>
                     <tr>
                       <td><?php echo $row['nombre']; ?></td>
                       <td><?php echo $row['apellido']; ?></td>
                       <td><?php echo $row['fechaN']; ?></td>
                       <td><?php echo $row['telefono']; ?></td>
                       <td><?php echo $row['direccion']; ?></td>
                       <td><?php echo $row['correo']; ?></td>
                       <td><?php echo $row3['nombreEstado']; ?></td>
                       <td><?php echo $row2['nombreCiudad']; ?></td>
                       <td><a href="modificarSocio.php?idSocio=<?php echo $row['idSocio']; ?>">
                       <span class="glyphicon glyphicon-pencil"></span></a></td>
                       <td><a href="eliminarSocio.php?idSocio=<?php echo $row['idSocio']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
         							</tr>
                     </tr>
               <?php
                 }
               ?>
             </table>
         </div>
       </div>
     </div>
   </div>


  <!-- MODAL -->
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
  aria-aria-labelledby="myModalLabel" aria-aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Eliminar Socio</h4>
        </div>
        <div class="modal-body">
          Desea eliminar este Socio?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-danger btn-ok" href="eliminarSocio.php">Eliminar</a>
          <?php echo resultBlock($errors); ?>
        </div>
      </div>
    </div>

  </div>

<script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Eliminar URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>
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

	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Counter -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>


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
