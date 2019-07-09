<?php

  $server = 'localhost';
  $username = 'root';
  $password = '';
  $db = 'uberdosthp';

$mysqli = new mysqli($server,$username,$password,$db);

if (mysqli_connect_errno()) {
  echo "Conexion fallida: ", mysqli_connect_error;
}

 ?>
