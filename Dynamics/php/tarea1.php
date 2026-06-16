PHP
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.html");
    exit();
}

include 'layout.php';
include 'config.php';

$id_usuario = $_SESSION['usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];

$id_grupo = isset($_GET['grupo']) ? $_GET['grupo'] : '';
$id_modulo = isset($_GET['modulo']) ? $_GET['modulo'] : '';
$id_actividad = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// -- CÓDIGO PARA GUARDAR CALIFICACIONES (SOLO PROFESOR)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_notas']) && $tipo_usuario == 2) {
    if (isset($_POST['calif'])) {
        foreach ($_POST['calif'] as $alumno_id => $nota) {
            if ($nota !== '') { // Solo guarda si el profesor escribió algo
                $nota = (float)$nota;
                
                // Actualiza o inserta la calificación
                $sql_save = "INSERT INTO calificaciones_$id_grupo (id_alumno, id_actividad, calificacion) 
                            VALUES ('$alumno_id', $id_actividad, $nota)
                            ON DUPLICATE KEY UPDATE calificacion = $nota";
                mysqli_query($conexion, $sql_save);
            }
        }
        header("Location: detalle_actividad.php?id=$id_actividad&grupo=$id_grupo&modulo=$id_modulo");
        exit();
    }
}

// -- OBTENER DATOS DE LA ACTIVIDAD ACTUAL
$sql_detalle = "SELECT * FROM actividades_$id_grupo WHERE id_actividad = $id_actividad";
$res_detalle = mysqli_query($conexion, $sql_detalle);
$actividad = mysqli_fetch_assoc($res_detalle);

if (!$actividad) {
    echo "<h1>Error: Actividad no encontrada.</h1>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/tarea1.css">
    <title><?php echo htmlspecialchars($actividad['nombre']); ?></title>
</head>
<body>
    <main class="main_tar1">
        <h1><?php echo htmlspecialchars($actividad['tipo_act']); ?></h1>

        <section class="tareas">
            <h2><?php echo htmlspecialchars($actividad['nombre']); ?></h2>
            <p class="texto">
                <strong>Descripción:</strong><br>
                <?php echo nl2br(htmlspecialchars($actividad['descripcion'])); ?>
            </p>
            <p class="texto" style="font-size: 0.9em; color: #555;">
                <strong>Asignado:</strong> <?php echo date('d/m/Y H:i', strtotime($actividad['fecha_asig'])); ?><br>
                <strong>Entrega:</strong> <?php echo $actividad['fecha_entr'] ? date('d/m/Y H:i', strtotime($actividad['fecha_entr'])) : 'Sin fecha límite'; ?>
            </p>
        </section>

        <section class="tareas">
            
            <?php if ($tipo_usuario == 1): ?>
                <h2>Mi Calificación</h2>
                <?php
                $sql_mi_nota = "SELECT calificacion FROM calificaciones_$id_grupo WHERE id_actividad = $id_actividad AND id_alumno = '$id_usuario'";
                $res_mi_nota = mysqli_query($conexion, $sql_mi_nota);
                $nota_data = mysqli_fetch_assoc($res_mi_nota);
                ?>
                <p class="texto" style="text-align: center; font-size: 2em; font-weight: bold; color: #002b5c;">
                    <?php echo $nota_data ? $nota_data['calificacion'] : 'Pendiente'; ?>
                </p>

            <?php elseif ($tipo_usuario == 2): ?>
                <h2>Panel de Calificaciones</h2>
                <form action="detalle_actividad.php?id=<?php echo $id_actividad; ?>&grupo=<?php echo $id_grupo; ?>&modulo=<?php echo $id_modulo; ?>" method="POST">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr>
                                <th style="padding: 10px;">ID Alumno</th>
                                <th style="padding: 10px;">Nota Actual</th>
                                <th style="padding: 10px;">Modificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_alumnos = "SELECT al.id_alumno, cal.calificacion 
                                            FROM alumnos al
                                            LEFT JOIN calificaciones_$id_grupo cal 
                                            ON al.id_alumno = cal.id_alumno AND cal.id_actividad = $id_actividad";
                            $res_alumnos = mysqli_query($conexion, $sql_alumnos);

                            if ($res_alumnos && mysqli_num_rows($res_alumnos) > 0):
                                while ($row = mysqli_fetch_assoc($res_alumnos)): ?>
                                    <tr>
                                        <td style="padding: 10px; border-bottom: 1px solid #ffffff;"><?php echo htmlspecialchars($row['id_alumno']); ?></td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ffffff; font-weight: bold;">
                                            <?php echo ($row['calificacion'] !== null) ? $row['calificacion'] : 'Sin nota'; ?>
                                        </td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ffffff;">
                                            <input type="number" name="calif[<?php echo $row['id_alumno']; ?>]" 
                                                value="<?php echo $row['calificacion']; ?>" 
                                                step="0.1" min="0" max="10" style="width: 70px;">
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr><td colspan="3" style="text-align: center; padding: 15px;">No se encontraron alumnos.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <button type="submit" name="guardar_notas" style="margin-top: 15px; padding: 10px; background-color: #002b5c; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Guardar Cambios
                    </button>
                </form>
            <?php endif; ?>

        </section>
        
        <p style="text-align: center; margin-top: 20px;">
            <a href="actividades.php?grupo=<?php echo $id_grupo; ?>&modulo=<?php echo $id_modulo; ?>" style="color: #002b5c; text-decoration: none; font-weight: bold;"> Regresar a la lista</a>
        </p>
    </main>
</body>
</html>