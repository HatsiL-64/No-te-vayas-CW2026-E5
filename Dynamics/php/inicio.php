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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            $sql ="SELECT id_grupo1, id_grupo2, ete.nombre FROM alumnos INNER JOIN grupos
                                    On alumnos.id_grupo1 = grupos.id_grupo INNER JOIN ete
                                    On grupos.id_ete = ete.id_ete WHERE alumnos.id_usuario = '$id_usuario'";
                            $resultado = mysqli_query($conexion, $sql);

                            $alumno = mysqli_fetch_assoc($resultado);
                            if ($alumno){

                                $id_grupo1 = $alumno['id_grupo1']; 
                                echo "<div class = 'tarjeta'>";
                                echo "<h3> Grupo:";
                                echo "<a class='pag' href='./modulos.php?grupo=" . $id_grupo1 . "'>" . $alumno['id_grupo1'] . "</a>";
                                echo"</h3>";
                                echo "<p>";
                                echo $alumno['nombre'];
                                echo "</p>";
                                echo"</div>";

                                if ($alumno['id_grupo2'] != NULL){
                                    $id_grupo2 = $alumno['id_grupo2'];                                 
                                    echo "<div class='tarjeta'>";
                                    echo "<h3> Grupo:";
                                    echo "<a class='pag' href='./modulos.php?grupo=" . $id_grupo2 . "'>" . $alumno['id_grupo2'] . "</a>";
                                    echo"</h3>";
                                    echo "<p>";

                                    $sql_g2 = "SELECT ete.nombre FROM grupos INNER JOIN ete ON grupos.id_ete = ete.id_ete WHERE id_grupo = '". $alumno["id_grupo2"] ."';";
                                    $resultado_g2 = mysqli_query($conexion, $sql_g2);
                                    $alumno_g2 = mysqli_fetch_assoc($resultado_g2);
                                    
                                    echo $alumno_g2['nombre'];
                                    echo "</p>";
                                    echo"</div>";
                                }
                            }
                        }
                        
                        if ($tipo_usuario == 2){
                            $sql_profesor = "SELECT id_profesor FROM profesores WHERE id_usuario = '$id_usuario'";
                            $resultado_profesor = mysqli_query($conexion,  $sql_profesor);
                            $profesor = mysqli_fetch_assoc($resultado_profesor);

                            if ($profesor) {
                                $id_profesor = $profesor['id_profesor'];
                                $sql_todos_grupos = "SELECT grupos.id_grupo, ete.nombre FROM grupos 
                                                    INNER JOIN ete ON grupos.id_ete = ete.id_ete";
                                $resultado_todos = mysqli_query($conexion, $sql_todos_grupos);
                                
                                while ($grupo = mysqli_fetch_assoc($resultado_todos)) {
                                    $id_grupo_bucle = $grupo['id_grupo'];
                                    $tabla_asignaturas = "asignaturas_" . $id_grupo_bucle; 
                                    $sql_revisar = "SELECT COUNT(*) as total FROM `$tabla_asignaturas` WHERE id_profesor = '$id_profesor'";
                                    $resultado_revisar = mysqli_query($conexion, $sql_revisar);
                                    
                                    if ($resultado_revisar) {
                                        $fila_revisar = mysqli_fetch_assoc($resultado_revisar);
                                        if ($fila_revisar['total'] > 0) {
                                            echo "<div class='tarjeta'>";
                                            echo "<h3>";
                                            echo "<a class='pag' href='modulos.php?grupo=" . $id_grupo_bucle . "'>" . $id_grupo_bucle . "</a>";
                                            echo "</h3>";
                                            echo "<p>" . $grupo['nombre'] . "</p>";
                                            echo "</div>";
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                </div>
        <?php
            }
            else {
            
                $sql = "SELECT grupos.id_grupo, ete.nombre FROM grupos INNER JOIN ete On grupos.id_ete = ete.id_ete;";
                $query = mysqli_query($conexion, $sql);
                
                echo "<div class= 'contenedor-boton'><a class='btn-enviar' href=\"./crear-usuario.php\">Crear usuario</a></div>";
                echo "<br>";
                echo "<div class= 'contenedor-boton'><a class='btn-enviar' href=\"./crear-grupo.php\">Crear grupo</a></div>";
                echo "<div id=\"mis_grupos\">";
                
                while ($grupo = mysqli_fetch_assoc($query)){
                    $nombre_grupo = substr($grupo['id_grupo'], 1);
                    $id_grupo_plano = $grupo['id_grupo']; 
                    
                    echo "<div class='tarjeta'>";
                    echo "<h3>";
                    echo "<a href='modulos.php?grupo=" . $id_grupo_plano . "'>" . $nombre_grupo . "</a>";
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