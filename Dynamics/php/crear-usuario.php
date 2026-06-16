<?php
session_start();
if ($_SESSION["tipo_usuario"] != 3) {
  header("Location: inicio.php");
  exit();
}
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  if ($_POST["tipo_usuario"] == "alumno") {
    header("Location: crear-alumno.php");
  } else {
    header("Location: crear-profesor.php");
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewpport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../Statics/styles/crear.css">
  <title>Registrar usuario</title>
</head>

<body>
  <?php
  include 'layout.php'
  ?>
  <main class="contenido">
    <div id="nombre-seccion">
      <h2>Crear usuario</h2>
    </div>

    <div id="formulario">
      <form method="post" action="crear-usuario.php">
        <div class="pregunta_formulario">
          <p>Tipo de usuario:</p>
          <input type="radio" name="tipo_usuario" value="alumno" required><label>Alumno</label>
          <input type="radio" name="tipo_usuario" value="profesor" required><label>Profesor</label>
        </div>
        <div class="contenedor-boton">
          <input class="btn-enviar" type="submit" value="tipo_usuario">
        </div>
      </form>
    </div>
  </main>
</body>

</html>
