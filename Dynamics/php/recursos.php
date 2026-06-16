<?php
    include 'layout.php';
    include 'config.php';
    session_start();

    $usuario = $_SESSION['usuario'];
    $sql1 = "SELECT tipo_usuario FROM usuarios WHERE id_usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql1);
    $fila = mysqli_fetch_assoc($resultado);
    $tipo_usuario = $fila['tipo_usuario'];

    if (isset($_GET['grupo']) && isset($_GET['modulo'])) {
        $id_grupo = $_GET['grupo'];
        $id_modulo =$_GET['modulo'];
    } else {
        $id_grupo = '61B'; 
        $id_modulo = 'CM1';
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/recursos.css">

</head>
<body>
    <main class="recursos">
        <h2>Recursos</h2>

        <section id="archivos">
            <h3>Archivos</h3>
            <div id="cuadro_arch">
                <?php
                    $sql_a = "SELECT * FROM recursos_$id_grupo WHERE id_modulo = '$id_modulo' AND tipo_recurso = 'a'";
                    $res_a = mysqli_query($conexion, $sql_a);

                    while ($fila = mysqli_fetch_assoc($res_a)) 
                    {
                        echo "<div class='cuadro_re'>
                        <h4>" . htmlspecialchars($fila['nombre']) . "</h4> <hr>
                        <p>" . htmlspecialchars($fila['descripcion']) . "</p>
                        <a href='" . $fila['ruta'] . "' target='_blank' class='btn-consultar'>Ver Archivo</a>
                        </div>";
                    }
                ?>
            </div>
        </section>
        <section id="ejercicios">
            <h3>Ejercicios</h3>
            <div id="cuadro_ejer">
                <?php
                    $sql_a = "SELECT * FROM recursos_$id_grupo WHERE id_modulo = '$id_modulo' AND tipo_recurso = 'e'";
                    $res_a = mysqli_query($conexion, $sql_a);
                    while ($fila = mysqli_fetch_assoc($res_a)) 
                    {
                        echo "<div class='cuadro_re'>
                        <h4>" . htmlspecialchars($fila['nombre']) . "</h4> <hr>
                        <p>" . htmlspecialchars($fila['descripcion']) . "</p>
                        <a href='" . $fila['ruta'] . "' target='_blank' class='btn-consultar'>Ver Ejercicio</a>
                        </div>";
                    }
                ?>
            </div>
        </section>

        <section id="enlaces">
            <h3>Enlaces</h3>
            <div id="cuadro_enl">
                <?php
                    $sql_a = "SELECT * FROM recursos_$id_grupo WHERE id_modulo = '$id_modulo' AND tipo_recurso = 'l'";
                    $res_a = mysqli_query($conexion, $sql_a);

                    while ($fila = mysqli_fetch_assoc($res_a)) 
                    {
                        echo "<div class='cuadro_re'>
                        <h4>" . htmlspecialchars($fila['nombre']) . "</h4> <hr>
                        <p>" . htmlspecialchars($fila['descripcion']) . "</p>
                        <a href='" . $fila['ruta'] . "' target='_blank' class='btn-consultar'>Consultar Enlace</a>
                        </div>";
                    }
                ?>
            </div>
        </section>

        <section id="scripts">
            <h3>Scripts</h3>
            <div id="cuadro_script">
                <?php
                    $sql_a = "SELECT * FROM recursos_$id_grupo WHERE id_modulo = '$id_modulo' AND tipo_recurso = 's'";
                    $res_a = mysqli_query($conexion, $sql_a);

                    while ($fila = mysqli_fetch_assoc($res_a)) 
                    {
                        echo "<div class='cuadro_re'>
                        <h4>" . htmlspecialchars($fila['nombre']) . "</h4> <hr>
                        <p>" . htmlspecialchars($fila['descripcion']) . "</p>
                        <a href='" . $fila['ruta'] . "' target='_blank' class='btn-consultar'>Ver Script</a>
                        </div>";
                    }
                    ?>
            </div>
        </section>
    </main>
</body>
</html>