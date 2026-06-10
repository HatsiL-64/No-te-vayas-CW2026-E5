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

  var_dump($registro);
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

<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../Statics\styles\login.css">
  <link rel="icon" href="data:,">
  <title>login</title>

</head>

<body>
  <nav class="encabezado">
    <div class="escudos">
      <img src="../../Statics/media/img/escudo-prepa.jpg" class="logo">
      <img src="../../Statics/media/img/logo_unam.png" class="logo">
    </div>
    <div class="usuario">
      <img src="../../Statics/media/img/logo-usuario.png" class="logo">
    </div>
  </nav>
  <div class="login">
    <div class="sesion">
      <h2>Bienvenid@</h2>
      <p>!!No te vayas<br>
        QuédETE!!</p>
      <form action="login.php" method="post">  
        <!--
        Se podria poner aqui un div que diga que no se encontro el alumno en caso de error
        <div class="alerta", role="alert">No se encontro el usuario</div>
        El problema es que requiere JS
        <script></script>
        -->
        <div>
          <input type="text" name="usuario" placeholder="Usuario" required>
        </div>
        <div>
          <input type="password" name="password" placeholder="Contraseña" required>
        </div>
        <div>
          <label><input type="radio" name="tipo_usuario" value="profesor"> Profesor</label>
          <label><input type="radio" name="tipo_usuario" value="alumno"> Alumno</label>
        </div>  
        <div>
          <input type="submit" value="Acceder">
        </div>
      </form>
    </div>
  </div>
</body>

</html>
