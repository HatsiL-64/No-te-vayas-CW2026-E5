<?php
    include 'config.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        var_dump($_POST);
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
                echo "Cuestionario guardado";
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
            } else {
                echo "Hubo un error"; echo "Error en UPDATE: " . mysqli_error($conexion);
            }
        }
    }
?>