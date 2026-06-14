<?php
include 'conexion.php';

$id_grupo = '61B';
$id_alumno = '101010';
$id_modulo = 'Programación estructurada';

    function asistencias_alumno($conexion, $id_alumno)
    {
        $sql = "SELECT asistencia.id_alumno, asistencia.d_asistidos, asistencia.d_total FROM asistencia WHERE asistencia.id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            $asistidos =  $registro["d_asistidos"];
            $total = $registro["d_total"];
            $promedio_alumno = ($asistidos / $total)*100;
            return $promedio_alumno;
        }
        return 0;
    }
    echo "El promedio de asistencia por alumno es: " . asistencias_alumno($conexion, $id_alumno); echo "<p>";

    function asistencias_grupal($conexion, $id_grupo)
    {
        $sql = "SELECT asistencia.id_grupo, asistencia.d_total, AVG(asistencia.d_asistidos) FROM asistencia WHERE id_grupo = '$id_grupo' AND id_modulo = '$id_modulo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query));{
            $asistidos =  $registro["AVG(asistencia.d_asistidos)"];
            $total = $registro["d_total"];
            $promedio_grupo = ($asistidos / $total)*100;
            return $promedio_grupo;
        }
        return 0;
    }
    echo "El promedio de asistencia  por modulo es: " . asistencias_grupal($conexion, $id_grupo); echo "<p>";


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
    echo "El promedio de tus calificaciones es: " . calificaciones_alumnos($conexion, $id_alumno); echo "<p>";
    
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
        return 0;
    }
    echo "El promedio por grupo de calificaciones es: " . calificaciones_grupo($conexion, $id_grupo);  echo "<p>";

    function cuesti_usuario_p1($conexion, $id_alumno)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 11; $i++) 
            $columnas[] = "he_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 11; $i++)
                $respuestas[] = $registro["he_" . $i];

            $promedio_he = round(array_sum($respuestas)/11);
            return $promedio_he;
        }
        return 0;
    }
    echo "El promedio de las preguntas he es: " . cuesti_usuario_p1($conexion, $id_alumno);  echo "<p>";

    function cuesti_grupo_p1($conexion, $id_grupo)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 11; $i++) 
            $columnas[] = "ROUND(AVG(he_$i)) AS he_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 11; $i++)
                $respuestas[] = $registro["he_" . $i];

            $promedio_he = round(array_sum($respuestas)/11);
            return $promedio_he;
        }
        return 0;
    }
    echo "El promedio de la pregunta he por grupo es: " . cuesti_grupo_p1($conexion, $id_grupo);  echo "<p>";

    function cuesti_usuario_p2($conexion, $id_alumno)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 6; $i++) 
            $columnas[] = "t_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 6; $i++)
                $respuestas[] = $registro["t_" . $i];

            $promedio_t_ = round(array_sum($respuestas)/6);
            return $promedio_t_ ;
        }
        return 0;
    }
    echo "El promedio de la segunda pregunta t es: " . cuesti_usuario_p2($conexion, $id_alumno);  echo "<p>";

    function cuesti_grupo_p2($conexion, $id_grupo)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 6; $i++) 
            $columnas[] = "ROUND(AVG(t_$i)) AS t_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 6; $i++)
                $respuestas[] = $registro["t_" . $i];

            $promedio_t_ = round(array_sum($respuestas)/6);
            return $promedio_t_;
        }
        return 0;
    }
    echo "El promedio de la segunda pregunta por grupo t es: " . cuesti_grupo_p2($conexion, $id_grupo);  echo "<p>";

    function cuesti_alumno_p3($conexion, $id_alumno)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 4; $i++) 
            $columnas[] = "mye_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 4; $i++)
                $respuestas[] = $registro["mye_" . $i];

            $promedio_mye = round(array_sum($respuestas)/4);
            return $promedio_mye;
        }
        return 0;
    }
    echo "El promedio de la segunda pregunta mye es: " . cuesti_alumno_p3($conexion, $id_alumno);  echo "<p>";

    function cuesti_grupo_p3($conexion, $id_grupo)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 4; $i++) 
            $columnas[] = "ROUND(AVG(mye_$i)) AS mye_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 4; $i++)
                $respuestas[] = $registro["mye_" . $i];

            $promedio_mye = round(array_sum($respuestas)/4);
            return $promedio_mye;
        }
        return 0;
    }
    echo "El promedio de la segunda pregunta por grupo mye es: " . cuesti_grupo_p3($conexion, $id_grupo);  echo "<p>";

    function cuesti_alumno_p4($conexion, $id_alumno)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 2; $i++) 
            $columnas[] = "aa_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 2; $i++)
                $respuestas[] = $registro["aa_" . $i];

            $promedio_aa = round(array_sum($respuestas)/2);
            return $promedio_aa;
        }
        return 0;
    }
    echo "El promedio de la 4° pregunta aa es: " . cuesti_alumno_p4($conexion, $id_alumno);  echo "<p>";

    function cuesti_grupo_p4($conexion, $id_grupo)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 2; $i++) 
            $columnas[] = "ROUND(AVG(aa_$i)) AS aa_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 2; $i++)
                $respuestas[] = $registro["aa_" . $i];

            $promedio_aa = round(array_sum($respuestas)/2);
            return $promedio_aa;
        }
        return 0;
    }
    echo "El promedio de la 4° pregunta aa por grupo es: " . cuesti_grupo_p4($conexion, $id_grupo);  echo "<p>";

    function cuesti_alumno_p5($conexion, $id_alumno)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 2; $i++) 
            $columnas[] = "ec_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_alumno = '$id_alumno'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 2; $i++)
                $respuestas[] = $registro["ec_" . $i];

            $promedio_ec = round(array_sum($respuestas)/2);
            return $promedio_ec;
        }
        return 0;
    }
    echo "El promedio de la 5° pregunta ec es: " . cuesti_alumno_p5($conexion, $id_alumno);  echo "<p>";

    function cuesti_grupo_p5($conexion, $id_grupo)
    {
        $columnas = [];
        $respuestas = [];

        for ($i = 1; $i <= 2; $i++) 
            $columnas[] = "ROUND(AVG(ec_$i)) AS ec_$i";
    
        $lista_columnas = implode(", ", $columnas);
        $sql = "SELECT $lista_columnas FROM cuestionario WHERE id_grupo = '$id_grupo'";
        $resultado_query = mysqli_query($conexion, $sql);

        if ($registro = mysqli_fetch_assoc($resultado_query)){
            for ($i = 1; $i <= 2; $i++)
                $respuestas[] = $registro["ec_" . $i];

            $promedio_ec = round(array_sum($respuestas)/2);
            return $promedio_ec;
        }
        return 0;
    }
    echo "El promedio de la 5° pregunta ec por grupo es: " . cuesti_grupo_p5($conexion, $id_grupo);  echo "<p>";

?>