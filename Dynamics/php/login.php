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
    setcookie("usuario", $registro["id_usuario"], time() + 604800); // 3600 * 24 * 7 Una semana
    header("Location: inicio.php");
  } else {
    $error = "Usuario no encontrado";
    header("Location: ../../login.html");
  }
}

/* else {
  require 'config.php';
  if (isset($_COOKIE["usuario"])) {
    $usuario = $_COOKIE["usuario"];

    $sql = "SELECT nombre, tipo_usuario FROM usuarios WHERE id_usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_assoc($resultado);


    $_SESSION['usuario'] = $registro["id_usuario"];
    $_SESSION['tipo_usuario'] = $registro["tipo_usuario"];
    $_SESSION['nombre'] = $registro["nombre"];
    setcookie("usuario", $registro["id_usuario"], time() + (604800)); // 3600 * 24 * 7 Una semana
    header("Location: inicio.php");
  }
}*/
