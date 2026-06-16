<?php
session_start();
require 'config.php';
require 'validaciones.php';

$error = null;

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["usuario"])) {
  $usuario_entrada = sanitizar_entrada($conexion, $_POST["usuario"]);
  $password_entrada = sanitizar_entrada($conexion, $_POST["password"]);
  $tipo_usuario = "";

  if (isset($_POST["tipo_usuario"])) {
    $tipo_usuario = $_POST["tipo_usuario"];
  }
  //Cambia el usuario segun el tipo de usuario
  if ($tipo_usuario == "alumno") {
    $usuario = "1" . $usuario_entrada;
  } else if ($tipo_usuario == "profesor") {
    $usuario = "2" . $usuario_entrada;
  } else {
    $tipo_usuario = 3;
    $usuario = "3" . $usuario_entrada;
  }

  $password = hash("sha256", $password_entrada);
  $sql = "SELECT nombre, id_usuario, tipo_usuario FROM usuarios WHERE id_usuario = '$usuario' AND password = '$password'";
  $resultado = mysqli_query($conexion, $sql);
  $registro = mysqli_fetch_assoc($resultado);

  if ($registro) {
    $_SESSION['usuario'] = $registro["id_usuario"];
    $_SESSION['tipo_usuario'] = $registro["tipo_usuario"];
    $_SESSION['nombre'] = $registro["nombre"];
    $_SESSION['llave'] = random_int(1, 72057594037927935); //un entero de 7 bytes
    $key = crear_secuencia("rayas");
    $usuario_encriptado = encriptar(crear_secuencia($registro["id_usuario"]), $key[0]);
    setcookie("usuario", $usuario_encriptado, time() + 604800);//$registro["id_usuario"], time() + 604800); // 3600 * 24 * 7 Una semana
    //setcookie("usuario", $registro["id_usuario"], time() + 604800); // 3600 * 24 * 7 Una semana
    
    header("Location: inicio.php");
    // correccion: sin exit() el codigo seguia ejecutandose despues del redirect
    exit();
  } else {
    $error = "Usuario no encontrado";
    header("Location: ../../login.html");
    exit();
  }
}