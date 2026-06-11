<?php
include 'layout.php';
include 'config.php';
session_start();

$usuario = $_SESSION['usuario'];
$sql1 = "SELECT tipo_usuario FROM usuarios WHERE id_usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql1);
$fila = mysqli_fetch_assoc($resultado);
$tipo_usuario = $fila['tipo_usuario'];

if ($tipo_usuario == 3) {
    if (isset($_GET['grupo']) && isset($_GET['ete'])) {
        $id_grupo = $_GET['grupo'];
        $id_ete = $_GET['ete'];
        $actualizar = $_GET['actualizar'];
    } else if (isset($_POST['id_grupo']) && isset($_POST['id_ete'])) {
        $id_grupo = $_POST['id_grupo'];
        $id_ete = $_POST['id_ete'];
    } else {
        header("Location: crear-grupo.php");
        
    }

    $lista_prof = array();
    $lista_modulos = array();

    $sql2 = "SELECT profesor.id_profesor, usuarios.id_usuario, usuarios.nombre, usuarios.apellido_p, usuarios.apellido_m 
            FROM profesor 
            INNER JOIN usuarios ON profesor.id_usuario = usuarios.id_usuario";
    $resultado = mysqli_query($conexion, $sql2);
    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $lista_prof[] = $fila;
        }
    }

    $sql3 = "SELECT id_modulo, nombre FROM modulos WHERE id_ete = '$id_ete'";
    $resultado = mysqli_query($conexion, $sql3);
    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $lista_modulos[] = $fila;
        }
    }

    $todo_bien = 0;
    $procesado = false;

    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['modulos'])) 
    {   
        $procesado = true;
        $id_profesor_seleccionado = $_POST["id_profesor"];
        $modulos_enviados = $_POST["modulos"]; 

        $todo_bien = 1;
        foreach ($modulos_enviados as $modulo_id) 
        {
            if($actualizar==0){
            $sql4 = "INSERT INTO asignaturas_$id_grupo(id_grupo, id_modulo, id_profesor) 
                    VALUES('$id_grupo', '$modulo_id', '$id_profesor_seleccionado')";
            $resultado_insert = mysqli_query($conexion, $sql4);
            }
            else{
            $sql4 = "UPDATE asignaturas_$id_grupo SET id_grupo = '$id_grupo', id_modulo = '$modulo_id', id_profesor = '$id_profesor_seleccionado' WHERE id_modulo = '$modulo_id'";
            $resultado_insert = mysqli_query($conexion, $sql4);
            }
            if (!$resultado_insert) {
                $todo_bien = 0; echo "Error en la consulta SQL: " . mysqli_error($conexion);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/cuestionario.css">
    <title>Asignar Profesores</title>
</head>
<body>
    <main class="contenido">
    <?php
        if ($procesado && $todo_bien == 1) {
    ?>
            <div id="cat_par">
                <p>¡Profesor Guardado con éxito!</p>
                <a href="asignar-prof.php?grupo=<?php echo $id_grupo; ?>&ete=<?php echo $id_ete; ?>">Añadir otro Profesor</a>
                <a href="inicio.php">Terminar grupo</a>
            </div>
    <?php
        } else 
        { 
    ?>
            <h2 id="am">Asignación de Módulos/Asignaturas</h2>
            <div id="cat_par">
                <form action="asignar-prof.php?grupo=<?php echo $id_grupo; ?>&ete=<?php echo $id_ete; ?>&actualizar=<?php echo $actualizar; ?>" method="POST">
                    
                    <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>">
                    <input type="hidden" name="id_ete" value="<?php echo $id_ete; ?>">
                    <input type="hidden" name="actualizar" value="<?php echo $actualizar; ?>">
                    <label>Profesor: </label>
                    <select name="id_profesor" required>
                        <option value="">Selecciona un docente...</option>
                        <?php
                            if (count($lista_prof) > 0) {
                                foreach ($lista_prof as $prof) {
                                    $id_prof = $prof["id_profesor"];
                                    $nombre_completo = $prof["nombre"] . " " . $prof["apellido_p"] . " " . $prof["apellido_m"];
                                    echo "<option value='$id_prof'>$nombre_completo</option>";
                                }
                            }
                        ?>
                    </select>

                    <p>Selecciona los módulos correspondientes:</p>
                    <?php
                        if (count($lista_modulos) > 0) {
                            foreach ($lista_modulos as $mod) {
                                $id_modulo = $mod['id_modulo'];
                                echo "<label class='mod'><input type='checkbox' name='modulos[]' value='$id_modulo'> " . $mod["nombre"] . "</label>";
                            }
                        } else {
                            echo "<p>No hay módulos registrados para este ETE.</p>";
                        }
                    ?>
                    <div class="contenedor-boton">
                        <button type="submit" class="btn-enviar">Guardar Profesor</button>
                    </div>
                </form>
            </div>
    <?php
            
        } 
    ?>
    </main>
</body>
</html>
<?php
} else {
    header("Location: inicio.php");
    exit();
}
?>