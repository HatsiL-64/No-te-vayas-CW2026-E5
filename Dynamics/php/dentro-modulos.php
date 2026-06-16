<?php
session_start();
include 'layout.php';
include 'validaciones.php';
if(!isset($_SESSION["usuario"])){
    header("inicio.php");
    exit();
}
if (isset($_GET['grupo']))
{
    $grupo_get = $_GET["grupo"];
    $id_grupo = deshacer_secuencia(desencriptar($grupo_get, $_SESSION["llave"]));
}
if (isset($_GET['modulo']))
{    
    $id_modulo = $_GET['modulo'];
}
else 
{
    header("Location: inicio.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/style.css">

</head>
<body>
    <main>
        <h2>Módulo 1</h2>
        <section class="contenedor-modulos">
            <article class="cuadro">
                <h3>
                <a href="recursos.php?grupo=<?php echo $id_grupo?>&modulo=<?php echo $id_modulo?>">Recursos</a>
                </h3>
            </article>
            <article class="cuadro">
                <h3>
                    <a href="tareas.php?grupo=<?php echo $id_grupo?>&modulo=<?php echo $id_modulo?>">Actividades/tareas</a>
                </h3>
            </article>
            <article class="cuadro">
                <h3>
                    <a href="asistencia.php?grupo=<?php echo $id_grupo?>&modulo=<?php echo $id_modulo?>">Asistencia</a>
                </h3>
            </article>
        </section>
    </main>
</body>