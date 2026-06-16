<?php
    session_start();  //Iniciamos la sesión
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../../login.html");
    }

     // -- PASO DE INFORMACIÓN ENTRE PÁGINAS
    include 'layout.php';
    include 'config.php';

    $id_usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario']; // 1=Alumno / 2=Profesor

    // Capturamos la información de la URL
    $id_grupo = isset($_GET['grupo']) ? $_GET['grupo'] : '';
    $id_modulo = isset($_GET['modulo']) ? $_GET['modulo'] : '';

    /* // -- PRUEBA CON DATOS SIMULADOS
    session_start();
    $_SESSION['usuario'] = '101010'; 
    $_SESSION['tipo_usuario'] = 2; // Cambia a 1 para ver la vista de Alumno
    $_SESSION['nombre'] = 'Profe Juan';

    // Si no vienen variables por la URL, forzamos unas de prueba
    if (!isset($_GET['grupo']) || empty($_GET['grupo'])) {
        $_GET['grupo'] = '61B';
    }
    if (!isset($_GET['modulo']) || empty($_GET['modulo'])) {
        $_GET['modulo'] = 'Programacion estructurada';
    }
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../../login.html");
    }
    
    include 'layout.php';
    include 'config.php';

    $id_usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario']; // 1=Alumno / 2=Profesor
    $id_grupo = $_GET['grupo'];
    $id_modulo = $_GET['modulo'];*/

    // -- CÓDIGO PARA GUARDAR NUEVA ACTIVIDAD
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_actividad']) && $tipo_usuario == 2) {
    
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
        $tipo_act = mysqli_real_escape_string($conexion, $_POST['tipo_act']); 
        
        // Si no manda fecha de asignación, tomamos la fecha actual de la BD
        $fecha_asig = !empty($_POST['fecha_asig']) ? "'" . mysqli_real_escape_string($conexion, $_POST['fecha_asig']) . "'" : "NOW()";
        $fecha_entr = !empty($_POST['fecha_entr']) ? "'" . mysqli_real_escape_string($conexion, $_POST['fecha_entr']) . "'" : "NULL";

        $sql_insert = "INSERT INTO actividades_$id_grupo (tipo_act, fecha_asig, fecha_entr, id_modulo, nombre, descripcion) 
                    VALUES ('$tipo_act', $fecha_asig, $fecha_entr, '$id_modulo', '$nombre', '$descripcion')";
        
        if (mysqli_query($conexion, $sql_insert)) {
            header("Location: actividades.php?grupo=$id_grupo&modulo=$id_modulo");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/tareas.css">
    <title>Actividades y Tareas</title>
</head>
<body>
    <main class="main_tar">
        <h1>Actividades/Tareas - Grupo <?php echo htmlspecialchars($id_grupo); ?></h1>

        <?php if ($tipo_usuario == 2): ?>
            <section class="tareas">
                <h2> Publicar Nueva Actividad / Tarea</h2>
                <form action="actividades.php?grupo=<?php echo $id_grupo; ?>&modulo=<?php echo $id_modulo; ?>" method="POST">
                    <label>Tipo:</label>
                    <select name="tipo_act" required>
                        <option value="Tarea">Tarea</option>
                        <option value="Activ">Actividad</option>
                    </select>

                    <label>Nombre:</label>
                    <input type="text" name="nombre" maxlength="40" required>

                    <label>Descripción:</label>
                    <textarea name="descripcion" rows="3" required></textarea>

                    <label>Fecha Asignación (Opcional):</label>
                    <input type="datetime-local" name="fecha_asig">

                    <label>Fecha Entrega (Opcional):</label>
                    <input type="datetime-local" name="fecha_entr">

                    <button type="submit" name="crear_actividad">Publicar</button>
                </form>
            </section>
        <?php endif; ?>

        <section class="tareas">
            <h2>Tareas</h2>
            <?php
            $sql_tareas = "SELECT id_actividad, nombre FROM actividades_$id_grupo WHERE tipo_act = 'Tarea' AND id_modulo = '$id_modulo' ORDER BY fecha_asig DESC";
            $res_tareas = mysqli_query($conexion, $sql_tareas);
            
            if ($res_tareas && mysqli_num_rows($res_tareas) > 0):
                while ($tar = mysqli_fetch_assoc($res_tareas)): ?>
                    <article class="tarea">
                        <h3>
                            <a href="detalle_actividad.php?id=<?php echo $tar['id_actividad']; ?>&grupo=<?php echo $id_grupo; ?>&modulo=<?php echo $id_modulo; ?>">
                                <?php echo htmlspecialchars($tar['nombre']); ?>
                            </a>
                        </h3>
                    </article>
                <?php endwhile;
            else: ?>
                <p style="text-align:center; color:#555;">No hay tareas publicadas aún.</p>
            <?php endif; ?>
        </section>

        <section class="actividades">
            <h2>Actividades</h2>
            <?php
            $sql_activ = "SELECT id_actividad, nombre FROM actividades_$id_grupo WHERE tipo_act = 'Activ' AND id_modulo = '$id_modulo' ORDER BY fecha_asig DESC";
            $res_activ = mysqli_query($conexion, $sql_activ);
            
            if ($res_activ && mysqli_num_rows($res_activ) > 0):
                while ($act = mysqli_fetch_assoc($res_activ)): ?>
                    <article class="tareas">
                        <h3>
                            <a href="detalle_actividad.php?id=<?php echo $act['id_actividad']; ?>&grupo=<?php echo $id_grupo; ?>&modulo=<?php echo $id_modulo; ?>">
                                <?php echo htmlspecialchars($act['nombre']); ?>
                            </a>
                        </h3>
                    </article>
                <?php endwhile;
            else: ?>
                <p style="text-align:center; color:#555;">No hay actividades publicadas aún.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>