<?php
session_start();
$error = null;

if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["usuario"]))
{
  require 'conexion.php';
  $usuario_entrada = trim($_POST["usuario"]);
  $password = trim($_POST["password"]);
  $tipo_usuario = $_POST["tipo_usuario"];

  //Cambia el usuario segun el tipo de usuario
  if($tipo_usuario == "alumno"){
    $usuario = "1". $usuario_entrada;
  } 
  else if($tipo_usuario == "profesor"){
    $usuario = "2". $usuario_entrada;
  } 
  else{
    $usuario = "3". $usuario_entrada;
  }

  $sql = "SELECT nombre, id_usuario, tipo_usuario FROM usuarios WHERE id_usuario = '$usuario' AND password = '$password'";
  $resultado = mysqli_query($conexion, $sql);
  $registro = mysqli_fetch_assoc($resultado);

  if($registro)
  {
    $_SESSION['usuario'] = $registro["id_usuario"];
    $_SESSION['tipo_usuario'] = $registro["tipo_usuario"];
    $_SESSION['nombre'] = $registro["nombre"];
    setcookie("usuario", $registro["id_usuario"], time() + 604800); // 3600 * 24 * 7 Una semana
    header("Location: layout.php");
  }
  else 
  {
    $error = "Usuario no encontrado";
    header("Location: ../../Templates/login.html");
  }

}  /*
else {
  require 'conexion.php';
  if(isset($_COOKIE["usuario"]))
  {
    $usuario = $_COOKIE["usuario"];

    $sql = "SELECT nombre FROM usuarios WHERE id_usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_assoc($resultado);

    
    $_SESSION['usuario'] = $registro["id_usuario"];
    $_SESSION['tipo_usuario'] = $registro["tipo_usuario"];
    $_SESSION['nombre'] = $registro["nombre"];
    setcookie("usuario", $registro["id_usuario"], time() + (604800)); // 3600 * 24 * 7 Una semana
    header("Location: layout.php");
  }  
}*/
?>