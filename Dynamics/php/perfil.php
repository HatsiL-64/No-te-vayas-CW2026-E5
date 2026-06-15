<?php
include 'layout.php';
include 'estadisticas.php';
include_once 'config.php';
session_start();
    $usuario = $_SESSION['usuario'];
    $sql1 = "SELECT tipo_usuario FROM usuarios WHERE id_usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql1);
    $fila = mysqli_fetch_assoc($resultado);
    $tipo_usuario = $fila['tipo_usuario'];  

    if($tipo_usuario == 2 || $tipo_usuario == 3){
        $id_alumno = $_GET['id_alumno'];}
    else
    {
        $sql2 = "SELECT id_alumno FROM alumnos WHERE id_usuario = $usuario";
        $resultado2 = mysqli_query($conexion, $sql2);
        $fila2 = mysqli_fetch_assoc($resultado2);
        $id_alumno = $fila2['id_alumno']; 
    }

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
        <?php
            $sql3 = "SELECT ea FROM cuestionario WHERE id_alumno = $id_alumno";
            $resultado3 = mysqli_query($conexion, $sql3);
            $fila3 = mysqli_fetch_assoc($resultado3);
            if(!$fila3)
                {$mensaje_ea = 'NO HAS CONTESTADO EL CUESTIONARIO'; $ea = ' ';}
            else{
            $ea = $fila3['ea']; 
            if($ea == 'V'){ 
                $ea = "Visual-Audiovisual";
                $mensaje_ea = "Tu estilo de aprendizaje es Visual-Audiovisual, puedes buscar video o imágenes en la sección de recursos o buscarlos en internet";
            }
            if($ea == 'T' ){
                $ea = "Teórico-Lectura";
                $mensaje_ea = "Tu estilo de aprendizaje es Teórico-Lectura, puedes buscar pdf, textos, documentación en la sección de recursos o internet";
            }
            if($ea == 'P'){
                $ea = 'Práctico';
                $ea = "Tu estilo de aprendizaje es Práctico, puedes buscar ejercicios en la sección de recursos, buscarlos en internet o pedirle alguno a tu docente";
            }
            }

            $promedio_he = cuesti_usuario_p1($conexion, $id_alumno);
            $promedio_t = cuesti_usuario_p2($conexion, $id_alumno);
            $promedio_mye = cuesti_alumno_p3($conexion, $id_alumno);
            $promedio_aa = cuesti_alumno_p4($conexion, $id_alumno);
            $promedio_ec = cuesti_alumno_p5($conexion, $id_alumno);

            $promedio_asis_g1 = asistencias_alumno($conexion, $id_alumno, $alumno['id_grupo1']);
            $promedio_caif_g1 = calificaciones_alumnos($conexion, $id_alumno, $alumno['id_grupo1']);
            if ($alumno['id_grupo2'] != NULL){
                $promedio_asis_g2 = asistencias_alumno($conexion, $id_alumno, $alumno['id_grupo2']);
                $promedio_caif_g2 = calificaciones_alumnos($conexion, $id_alumno, $alumno['id_grupo2']);
            }
        ?>
        <div class="datos">
            <div class = "contenedor">
            <div id="cuestionario">
                <h2>Cuestionario</h2>
            </div>

            <div>
                <h3> - Estilo de aprendizaje: <?php echo $ea?></h3>
                <p><?php echo $mensaje_ea ?></p>
                <h3>- Promedio hábitos de estudio: <?php echo $promedio_he ?></h3>
                <h3>- Promedio tiempo disponible: <?php echo $promedio_t ?> </h3>
                <h3>- Promedio motivación y entorno: <?php echo $promedio_mye ?> </h3>
                <h3>- Promedio análisis y abstracción: <?php echo $promedio_aa ?> </h3>
                <h3>- Promedio equipo de cómputo: <?php echo $promedio_ec?></h3>
            </div>
            </div>
            <div class = "contenedor">
            <div id="estadisticas">
                <h2> Estadísticas </h2>
            </div>
            <div>
                <h3> - Asistencias <?php echo $alumno['id_grupo1'] . ": " . $promedio_asis_g1?> </h3>
                <h3> - Calificaciones <?php echo $alumno['id_grupo1'] . ": " . $promedio_caif_g1?> </h3>
                <?php
                    if ($alumno['id_grupo2'] != NULL){
                        echo "<h3>- Asistencias " . $alumno['id_grupo2'] . ": " . $promedio_asis_g1;
                        echo "<h3>- Calificaciones" . $alumno['id_grupo2'] . ": " . $promedio_caif_g2;
                    }
                ?>
            </div>
            </div>
        </div>
    </main>
</body>
</html>