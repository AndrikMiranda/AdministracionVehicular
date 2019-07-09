<?php
  require 'funcs/database0.php';
  require 'funcs/funcs.php';

  $user_id = $mysqli->real_escape_string($_POST['user_id']);
  $token = $mysqli->real_escape_string($_POST['token']);
  $contrasena = $mysqli->real_escape_string($_POST['contrasena']);
  $con_contrasena = $mysqli->real_escape_string($_POST['con_contrasena']);

  if (validaPassword($contrasena, $con_contrasena)) {
    $pass_hash = hashPassword($contrasena);

    if (cambiaPassword($pass_hash, $user_id, $token)) {
      echo "Contraseña modificada con exito.";
      echo "<br><a href='index.php'>Iniciar Sesion</a>";
    } else {
      $errors[] = "Error a modificar la contraseña.";
    }
  } else {
    echo "Las contraseñas no coinciden.";
  }


 ?>
