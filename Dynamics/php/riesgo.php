<?php
    include_once 'config.php';
    include_once 'estadisticas.php';

    function calc_riesgo($conexion, $id_alumno, $id_grupo)
    {

        $sql1 = "SELECT prom_he, prom_t, prom_aa, prom_ec, prom_mye FROM alumnos WHERE id_alumno = $id_alumno";
        $resultado1 = mysqli_query($conexion, $sql1);
        $fila1 = mysqli_fetch_assoc($resultado1);
        $promedio_he = $fila1['prom_he'];
        $promedio_t = $fila1['prom_t'];
        $promedio_mye = $fila1['prom_mye'];
        $promedio_aa = $fila1['prom_aa'];
        $promedio_ec = $fila1['prom_ec'];
        $promedio_cal = calificaciones_alumnos($conexion, $id_alumno, $id_grupo);
        $promedio_asis = asistencias_alumno2($conexion, $id_alumno, $id_grupo);

        // Calcula riego del 0 a 1 
        $r_asistencia   = 1 - ($promedio_asis / 100);
        $r_calificacion = 1 - ($promedio_cal / 10);

        $sql2 = "SELECT id_ete FROM grupos WHERE id_grupo = '$id_grupo'";
        $resultado2 = mysqli_query($conexion, $sql2);
        $fila2 = mysqli_fetch_assoc($resultado2);
        $id_ete = $fila2['id_ete'];
        // correccion: el segundo operando usaba asignacion (=) en lugar de comparacion (==)
        if($id_ete == 'CM1' || $id_ete == 'CM2' || $id_ete == 1)
        {
            //Calcula riesgo, donde 1 es malo
            $r_habitos    = (3 - $promedio_he) / 2;
            $r_tiempo     = (3 - $promedio_t) / 2;
            $r_analisis   = (3 - $promedio_aa) / 2;
            $r_equipo     = (3 - $promedio_ec) / 2;
            $r_motivacion = (3 - $promedio_mye) / 2;
            
            $riesgo_decimal = ($r_habitos * 0.075) +       // 7.5% Hábitos de estudio
                ($r_tiempo * 0.075) +        // 7.5% Tiempo disponible
                ($r_equipo * 0.15) +         // 15% Equipo de Cómputo 
                ($r_analisis * 0.15) +       // 15% Análisis y Abstracción 
                ($r_motivacion * 0.10) +     // 10% Motivación y Entorno
                ($r_asistencia * 0.20) +     // 20% Porcentaje de Asistencias
                ($r_calificacion * 0.25);    // 25% Calificaciones
        }
        else{
            // correccion: la variable se llamaba $riesgo_final_decimal pero abajo se leia $riesgo_decimal
            $riesgo_decimal = ($r_asistencia * 0.50) + ($r_calificacion * 0.50);
        }
        $porcentaje_riesgo = round($riesgo_decimal * 100);

        return $porcentaje_riesgo;
    }
    // linea de prueba eliminada: echo calc_riesgo($conexion, 131313, '61D');
?>