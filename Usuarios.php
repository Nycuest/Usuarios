<?php

class Usuarios {
  public $Email;
  public $Contrasena;
  public $Respuesta;
}

$objetoJson = new Usuarios();
$data = file_get_contents("php://input");
$entrada = json_decode($data);

// Agregar el código de conexión aquí
$conexion = mysqli_connect("localhost", "root", "") or die("Error de conexión: " . mysqli_connect_error());
mysqli_select_db($conexion, "upvm") or die("Error de base de datos: " . mysqli_error($conexion));

$sql = "SELECT * FROM usuarios WHERE correo='{$entrada->Email}' AND contrasena='{$entrada->Contrasena}'";
$datos = mysqli_query($conexion, $sql) or die("Error de SQL: " . mysqli_error($conexion));

if (mysqli_num_rows($datos) == 1) {
  $objetoJson->Respuesta = "OK";
  echo json_encode($objetoJson);
} else {
  $objetoJson->Respuesta = "Error";
  echo json_encode($objetoJson);
}

mysqli_free_result($datos);
mysqli_close($conexion);
?>