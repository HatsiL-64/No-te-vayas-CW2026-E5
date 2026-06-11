<?php
include 'conexion.php';

$id_grupo = '61B';
$id_alumno = '101010';

    function promedios_asistencias($conexion, $id_grupo)
    {
        $sql = "SELECT id_grupo, d_asistidos, d_total FROM asistencia WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query));{
            $asistidos =  $registro["d_asistidos"];
            $total = $registro["d_total"];
            $promedio_asis = ($asistidos + $total)/2;
            return $promedio_asis;
        }
        return 0;
    }

    echo "El promedio de asistencia es: " . promedios_asistencias($conexion, $id_grupo);


    function promedios_calificaciones($conexion, $id_alumno)
    {
        $suma_calificaciones = 0;
        $total_calificaciones = 0;

        $sql = "SELECT calificacion FROM calificaciones WHERE id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($resultado_query){
            while ($fila = mysqli_fetch_assoc($resultado_query)){
                $suma_calificaciones += (float)$fila['calificacion']; 
                $total_calificaciones++;
            }
        }
        if ($total_calificaciones > 0) {
            $promedios_calificaciones = $suma_calificaciones / $total_calificaciones;
            return $promedios_calificaciones;
        }

        
    }

    echo "El promedio de calificaciones es: " . promedios_calificaciones($conexion, $id_alumno);

?>