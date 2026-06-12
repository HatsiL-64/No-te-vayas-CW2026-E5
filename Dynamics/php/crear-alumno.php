<?php
session_start();
include 'codigo_errores.php';
if (!isset($_SESSION) || $_SESSION["tipo_usuario"] == 1) {
  header("Location: inicio.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewpport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../Statics/styles/crear.css">
  <title>Registrar alumno</title>
</head>

<body>
  <?php
  include 'layout.php'
  ?>
  <main class="contenido">
    <div id="nombre_seccion">
      <h2>Crear alumno</h2>
    </div>
    
    <?php
      if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["error"])){
        $numero_error = $_GET["error"];
        //if(codigo_error_valido($numero_error))
    ?>    
        <div class="notificacion_error">
          <h4>ERROR</h4>
    <?php
          echo $ERROR[$numero_error];
    ?>        
        </div>
    <?php
      }
    ?>

    <div id="formulario">
      <form method="post" action="func-crear-usuario.php">
        <input type="radio" name="nombre_formulario" value="alumno" required checked hidden>
        <div class="pregunta_formulario">
          <label>Numero de cuenta del alumno: </label><input type="text" name="identificador" required>
        </div>
        <div class="pregunta_formulario">
          <label>Nombre(s) del alumno: </label><input type="text" name="nombre" required>
        </div>
        <div class="pregunta_formulario">
          <label>Apellido paterno del alumno: </label><input type="text" name="apellido_pat" required>
        </div>
        <div class="pregunta_formulario">
          <label>Apellido materno del alumno: </label><input type="text" name="apellido_mat" required>
        </div>
        <div class="pregunta_formulario">
          <label>Fecha de nacimiento<input type="text" name="fecha_nacimiento" placeholder="DD/MM/YYYY" required></label>
        </div>
        <div class="pregunta_formulario">
          <label>Grupo: <input type="text" name="grupo" required></label>
        </div>
        <div class="pregunta_formulario">
          <label>Plantel: <input type="text" name="plantel" required></label>
        </div>
        <input type="submit" value="Registrar alumno">
      </form>
    </div>
  </main>
</body>

</html>
