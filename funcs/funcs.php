<?php
function modificarSocio($nombre, $apellido, $fechaN, $telefono, $direccion, $correo, $idEstado, $idCiudad, $id){

 global $mysqli;

 $stmt = $mysqli->prepare("UPDATE socio SET nombre = ?, apellido = ?, fechaN = ?,
 telefono = ?, direccion = ?, correo = ?, idEstado = ?, idCiudad = ? WHERE idSocio = ?");
 $stmt->bind_param('sssissiii', $nombre, $apellido, $fechaN, $telefono, $direccion, $correo, $idEstado, $idCiudad, $id);
 $stmt->execute();
 $stmt->close();
}

function noRepiteConductor($idConductor){
  global $mysqli;
  $stmt = $mysqli->prepare("SELECT idConductor FROM SocioConductor WHERE idConductor = ? LIMIT 1");
  $stmt->bind_param('i', $idConductor);
  $stmt->execute();
  $stmt->store_result();
  $num = $stmt->num_rows;
  $stmt->close();

  if ($num > 0) {
    return true;
  } else {
    return false;
  }
}

function isNullSC($idConductor, $idSocio){
  if (strlen(trim($idConductor)) < 1 || strlen(trim($idSocio)) < 1){
    return true;
  } else {
    return false;
  }
}

function asignarSC($idConductor, $idSocio){
  global $mysqli;
  $stmt = $mysqli->prepare("INSERT INTO SocioConductor (idConductor, idSocio) VALUES(?, ?)");
  $stmt->bind_param('ii', $idConductor, $idSocio);
  if ($stmt->execute()) {
    return $mysqli->insert_id;
  } else {
    return 0;
  }
}

function noRepite($idVehiculo){
  global $mysqli;
  $stmt = $mysqli->prepare("SELECT idVehiculo FROM socioVehiculo WHERE idVehiculo = ? LIMIT 1");
  $stmt->bind_param('i', $idVehiculo);
  $stmt->execute();
  $stmt->store_result();
  $num = $stmt->num_rows;
  $stmt->close();

  if ($num > 0) {
    return true;
  } else {
    return false;
  }
}

function asignarVS($idSocio, $idVehiculo){
  global $mysqli;
  $stmt = $mysqli->prepare("INSERT INTO socioVehiculo (idSocio, idVehiculo) VALUES(?, ?)");
  $stmt->bind_param('ii', $idSocio, $idVehiculo);
  if ($stmt->execute()) {
    return $mysqli->insert_id;
  } else {
    return 0;
  }
}

function asignarVC($idVehiculo, $idConductor){
  global $mysqli;
  $stmt = $mysqli->prepare("UPDATE conductor SET idVehiculo = ? WHERE idConductor = ?");
  $stmt->bind_param('ii', $idVehiculo, $idConductor);
  if ($stmt->execute()) {
    return $mysqli->insert_id;
  } else {
    return 0;
  }
}

function telefonoExiste($telefonoC){
  global $mysqli;
  $stmt = $mysqli->prepare("SELECT telefono from conductor WHERE telefono = ? LIMIT 1");
  $stmt->bind_param("s", $telefonoC);
  $stmt->execute();
  $stmt->store_result();
  $num = $stmt->num_rows;
  $stmt->close();

  if ($num > 0) {
    return true;
  } else {
    return false;
  }
}

function isNullSV($idSocio, $idVehiculo){
  if (strlen(trim($idSocio)) < 1 || strlen(trim($idVehiculo)) < 1){
    return true;
  } else {
    return false;
  }
}

function isNullCV($idConductor, $idVehiculo){
  if (strlen(trim($idConductor)) < 1 || strlen(trim($idVehiculo)) < 1){
    return true;
  } else {
    return false;
  }
}

function isNullConductor($nombreC, $apellidosC, $fechaNC, $telefonoC, $direccionC, $correoC,
$credito, $idEstadoC, $idCiudadC, $idCertificado){
  if (strlen(trim($nombreC)) < 1 || strlen(trim($apellidosC)) < 1 || strlen(trim($telefonoC)) < 1 ||
  strlen(trim($fechaNC)) < 1 || strlen(trim($direccionC)) < 1 || strlen(trim($correoC)) < 1 ||
  strlen(trim($credito)) < 1 || strlen(trim($idEstadoC)) < 1 || strlen(trim($idCiudadC)) < 1 ||
  strlen(trim($idCertificado)) < 1) {
      return true;
  } else {
    return false;
  }
}

function registrarConductor($nombreC, $apellidosC, $fechaNC, $telefonoC, $direccionC, $correoC,
$credito, $idEstadoC, $idCiudadC, $idCertificado, $idConductor){
 global $mysqli;
 $stmt = $mysqli->prepare("UPDATE conductor SET nombre = ?, apellidos = ?, fechaN = ?,
   telefono = ?, direccion = ?, correo = ?, credito = ?, idEstado = ?, idCiudad = ?,
   idCertificado = ? WHERE idConductor = ?");
 $stmt->bind_param('ssssssiiiii', $nombreC, $apellidosC, $fechaNC, $telefonoC, $direccionC, $correoC,
 $credito, $idEstadoC, $idCiudadC, $idCertificado, $idConductor);
 $stmt->execute();
 $stmt->close();
}

function isNullProspecto($nombreC, $apellidoC, $telefonoC,$tipoCertificado){
  if (strlen(trim($nombreC)) < 1 || strlen(trim($apellidoC)) < 1 || strlen(trim($telefonoC)) < 1) {
      return true;
  } else {
    return false;
  }
}

function registrarProspecto($nombreC, $apellidoC, $telefonoC, $tipoCertificado){

 global $mysqli;

 $stmt = $mysqli->prepare("INSERT INTO conductor (nombre, apellidos, telefono, idCertificado) VALUES (?,?,?,?)");
 $stmt->bind_param('sssi',$nombreC, $apellidoC, $telefonoC, $tipoCertificado);
   if ($stmt->execute()) {
     return $mysqli->insert_id;
   } else {
     return 0;
  }
}

function isNullSocio($nombreS, $apellidoS, $fechaNS, $telefonoS, $direccionS, $correoS,
$idEstadoS, $idCiudadS){
  if (strlen(trim($nombreS)) < 1 || strlen(trim($apellidoS)) < 1 ||
  strlen(trim($fechaNS)) < 1 || strlen(trim($telefonoS)) < 1 || strlen(trim($direccionS)) < 1 ||
  strlen(trim($correoS)) < 1 || strlen(trim($idEstadoS)) < 1 || strlen(trim($idCiudadS)) < 1) {
      return true;
  } else {
    return false;
  }
}

function registrarSocio($nombreS, $apellidoS, $fechaNS, $telefonoS, $direccionS, $correoS,
$idEstadoS, $idCiudadS){

 global $mysqli;

 $stmt = $mysqli->prepare("INSERT INTO socio (nombre, apellido, fechaN, telefono,
 direccion, correo, idEstado, idCiudad) VALUES (?,?,?,?,?,?,?,?)");
 $stmt->bind_param('ssssssii', $nombreS, $apellidoS, $fechaNS, $telefonoS, $direccionS, $correoS,
 $idEstadoS, $idCiudadS);
   if ($stmt->execute()) {
     return $mysqli->insert_id;
   } else {
     return 0;
  }
}

function isNullVehiculo($idMarca, $idModelo, $idColor, $Ano, $matricula){
  if (strlen(trim($idMarca)) < 1 || strlen(trim($idModelo)) < 1 ||
  strlen(trim($idColor)) < 1 || strlen(trim($Ano)) < 1 || strlen(trim($matricula)) < 1) {
      return true;
  } else {
    return false;
  }
}

function matriculaExistente ($matricula){
  global $mysqli;
  $stmt = $mysqli->prepare("SELECT idVehiculo FROM vehiculo WHERE matricula = ? LIMIT 1");
  $stmt->bind_param("s", $matricula);
  $stmt->execute();
  $stmt->store_result();
  $num = $stmt->num_rows;
  $stmt->close();

  if ($num > 0) {
    return true;
  } else {
    return false;
  }
}

function consultaVehiculo1($idMarca, $idModelo, $idColor, $Ano, $matricula){

 global $mysqli;

 $stmt = $mysqli->prepare("SELECT idMarca, idModelo, idColor, ano, matricula
 FROM vehiculo  WHERE idMarca = ? || idModelo = ? || idColor = ? || ano = ? ||
  matricula = ?");
 $stmt->bind_param('iiiis', $idMarca, $idModelo, $idColor, $Ano, $matricula);
 $stmt->execute();
 $stmt->store_result();
 $num = $stmt->num_rows;
 if ($num > 0) {
  return true;
} else {
  return false;
}
}

function consultaVehiculo($idMarca, $idModelo, $idColor, $Ano, $matricula){

  global $mysqli;

  $stmt = $mysqli->prepare("SELECT idMarca, idModelo, idColor, ano, matricula
    FROM vehiculo INNER JOIN marca ON vehiculo.idMarca = marca.idMarca
    INNER JOIN modelo ON vehiculo.idModelo = modelo.idModelo
    INNER JOIN colorVehiculo ON vehiculo.idColor = colorVehiculo.idColor WHERE
    idMarca = ? || idModelo = ? || idColor = ? || ano = ? || matricula = ?");
    $stmt->bind_param('iiiis', $idMarca, $idModelo, $idColor, $Ano, $matricula);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;
    if ($num > 0) {
      return true;
    } else {
      return false;
    }
  }

  function certificarProspecto($tipoCertificado, $idConductor){
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE conductor SET idCertificado = ? WHERE idConductor = ?");
    $stmt->bind_param('ii', $tipoCertificado, $idConductor);
    $stmt->execute();
    $stmt->close();
  }


  function modificarVehiculo($idMarca, $idModelo, $idColor, $Ano, $matricula, $id){

   global $mysqli;

   $stmt = $mysqli->prepare("UPDATE vehiculo SET idMarca = ?, idModelo = ?, idColor = ?,
   ano = ?, matricula = ? WHERE idVehiculo = ?");
   $stmt->bind_param('iiiisi', $idMarca, $idModelo, $idColor, $Ano, $matricula, $id);
   $stmt->execute();
   $stmt->close();
  }

function eliminarVehiculo($id){
  global $mysqli;

  $stmt = $mysqli->prepare("DELETE FROM vehiculo WHERE idVehiculo = ?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();
}

function registrarVehiculo($idMarca, $idModelo, $idColor, $Ano, $matricula){

 global $mysqli;

 $stmt = $mysqli->prepare("INSERT INTO vehiculo (idMarca, idModelo, idColor,
 ano, matricula) VALUES (?,?,?,?,?)");
 $stmt->bind_param('iiiis', $idMarca, $idModelo, $idColor, $Ano, $matricula);
   if ($stmt->execute()) {
     return $mysqli->insert_id;
   } else {
     return 0;
  }
}

function getValor($campo, $campoWhere, $valor){
  global $mysqli;

  $stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere =
  ? LIMIT 1");
  $stmt->bind_param('s', $valor);
  $stmt->execute();
  $stmt->store_result();
  $num = $stmt->num_rows;

  if ($num > 0) {
    $stmt->bind_result($_campo);
    $stmt->fetch();
    return $_campo;
  } else {
    return null;
  }
}

function verificaTokenPass($user_id, $token){
  global $mysqli;

  $stmt = $mysqli->prepare('SELECT activacion FROM usuarios WHERE idUsuario = ?
  AND token_password = ? AND contrasena_recuest = 1 LIMIT 1');
  $stmt->bind_param('is', $user_id, $token);
  $stmt->execute();
  $stmt->store_result();
  $num = $stmt->num_rows;

  if ($num > 0) {
    $stmt->bind_result($activacion);
    $stmt->fetch();

    if ($activacion == 1) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }

}

function cambiaPassword($contrasena, $user_id, $token){
  global $mysqli;

  $stmt = $mysqli->prepare("UPDATE usuarios SET contrasena = ?, token_password = '',
  contrasena_recuest = 0 WHERE idUsuario = ? AND token_password = ?");
  $stmt->bind_param('sis', $contrasena, $user_id, $token);

  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }

}

function generateTokenPass($user_id){
  global $mysqli;

  $token = generateToken();

  $stmt = $mysqli->prepare("UPDATE usuarios SET token_password = ?,
  contrasena_recuest = 1 WHERE idUsuario = ?");
  $stmt->bind_param('ss', $token, $user_id);
  $stmt->execute();
  $stmt->close();

  return $token;
}

function isNull ($nombreU, $nombre, $apellido, $telefono, $correo, $contrasena,
$contrasena_con, $tipo){
      if (strlen(trim($nombreU)) < 1 || strlen(trim($nombre)) < 1 ||
    strlen(trim($apellido)) < 1 || strlen(trim($telefono)) < 1 ||
    strlen(trim($correo)) < 1 || strlen(trim($contrasena)) < 1 ||
    strlen(trim($contrasena_con)) < 1|| strlen(trim($tipo)) < 1) {
      return true;
    } else {
    return false;
  }
}

function isEmail($correo){
  if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    return true;
  }else {
    return false;
  }
}

function validaPassword($var1, $var2){
  if (strcmp($var1, $var2) !== 0) {
    return false;
  } else {
    return true;
  }
}

function minMax($min, $max, $valor){
  if (strlen(trim($valor)) < $min) {
    return true;
  } else if (strlen(trim($valor)) > $max) {
    return true;
  } else {
    return false;
  }
}

 function usuarioExistente ($nombreU){

   global $mysqli;

   $stmt = $mysqli->prepare("SELECT idUsuario FROM usuarios WHERE nombreUsuario = ? LIMIT 1");
   $stmt->bind_param("s", $nombreU);
   $stmt->execute();
   $stmt->store_result();
   $num = $stmt->num_rows;
   $stmt->close();

   if ($num > 0) {
     return true;
   } else {
     return false;
   }
 }

 function emailExistente ($correo){
   global $mysqli;

   $stmt = $mysqli->prepare("SELECT idUsuario FROM usuarios WHERE correo = ? LIMIT 1");
   $stmt->bind_param("s", $correo);
   $stmt->execute();
   $stmt->store_result();
   $num = $stmt->num_rows;
   $stmt->close();

   if ($num > 0) {
     return true;
   } else {
     return false;
   }
 }

 function generateToken(){
   $gen = md5(uniqid(mt_rand(), false));
   return $gen;
 }

 function hashPassword($contrasena){
  $hash = password_hash($contrasena, PASSWORD_DEFAULT);
  return $hash;
 }

 function resultBlock($errors){
   if (count($errors) > 0) {
     echo "
     <div id='error' role='alert' class='form-control col-md-6 to-animate'>
     <a href='#' onclick=\"showHide('error');\">[X]</a>
     <ul>";
     foreach ($errors as $error) {
       echo "<li>".$error."</li>";
     }
     echo "</ul>";
     echo "</div>";
   }
 }

 function registraUsuario($nombreU, $nombre, $apellido, $telefono, $correo,
 $pass_hash, $activo, $token, $tipo){

   global $mysqli;

   $stmt = $mysqli->prepare("INSERT INTO usuarios (nombreUsuario, nombre,
   apellido,telefono, correo, contrasena, activacion, token, tipo) VALUES (?,?,?,?,?,?,?,?,?)");
     $stmt->bind_param('ssssssisi', $nombreU, $nombre, $apellido, $telefono, $correo,
    $pass_hash, $activo, $token, $tipo);

     if ($stmt->execute()) {
       return $mysqli->insert_id;
     } else {
       return 0;
     }
 }

 function enviarEmail($correo, $nombre, $asunto, $cuerpo){
   require_once 'PHPMailer/PHPMailerAutoload.php';

   $mail = new PHPMailer();
   $mail->isSMTP();
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = 'tls';
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = '587';

   $mail->Username = 'sistemauberdosthp@gmail.com';
   $mail->Password = '';

   $mail->setFrom('sistemauberdosthp@gmail.com', 'Registro UberDostHP');
   $mail->addAddress($correo, $nombre);

   $mail->Subject = $asunto;
   $mail->Body = $cuerpo;
   $mail->IsHTML(true);

   if ($mail->send()) {
     return true;
   } else {
     return false;
   }
 }

 function validaIdToken($idUsuario, $token){
   global $mysqli;

   $stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE idUsuario = ?
   AND token = ? LIMIT 1");
   $stmt->bind_param("is", $idUsuario, $token);
   $stmt->execute();
   $stmt->store_result();
   $rows = $stmt->num_rows;

   if ($rows > 1) {
     $stmt->bind_result($activacion);
     $stmt->fetch();

     if ($activacion == 1) {
       $msg = "La cuenta ya se activo anteriormente";
     } else {
       if (activacionUsuario($idUsuario)) {
            $msg = 'Cuenta activada';
       } else {
         $msg = 'Error al activar cuenta';
       }
     }
   } else {
     $msg = 'No existe el registro para activar';
   }
   return $msg;
 }


 function activarUsuario($idUsuario){
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE usuarios SET activacion = 1 WHERE idUsuario = ?");
    $stmt->bind_param('s', $idUsuario);
    $result = $stmt->execute();
    $stmt->close();
    return $result;

 }

 function isNullLogin($usuario, $password) {
   if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
     return true;
   } else {
     return false;
   }
 }

 function login ($usuario, $contra){
   global $mysqli;

   $stmt = $mysqli->prepare("SELECT idUsuario, tipo, contrasena FROM usuarios
   WHERE nombreUsuario = ? || correo = ? LIMIT 1");
   $stmt->bind_param("ss", $usuario, $usuario);
   $stmt->execute();
   $stmt->store_result();
   $rows = $stmt->num_rows;

   if ($rows > 0) {
     if (isActivo($usuario)) {
       $stmt->bind_result($id, $tipo, $pass);
       $stmt->fetch();
       $validaPass = password_verify($contra, $pass);

       if ($validaPass) {
         lastSession($id);
         $_SESSION['idUsuario'] = $id;
         $_SESSION['tipo'] = $tipo;

         header("location: index.php");
       } else {
         $errors = "La contrase&ntilde;a es incorrecta.";
       }
     } else {
       $errors = 'El usuario no esta activo.';
     }
   } else {
     $errors = "El nombre de usuario o correo electr&oacute; no existe.";
   }
   return $errors;
 }

 function lastSession($id) {
   global $mysqli;

   $stmt = $mysqli->prepare("UPDATE usuarios SET last_session = NOW(),
   token_password = '', contrasena_recuest = 1 WHERE idUsuario = ?");
   $stmt->bind_param('s', $id);
   $stmt->execute();
   $stmt->close();
 }

 function isActivo($usuario){
   global $mysqli;
   $stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE nombreUsuario = ? || correo = ? LIMIT 1");
   $stmt->bind_param('ss', $usuario, $usuario);
   $stmt->execute();
   $stmt->bind_result($activacion);
   $stmt->fetch();

   if ($activacion == 1) {
     return true;
   } else {
     return false;
   }
 }


?>
