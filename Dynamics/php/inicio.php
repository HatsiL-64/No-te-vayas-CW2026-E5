<?php
session_start();
if (!isset($_SESSION["usuario"]) || !isset($_COOKIE["usuario"])) {
    header("Location: ../../login.html");
}
include 'layout.php'
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Statics/styles/layout.css">

</head>

<body>
    <main class="contenido">
        <div id="Bienv">
            <h2>Bienvenid@ </h2>
        </div>

        <div id="mis_grupos">
            <h3>Mis grupos: </h3>
            <p><a href="modulos.php">Grupo 1</a></p>
        </div>
    </main>
</body>

</html>
