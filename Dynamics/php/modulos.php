<?php
    include 'layout.php';
    include 'config.php';
    session_start();
    if (isset($_GET['grupo']))
    {
        $id_grupo = $_GET['grupo'];
        $sql1 = "SELECT id_ete FROM grupos WHERE id_grupo = '$id_grupo'";
        $resultado = mysqli_query($conexion, $sql1);
        $fila= mysqli_fetch_assoc($resultado);
        $id_ete = $fila['id_ete'];
        $usuario = $_SESSION['usuario'];
        $sql2 = "SELECT tipo_usuario FROM usuarios WHERE id_usuario = '$usuario'";
        $resultado = mysqli_query($conexion, $sql2);
        $fila = mysqli_fetch_assoc($resultado);
        $tipo_usuario = $fila['tipo_usuario'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/style.css">

</head>
<body>
    <main id='main_modulos'>
        <h2 id="tit_mod">Módulos</h2>

        <div class="contenedor-boton">
            <a class="pag" href="listados.php?grupo=<?php echo $id_grupo?>">
                Ver listado de alumnos
            </a>
        </div>
        <?php
            if($id_ete == 'CM1' || $id_ete == 'CM2' || $id_ete == 1 && $tipo_usuario == 1)
            {
                echo "<a class='pag' href = 'cuestionario.php'> Cuestionario </a>";
            }
        ?>
        </div>
        <section class="contenedor_modulos">
            <article class="modulos_impar">
                <h3>
                    <a href="dentro-modulos.php?grupo=<?php echo $id_grupo?>">Módulo 1 </a>
                </h3>
                <p>Introducción a la computación</p>
            </article>
            <article class="modulos_par">
                <h3>Módulo 2</h3>
                <p>Sistemas operativos</p>
            </article>
            <article class="modulos_impar">
                <h3>Módulo 3</h3>
                <p>Aplicación de uso general</p>
            </article>
            <article class="modulos_par">
                <h3>Módulo 4</h3>
                <p>Solución de problemas y técnicas de programación</p>
            </article>
            <article class="modulos_impar">
                <h3>Módulo 5</h3>
                <p>Promagación estructuradaL</p>
            </article>
            <article class="modulos_par">
                <h3>Módulo 6</h3>
                <p>Programación orientada a eventos</p>
            </article>
            <article class="modulos_impar">
                <h3>Módulo 7</h3>
                <p>Análisis y diseño de sistemas</p>
            </article>
            <article class="modulos_par">
                <h3>Módulo 8</h3>
                <p>Programación orientada a base de datos</p>
            </article>
            <article class="modulos_impar">
                <h3>Módulo 9</h3>
                <p>Redes de área local</p>
            </article>
            <article class="modulos_par">
                <h3>Módulo 10</h3>
                <p>Mantenimiento preventivo y correctivo menor para computadoras personales</p>
            </article>
        </section>
    </main>                
</body>
</html>
<?php
    }
    else {
        header("Location: inicio.php");
    }
?>