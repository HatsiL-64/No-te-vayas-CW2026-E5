<?php
    session_start();
    if (!isset($_SESSION) || !isset($_COOKIE)) {
        header("Location: ../../login.html");
    }
    include 'layout.php';
    include 'config.php';
    $id_usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Statics/styles/layout.css">

</head>

<body>
    <main class="contenido">
        <div id="Bienv">
            <h2>Bienvenid@ </h2>
        </div>

        <div id="mis_grupos">
            <?php
                if ($tipo_usuario == 'A'){
                    $sql ="SELECT id_grupo1, id_grupo2, ete.nombre FROM alumnos INNER JOIN grupos
                            On alumnos.id_grupo1 = grupos.id_grupo INNER JOIN ete 
                            On grupos.id_ete = ete.id_ete WHERE alumnos.id_usuario = '$id_usuario '";
                    $resultado = mysqli_query($conexion, $sql);

                    $alumno = mysqli_fetch_assoc($resultado);
                    if ($alumno){
                        echo "<div class = 'tarjeta'>";
                        echo "<h3> Grupo:";
                        echo $alumno['id_grupo1'];
                        echo"</h3>";
                        echo "<p>";
                        echo $alumno['nombre'];
                        echo "</p>";
                        echo"</div>";

                        if ($alumno['id_grupo2'] != NULL){
                            echo "<div class='tarjeta'>";
                            echo "<h3> Grupo:";
                            echo $alumno['id_grupo2'];
                            echo"</h3>";
                            echo "<p>";
                            echo $alumno['nombre'];
                            echo "</p>";
                            echo"</div>";

                        }
                    }
                }
                if ($tipo_usuario == 'p'){
                    $sql_profesor = "SELECT id_profesor FROM profesor WHERE id_usuario = '$id_usuario'";

                    $resultado_profesor = mysqli_query($conexion,  $sql_profesor);
                    $profesor = mysqli_fetch_assoc($resultado_profesor);

                    if ($profesor){
                        $id_profesor = $profesor['id_profesor'];

                        $sql_grupos = "SELECT grupos.id_grupo, ete.nombre FROM grupos 
                                        INNER JOIN ete On grupos.id_ete = ete.id_ete
                                        WHERE grupos.id_profesor = '$id_profesor'";

                        $resultado_grupos = mysqli_query($conexion, $sql_grupos);

                        while ($grupo = mysqli_fetch_assoc($resultado_grupos)) {

                        echo "<div class='tarjeta'>";
                        echo "<h3>";
                        echo $grupo['id_grupo'];
                        echo "</h3>";

                        echo "<p>";
                        echo $grupo['nombre'];
                        echo "</p>";
                        echo "</div>";
                        }
                    }
                }
            ?>
        </div>
    </main>
</body>

</html>
