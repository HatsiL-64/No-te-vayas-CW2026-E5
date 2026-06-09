<?php
include 'config.php';
include 'layout.php';

$lista_alumnos = array();
$id_grupo = '61B';

    $sql = "SELECT usuarios.nombre, usuarios.apellido_p, usuarios.apellido_m
            FROM alumnos INNER JOIN usuarios ON alumnos.id_usuario = usuarios.id_usuario
            WHERE alumnos.id_grupo1 = '$id_grupo'";

    $resultado_query = mysqli_query($conexion, $sql);

    if ($resultado_query){
        while ($fila = mysqli_fetch_assoc($resultado_query)) {
            $lista_alumnos[] = $fila;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/No-te-vayas-CW2026-E5/Statics/styles/style.css">
</head>
<body>

    <div class="contenedor-listado">
        <h3 class="h3_listado">Listado de alumnos del <?php echo $id_grupo; ?></h3>
        <?php
        if (count($lista_alumnos) > 0) {
        foreach ($lista_alumnos as $alumno) {
            echo "<div class='tarjeta'>";
                echo "<h3 class='h3_listado'>";
                echo $alumno['nombre'] . " ";
                echo $alumno['apellido_p'] . " ";
                echo $alumno['apellido_m'];
                echo "</h3>";
            echo "</div>";
        }
    } else {
        echo "<div class='tarjeta'>";
        echo "<p>No se encontraron alumnos para este grupo.</p>";
        echo "</div>";

    }
        ?>
    </div>
</body>
</html>