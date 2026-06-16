<?php
    session_start();
    include 'layout.php';
    include 'config.php';
    include 'validaciones.php';
    include 'procesar_cookies.php';
    if (!isset($_SESSION["tipo_usuario"])) {
        if(isset($_COOKIE["usuario"]))
            procesar_cookies();        
        else 
            header("Location: ../../login.html");
    }
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
            <?php    
                echo "<h2>Bienvenid@ " . $_SESSION['nombre'] ."</h2>";
            ?>
        </div>
        <?php
            if($_SESSION['tipo_usuario'] != 3){
        ?>        
                <div id="mis_grupos">
                    <?php
                        if ($tipo_usuario == 1){
                            // correccion: habia un espacio dentro de las comillas de $id_usuario que
                            // impedia que la consulta encontrara al alumno
                            $sql ="SELECT id_grupo1, id_grupo2, ete.nombre FROM alumnos INNER JOIN grupos
                                    On alumnos.id_grupo1 = grupos.id_grupo INNER JOIN ete
                                    On grupos.id_ete = ete.id_ete WHERE alumnos.id_usuario = '$id_usuario'";
                            $resultado = mysqli_query($conexion, $sql);

                            $alumno = mysqli_fetch_assoc($resultado);
                            if ($alumno){

                                $id_grupo1_encriptado = encriptar(crear_secuencia($alumno['id_grupo1']), $_SESSION['llave']); 
                                echo "<div class = 'tarjeta'>";
                                echo "<h3> Grupo:";
                                echo "<a class='pag' href='./modulos.php?grupo=" . $id_grupo1_encriptado . "'>" . $alumno['id_grupo1'] . "</a>";
                                echo"</h3>";
                                echo "<p>";
                                echo $alumno['nombre'];
                                echo "</p>";
                                echo"</div>";

                                if ($alumno['id_grupo2'] != NULL){
                                    $id_grupo2_encriptado = encriptar(crear_secuencia($alumno['id_grupo2']), $_SESSION['llave']);                                 
                                    echo "<div class='tarjeta'>";
                                    echo "<h3> Grupo:";
                                    echo "<a class='pag' href='./modulos.php?grupo=" . $id_grupo2_encriptado . "'>" . $alumno['id_grupo2'] . "</a>";
                                    echo"</h3>";
                                    echo "<p>";

                                    $sql = "SELECT ete.nombre FROM grupos INNER JOIN ete ON grupos.id_ete = ete.id_ete WHERE id_grupo = '". $alumno["id_grupo2"] ."';";
                                    $resultado = mysqli_query($conexion, $sql);
                                    $alumno = mysqli_fetch_assoc($resultado);
                                    
                                    echo $alumno['nombre'];
                                    echo "</p>";
                                    echo"</div>";

                                }
                            }
                        }
                        if ($tipo_usuario == 2){
                            $sql_profesor = "SELECT id_profesor FROM profesores WHERE id_usuario = '$id_usuario'";

                            $resultado_profesor = mysqli_query($conexion,  $sql_profesor);
                            $profesor = mysqli_fetch_assoc($resultado_profesor);

                            if ($profesor)
                            {
                                $id_profesor = $profesor['id_profesor'];
                                $sql_todos_grupos = "SELECT grupos.id_grupo, ete.nombre FROM grupos 
                                                    INNER JOIN ete ON grupos.id_ete = ete.id_ete";
                                $resultado_todos = mysqli_query($conexion, $sql_todos_grupos);
                                while ($grupo = mysqli_fetch_assoc($resultado_todos)) {
                                    $id_grupo_actual = $grupo['id_grupo'];
                                    $tabla_asignaturas = "asignaturas_" . $id_grupo_actual; 
                                    $sql_revisar = "SELECT COUNT(*) as total FROM $tabla_asignaturas WHERE id_profesor = '$id_profesor'";
                                    $resultado_revisar = mysqli_query($conexion, $sql_revisar);
                                    if ($resultado_revisar) {
                                        $fila_revisar = mysqli_fetch_assoc($resultado_revisar);
                                        if ($fila_revisar['total'] > 0) {
                                            // correccion: el link del grupo se mandaba sin encriptar pero
                                            // modulos.php siempre intenta desencriptarlo, produciendo un id basura
                                            $id_grupo_encriptado = encriptar(crear_secuencia($id_grupo_actual), $_SESSION['llave']);
                                            echo "<div class='tarjeta'>";
                                            echo "<h3>";
                                            echo "<a class='pag' href='modulos.php?grupo=" . $id_grupo_encriptado . "'>" . $id_grupo_actual . "</a>";
                                            echo "</h3>";
                                            echo "<p>" . $grupo['nombre'] . "</p>";
                                            echo "</div>";
                                        }
                                    }
                                }
                            }
                                /*$id_profesor = $profesor['id_profesor'];

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
                            }*/
                        }
                    ?>
                </div>
        <?php
            }
            else{
                //Consultas
                $sql = "SELECT grupos.id_grupo, ete.nombre FROM grupos INNER JOIN ete On grupos.id_ete = ete.id_ete;";
                $query = mysqli_query($conexion, $sql);
                //Vista
                echo "<div class= 'contenedor-boton'><a class='btn-enviar' href=\"./crear-usuario.php\">Crear usuario</a></div>";
                echo "<br>";
                echo "<div class= 'contenedor-boton'><a class='btn-enviar' href=\"./crear-grupo.php\">Crear grupo</a></div>";
                echo "<div id=\"mis_grupos\">";
                while ($grupo = mysqli_fetch_assoc($query)){
                    $nombre_grupo = substr($grupo['id_grupo'], 1);
                    $id_grupo_encriptado = encriptar(crear_secuencia($grupo['id_grupo']), $_SESSION['llave']); 
                    echo "<div class='tarjeta'>";
                    echo "<h3>";
                    echo "<a href='modulos.php?grupo=" . $id_grupo_encriptado . "'>" . $nombre_grupo . "</a>";
                    echo "</h3>";

                    echo "<p>";
                    echo $grupo['nombre'];
                    echo "</p>";
                    echo "</div>";
                }
                echo "</div>";
            }    
        ?>        
    </main>
</body>

</html>
