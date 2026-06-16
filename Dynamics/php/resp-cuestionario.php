<?php
    include 'layout.php';
    include 'estadisticas.php';
    include_once 'config.php';
    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $id_alumno = $_POST["id_alumno"];
        $id_grupo = $_POST["id_grupo"];
        $ea = $_POST["ea"];
        $he_1 = $_POST["he_1"];
        $he_2 = $_POST["he_2"];
        $he_3 = $_POST["he_3"];
        $he_4 = $_POST["he_4"];
        $he_5 = $_POST["he_5"];
        $he_6 = $_POST["he_6"];
        $he_7 = $_POST["he_7"];
        $he_8 = $_POST["he_8"];
        $he_9 = $_POST["he_9"];
        $he_10 = $_POST["he_10"];
        $he_11 = $_POST["he_11"];
        $t_1 = $_POST["t_1"];
        $t_2 = $_POST["t_2"];
        $t_3 = $_POST["t_3"];
        $t_4 = $_POST["t_4"];
        $t_5 = $_POST["t_5"];
        $t_6 = $_POST["t_6"];
        $aa_1 = $_POST["aa_1"];
        $aa_2 = $_POST["aa_2"];
        $ec_1 = $_POST["ec_1"];
        $ec_2 = $_POST["ec_2"];
        $mye_1 = $_POST["mye_1"];
        $mye_2 = $_POST["mye_2"];
        $mye_3 = $_POST["mye_3"];
        $mye_4 = $_POST["mye_4"];
        $comentario = $_POST["comentario"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/cuestionario.css">
</head>
<body>
    <main class="contenido">
<?php
        $sql = "SELECT id_alumno FROM cuestionario WHERE id_alumno = $id_alumno";
        $resultado = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($resultado) > 0)
        {
            $sql2 = "UPDATE cuestionario SET ea = '$ea', he_1 = $he_1, he_2 = $he_2, he_3 = $he_3, he_4 = $he_4, he_5 = $he_5, he_6 = $he_6, he_7 = $he_7, he_8 = $he_8, he_9 = $he_9, he_10 = $he_10, he_11 = $he_11,
            t_1 = $t_1, t_2 = $t_2, t_3 = $t_3, t_4 = $t_4, t_5 = $t_5, t_6 = $t_6, aa_1 = $aa_1, aa_2 = $aa_2, ec_1 = $ec_1, mye_1 = $mye_1, mye_2 = $mye_2, mye_3 = $mye_3, mye_4 = $mye_4, comentario = '$comentario', ec_2 = $ec_2 
            WHERE id_alumno = $id_alumno";

            $ejecutar = mysqli_query($conexion, $sql2);
            if($ejecutar)
            {
?>
            <div id="cat_par">
                <p>Cuestionario actualizado</p>
                <a href="inicio.php">Inicio</a>
                <a href="cuestionario.php">Volver a Contestar</a>
<?php
            } else {
                echo "Hubo un error"; echo "Error en UPDATE: " . mysqli_error($conexion);
            }
        }
        else{
            $sql3 = "INSERT cuestionario(id_alumno, id_grupo, ea, he_1, he_2, he_3, he_4, he_5, he_6, he_7, he_8, he_9, he_10, he_11, t_1, t_2, t_3, t_4, t_5, t_6, aa_1, aa_2, ec_1, mye_1, mye_2, mye_3, mye_4, comentario, ec_2)
                    VALUES($id_alumno, '$id_grupo', '$ea', $he_1, $he_2, $he_3, $he_4, $he_5, $he_6, $he_7, $he_8, $he_9, $he_10, $he_11, $t_1, $t_2, $t_3, $t_4, $t_5, $t_6, $aa_1, $aa_2, $ec_1, $mye_1, $mye_2, $mye_3, $mye_4, '$comentario', $ec_2)";
            $ejecutar = mysqli_query($conexion, $sql3);
            if($ejecutar)
            {
                echo "Cuestionario guardado";
?>
            <div id="cat_par">
                <p>Cuestionario guardado</p>
                <a href="inicio.php">Inicio</a>
                <a href="cuestionario.php">Volver a Contestar</a>
<?php
            } else {
                echo "Hubo un error"; echo "Error en UPDATE: " . mysqli_error($conexion);
            }
        }
        $promedio_he = cuesti_usuario_p1($conexion, $id_alumno);
        $promedio_t = cuesti_usuario_p2($conexion, $id_alumno);
        $promedio_mye = cuesti_alumno_p3($conexion, $id_alumno);
        $promedio_aa = cuesti_alumno_p4($conexion, $id_alumno);
        $promedio_ec = cuesti_alumno_p5($conexion, $id_alumno);
        $sql4 = "UPDATE alumnos SET prom_he  = $promedio_he, prom_t   = $promedio_t, prom_aa  = $promedio_aa, prom_ec  = $promedio_ec, prom_mye = $promedio_mye 
        WHERE id_alumno = $id_alumno";
        $resultado4 = mysqli_query($conexion, $sql4) or die("Error en el query: " . mysqli_error($conexion));
        if(!$resultado4){
            echo "ERROR"; 
        }
    
        }
    else{
        header("Location: inicio.php");
    }
?>