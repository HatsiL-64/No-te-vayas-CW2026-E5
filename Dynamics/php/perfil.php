<?php
include 'config.php';
include 'layout.php';

$id_alumno = $_GET['id_alumno'];

$sql = "SELECT alumnos.id_alumno, alumnos.id_grupo1, alumnos.id_grupo2, usuarios.nombre, usuarios.apellido_p, usuarios.apellido_m,
        usuarios.correo FROM alumnos INNER JOIN usuarios ON alumnos.id_usuario = usuarios.id_usuario WHERE alumnos.id_alumno = $id_alumno";

$resultado_query = mysqli_query($conexion, $sql);

$alumno = mysqli_fetch_assoc($resultado_query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/perfil.css">
    <title>Perfil</title>
</head>
<body>
    <main>
        <div class="cuadro_alumno">
            <h2>
                <?php
                echo $alumno['nombre'] . " ";
                echo $alumno['apellido_p'] . " ";
                echo $alumno['apellido_m'];
                ?>
            </h2>
        </div>
        <div>
            <h3>
                Correo:
                <?php echo $alumno['correo']; ?>
            </h3>
            <h3>
                Nombre:
                <?php
                echo $alumno['nombre'] . " ";
                echo $alumno['apellido_p'] . " ";
                echo $alumno['apellido_m'];
                ?>
            </h3>
            <h3>
                Número de cuenta: <?php echo $alumno['id_alumno']; ?>
            </h3>
            <h3>
                Grupo:
                <?php
                echo $alumno['id_grupo1'];
                if ($alumno['id_grupo2'] != NULL) {
                    echo $alumno['id_grupo2'];
                }
                ?>
            </h3>
        </div>

        <div class="cuestionario">
            <h2>Cuestionario</h2>
        </div>

        <div>
            <h3>Estilo de aprendizaje</h3>
            <h3>Hábitos de estudio X/X</h3>
            <h3>Tiempo disponible X/X</h3>
            <h3>Equipo de cómputo X/X</h3>
        </div>

    </main>
</body>
</html>