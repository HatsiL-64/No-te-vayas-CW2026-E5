<?php
include 'conexion.php';

$id_grupo = '61B';
$id_alumno = '101010';

    function asistencias_alumno($conexion, $id_alumno)
    {
        $sql = "SELECT asistencia.id_alumno, asistencia.d_asistidos, asistencia.d_total FROM asistencia WHERE asistencia.id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query));{
            $asistidos =  $registro["d_asistidos"];
            $total = $registro["d_total"];
            $promedio_alumno = ($asistidos / $total)*100;
            return $promedio_alumno;
        }
        return 0;
    }

    echo "El promedio de asistencia por alumno es: " . asistencias_alumno($conexion, $id_alumno);

    function asistencias_grupal($conexion, $id_grupo)
    {
        $sql = "SELECT asistencia.id_grupo, asistencia.d_total, AVG(asistencia.d_asistidos) FROM asistencia WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query));{
            $asistidos =  $registro["AVG(asistencia.d_asistidos)"];
            $total = $registro["d_total"];
            $promedio_grupo = ($asistidos / $total)*100;
            return $promedio_grupo;
        }
    }

    echo "El promedio de asistencia es: " . asistencias_grupal($conexion, $id_grupo);


    function calificaciones_alumnos($conexion, $id_alumno)
    {
        $suma_calificaciones = 0;
        $total_calificaciones = 0;
        $caliicacion_maxima = 10;

        $sql = "SELECT calificacion FROM calificaciones WHERE id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($resultado_query){
            while ($fila = mysqli_fetch_assoc($resultado_query)){
                $suma_calificaciones += (float)$fila['calificacion']; 
                $total_calificaciones++;
            }
        }
        if ($total_calificaciones > 0) {
            $promedio = ($suma_calificaciones / $total_calificaciones);
            /*$porcentaje = ($promedio / $caliicacion_maxima)*100;*/

            return $promedio;
        }
        
    }

    echo "El promedio de tus calificaciones es: " . calificaciones_alumnos($conexion, $id_alumno);

    
    function calificaciones_grupo ($conexion, $id_grupo)
    {
        $sql = "SELECT SUM(calificacion), COUNT(calificacion) FROM calificaciones WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);
        
        if ($registro = mysqli_fetch_assoc($resultado_query));{
            $suma_calificaciones =  $registro["SUM(calificacion)"];
            $total = $registro["COUNT(calificacion)"];
            $calificacion_grupo = ($suma_calificaciones / $total);
            return $calificacion_grupo;
        }
    }

    echo "El promedio por grupo de calificaciones es: " . calificaciones_grupo($conexion, $id_grupo);

?>