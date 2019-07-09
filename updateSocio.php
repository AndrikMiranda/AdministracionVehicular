<?php
session_start();
if (!isset($_SESSION['tiempo'])) {

    $_SESSION['tiempo']=time();

} else if (time() - $_SESSION['tiempo'] > 2120) {

  session_destroy();
  header("Location: index.php");
  die();

}

$_SESSION['tiempo']=time();

//AQUI ES EL TIEMPO QUE PERMANEZCA LA SESION ABIERTA-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$errors = array();

require 'funcs/database0.php';
require 'funcs/funcs.php';

if(!isset($_SESSION["idUsuario"])){
  header("Location: login.php");
}

$idUsuario = $_SESSION['idUsuario'];

$sql = "SELECT idUsuario, nombreUsuario FROM usuarios WHERE idUsuario = '$idUsuario'";
$result = $mysqli->query($sql);

$row = $result->fetch_assoc();

//AQUI COMPRUEBA QUE ESTE INICIADA LA SESION ABIERTA-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


if (!empty($_POST)) {
  $id = $mysqli->real_escape_string($_POST['idSocio']);
  $nombre = $mysqli->real_escape_string($_POST['nombre']);
  $apellido = $mysqli->real_escape_string($_POST['apellido']);
  $fechaN = $mysqli->real_escape_string($_POST['fechaN']);
  $telefono = $mysqli->real_escape_string($_POST['telefono']);
  $direccion = $mysqli->real_escape_string($_POST['direccion']);
  $correo = $mysqli->real_escape_string($_POST['correo']);
  $idEstado = $mysqli->real_escape_string($_POST['idEstado']);
  $idCiudad = $mysqli->real_escape_string($_POST['idCiudad']);

    $registroS = modificarSocio($nombre, $apellido, $fechaN, $telefono, $direccion, $correo, $idEstado, $idCiudad, $id);

  if ($registroS > 0) {
    $message = 'Modificación de socio exitoso.';

  } else {
    $errors[] = "Error al modificar socio.";
  }

}
  echo $message;

?>
