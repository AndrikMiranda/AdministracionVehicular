<?php
  require 'funcs/database0.php';
  require 'funcs/funcs.php';

if (isset($_GET["idUsuario"]) AND isset($_GET['val'])) {


    $idU = $_GET['idUsuario'];
    $token = $_GET['val'];

    $mensaje = validaIdToken($idU, $token);
}
 ?>


<!DOCTYPE html>
<html>
  <head>
    <title>Sistema</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
    <script src="js/bootstrap.min.js" ></script>

  </head>

  <body>
    <div class="container">
      <div class="jumbotron">

        <h1><?php echo (mensaje); ?></h1>

        <br />
        <p><a class="btn btn-primary btn-lg" href="index.php" role="button">Iniciar Sesi&oacute;n</a></p>
      </div>
    </div>
  </body>
</html>
