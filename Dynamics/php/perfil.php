<?php
session_start();
    include 'layout.php';
    include 'estadisticas.php';
    include_once 'config.php';
    include 'procesar_cookies.php';
    include 'riesgo.php';
    if (!isset($_SESSION["tipo_usuario"])) {
        if(isset($_COOKIE["usuario"]))
            procesar_cookies();        
        else 
            header("Location: ../../login.html");
    }
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
        $id_grupo1 = $alumno['id_grupo1'];
        if($tipo_usuario == 2 || $tipo_usuario == 3){
            $porcentaje_riesgo = calc_riesgo($conexion, $id_alumno, $id_grupo1);
            echo "<div class='fila-riesgo'>";
            echo "<div id='riesgo'> <h3> Riesgo Deserción </h3> </div>";
            if ($porcentaje_riesgo >= 75) {
                echo "<div class='riesgo card-rojo'> <h2>$id_grupo1: $porcentaje_riesgo%</h2></div>";
            } 
            elseif ($porcentaje_riesgo >= 40 && $porcentaje_riesgo < 75) {
                echo "<div class='riesgo card-naranja'> <h2>$id_grupo1: $porcentaje_riesgo%</h2></div>";
            } 
            else {
                echo "<div class='riesgo card-azul'> <h2>$id_grupo1: $porcentaje_riesgo%</h2></div>";
            }

            if ($alumno['id_grupo2'] != NULL){
                $id_grupo2 = $alumno['id_grupo2'];
                $porcentaje_riesgo = calc_riesgo($conexion, $id_alumno, $id_grupo2);
                if ($porcentaje_riesgo >= 75) {
                    echo "<div class='riesgo card-rojo'> <h2>$id_grupo2: $porcentaje_riesgo%</h2></div>";
                } 
                elseif ($porcentaje_riesgo >= 40 && $porcentaje_riesgo < 75) {
                    echo "<div class='riesgo card-naranja'> <h2>$id_grupo2: $porcentaje_riesgo%</h2></div>";
                } 
                else {
                    echo "<div class='riesgo card-azul'> <h2>$id_grupo2: $porcentaje_riesgo%</h2></div>";
                }
            }
            echo "</div>";
        }


        $sql4 = "SELECT id_ete FROM grupos WHERE id_grupo = '$id_grupo1'";
        $resultado4 = mysqli_query($conexion, $sql4);
        $fila4 = mysqli_fetch_assoc($resultado4);
        $id_ete = $fila4['id_ete']; 
        if($id_ete == 'CM1' ||$id_ete == 'CM2' || $id_ete == 1){
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
            $sql5 = "SELECT prom_he, prom_t, prom_aa, prom_ec, prom_mye FROM alumnos WHERE id_alumno = $id_alumno";
            $resultado5 = mysqli_query($conexion, $sql5);
            $fila5 = mysqli_fetch_assoc($resultado5);
            $promedio_he = $fila5['prom_he'];
            $promedio_t = $fila5['prom_t'];
            $promedio_mye = $fila5['prom_mye'];
            $promedio_aa = $fila5['prom_aa'];
            $promedio_ec = $fila5['prom_ec'];
        ?>
        <div class="datos">
            <div class = "contenedor">
            <div id="cuestionario">
                <h2>Cuestionario</h2>
            </div>

            <div>
                <h3> - Estilo de aprendizaje: <?php echo $ea?></h3>
                <p><?php echo $mensaje_ea ?></p>
                <h3>- Promedio hábitos de estudio: <?php echo $promedio_he ?>/3</h3>
                <h3>- Promedio tiempo disponible: <?php echo $promedio_t ?>/3 </h3>
                <h3>- Promedio motivación y entorno: <?php echo $promedio_mye ?>/3 </h3>
                <h3>- Promedio análisis y abstracción: <?php echo $promedio_aa ?>/3 </h3>
                <h3>- Promedio equipo de cómputo: <?php echo $promedio_ec?>/3</h3>
            </div>
            </div>
            <?php 
            }
            $promedio_asis_g1 = asistencias_alumno2($conexion, $id_alumno, $alumno['id_grupo1']);
            $promedio_caif_g1 = calificaciones_alumnos($conexion, $id_alumno, $alumno['id_grupo1']);
            if ($alumno['id_grupo2'] != NULL){
                $promedio_asis_g2 = asistencias_alumno2($conexion, $id_alumno, $alumno['id_grupo2']);
                $promedio_caif_g2 = calificaciones_alumnos($conexion, $id_alumno, $alumno['id_grupo2']);
            }
        ?>
            <div class = "contenedor">
            <div id="estadisticas">
                <h2> Estadísticas </h2>
            </div>
            <div>
                <h3> - Asistencias <?php echo $alumno['id_grupo1'] . ": " . $promedio_asis_g1?> % </h3>
                <h3> - Calificaciones <?php echo $alumno['id_grupo1'] . ": " . $promedio_caif_g1?> </h3>
                <?php
                    if ($alumno['id_grupo2'] != NULL){
                        // correccion: se usaba $promedio_asis_g1 (grupo 1) en lugar de $promedio_asis_g2 (grupo 2)
                        // correccion: faltaban las etiquetas de cierre </h3>
                        echo "<h3>- Asistencias " . $alumno['id_grupo2'] . ": " . $promedio_asis_g2 . " %</h3>";
                        echo "<h3>- Calificaciones " . $alumno['id_grupo2'] . ": " . $promedio_caif_g2 . "</h3>";
                    }
                ?>
            </div>
            </div>
        </div>
    </main>
</body>
</html>