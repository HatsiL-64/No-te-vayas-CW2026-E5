<?php
    include 'layout.php';
    include 'config.php';
    session_start();
    
    $usuario = $_SESSION['usuario'];
    $sql1="SELECT tipo_usuario FROM usuarios WHERE id_usuario = $usuario";
    $resultado= mysqli_query($conexion, $sql1);
    $fila= mysqli_fetch_assoc($resultado);
    $tipo_usuario= $fila['tipo_usuario'];
    $actualizar = 0;
    if($tipo_usuario == 3)
    {
        
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
        <h2>Crear Grupo</h2>
<?php
        $sql2 = "SELECT nombre FROM ete";
        $respuesta = mysqli_query($conexion, $sql2);
        $lista_etes = array();
        if($respuesta)
        {
            while($fila = mysqli_fetch_assoc($respuesta))
            {
                $lista_etes[] = $fila;
            }
        }
        
        
        if($_SERVER["REQUEST_METHOD"] == 'POST')
        {
            $nombre = $_POST["nombre"];
            $plantel = $_POST["plantel"];
            $nombre_ete = $_POST["nombre_ete"];

            $sql_existe = "SELECT nombre, id_grupo, id_ete FROM grupos WHERE nombre = '$nombre'";
            $resultado_e = mysqli_query($conexion, $sql_existe);
            if (mysqli_num_rows($resultado_e) > 0)
            {
                $fila_existente = mysqli_fetch_assoc($resultado_e);
                var_dump($fila_existente);
                $id_grupo = $fila_existente['id_grupo'];
                $id_ete = $fila_existente['id_ete'];    
                $actualizar=1;
                ?>
                    <div id="cat_imp">
                        <p>El grupo ya existe</p>
                        <a href="asignar-prof.php?grupo=<?php echo $id_grupo; ?>&ete=<?php echo $id_ete; ?>&actualizar=<?php echo $actualizar; ?>">Actualizar docentes asignados</a>
                        <a href="crear-grupo.php">Crear otro grupo</a>
                    </div>
                <?php
            }
            else{
            $id_grupo = $plantel . $nombre;
            $sql3 = "SELECT id_ete FROM ete WHERE nombre = '$nombre_ete'";
            $resultado = mysqli_query($conexion, $sql3);
            $fila = mysqli_fetch_assoc($resultado);
            $id_ete = $fila['id_ete'];
            $sql4 = "INSERT INTO grupos(id_grupo, nombre, id_ete, plantel) 
            VALUES('$id_grupo', '$nombre', $id_ete, $plantel)";
            $resultado = mysqli_query($conexion, $sql4);
            
            $sql_asignatura = "CREATE TABLE asignaturas_$id_grupo(
            id_grupo VARCHAR(7) NOT NULL,
            id_modulo VARCHAR(10) NOT NULL,
            id_profesor INT NOT NULL,
            cantidad_clases TINYINT UNSIGNED,
            peso_examen DECIMAL(5,2), 
            peso_proyecto DECIMAL(5,2),
            peso_actividad_clase DECIMAL(5,2),
            peso_practica DECIMAL(5,2),
            PRIMARY KEY (id_grupo, id_modulo),
            FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo),
            FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo)
            )";
            mysqli_query($conexion, $sql_asignatura);

            $sql_act = "CREATE TABLE actividades_$id_grupo(
            id_actividad INT PRIMARY KEY, 
            tipo_act VARCHAR(5) NOT NULL, 
            fecha_asig DATETIME NOT NULL, 
            fecha_entr DATETIME, 
            id_modulo VARCHAR(10) NOT NULL, 
            nombre VARCHAR(30) NOT NULL, 
            FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo) 
            )";
            mysqli_query($conexion, $sql_act);

            $sql_calificaciones = "CREATE TABLE calificaciones_$id_grupo(
            id_alumno INT NOT NULL, 
            id_actividad INT NOT NULL, 
            calificacion DECIMAL(4,2) NOT NULL, 
            PRIMARY KEY (id_alumno, id_actividad), 
            FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumno), 
            FOREIGN KEY (id_actividad) REFERENCES actividades_$id_grupo(id_actividad) 
            )";
            mysqli_query($conexion, $sql_calificaciones);

            $sql_asistencia = "CREATE TABLE asistencia_$id_grupo(
            id_alumno INT NOT NULL, 
            id_modulo VARCHAR(10), 
            PRIMARY KEY (id_alumno, id_modulo),
            FOREIGN KEY (id_alumno) REFERENCES alumnos(id_alumno),
            FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo)
            )";
            mysqli_query($conexion, $sql_asistencia);

            $sql_recursos = "CREATE TABLE recursos_$id_grupo(
            id_recurso INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            id_modulo VARCHAR(10),
            tipo_recurso VARCHAR(1), 
            ruta VARCHAR(90),
            FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo)
            )";
            mysqli_query($conexion, $sql_recursos);

            header("Location: asignar-prof.php?grupo=".$id_grupo."&ete=".$id_ete."&actualizar=".$actualizar);
            }
        }
        if($actualizar == 0){
?>
        <div id="cat_par">
            <form action="crear-grupo.php" method="POST">
                <label>Nombre del grupo: </label>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <label>Plantel: </label>
                <input type="number" name="plantel" placeholder="Num. Plantel" required>
                <label>Tipo de ETE: </label>
                <select name="nombre_ete" required>
                    <option value="">Selecciona un ETE...</option>
                    <?php
                        if(count($lista_etes) > 0)
                            {
                                foreach($lista_etes as $ete){
                                    $nombre_ete = $ete["nombre"];
                                    echo "<option value='$nombre_ete'> ". $ete["nombre"] . "</option>";
                                }
                            }
                    ?>
                </select>
                <div class="contenedor-boton">
                    <button type="submit" class="btn-enviar">Crear grupo</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
        }
    }
    else{
        header("Location: inicio.php");
    }
?>