<?php
    session_start(); //Iniciamos la sesión para acceder a las variables de la misma sesión 
    // correccion: $_SESSION y $_COOKIE son superglobales, siempre estan definidos despues
    // de session_start(), por lo que la condicion nunca era verdadera. Se verifica el dato concreto
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../../login.html");
        exit();
    }

    // -- PASO DE INFORMACIÓN ENTRE PÁGINAS
    include 'layout.php';
    include 'estadisticas.php';

    $id_usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario']; // 1=Alumno / 2=Profesor

    $id_grupo = isset($_GET['grupo']) ? $_GET['grupo'] : '';
    $id_modulo = isset($_GET['modulo']) ? $_GET['modulo'] : '';



    // -- PRUEBA CON DATOS SIMULADOS
    /*$_SESSION['usuario'] = '101010'; 
    $_SESSION['tipo_usuario'] = 2; // Pon 2 para probar como Profesor, o 1 para Alumno
    $_SESSION['nombre'] = 'Profe Juan';

    include 'layout.php';
    include 'estadisticas.php';

    // Capturamos de la URL el grupo y módulo (si no vienen, les damos un valor por defecto para pruebas)
    $id_grupo   = isset($_GET['grupo']) ? $_GET['grupo'] : '61B';
    $id_modulo  = isset($_GET['modulo']) ? $_GET['modulo'] : 'Programación estructurada';
    
    $id_usuario   = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];*/

    // -- CODIGO PARA GUARDA Y ACTUALIZA LOS DÍAS DE ASISITENCIA (SOLO PROFESOR)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_asistencia'])) { // Verifica que el formulario se haya enviado
        if (isset($_POST['mas_asistidos']) && isset($_POST['mas_totales'])) { // Verifica que los datos estén presentes
            
            foreach ($_POST['mas_asistidos'] as $alumno_id => $sumar_asistencias) { // Recorre cada alumno y sus asistencias a sumar   
                $sumar_totales = $_POST['mas_totales'][$alumno_id];

                $sumar_asistencias = (int)$sumar_asistencias; // Convertimos a entero
                $sumar_totales = (int)$sumar_totales;

                if ($sumar_asistencias > 0 || $sumar_totales > 0) {
                    $sql_update = "UPDATE asistencia_$id_grupo
                                SET d_asistidos = d_asistidos + $sumar_asistencias,  /*Actualiza sumando las asistencias*/
                                d_totales = d_totales + $sumar_totales 
                                WHERE id_alumno = '$alumno_id' AND id_modulo = '$id_modulo'";
                    
                    mysqli_query($conexion, $sql_update);
                }
            }
            header("Location: asistencia.php?grupo=$id_grupo&modulo=$id_modulo"); 
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/asistencia.css">
    <title>Control de Asistencias</title>
</head>
<body>
    <main class="main_asi">
        <h1>Asistencia</h1>

        <!-- <<< VISTA: ALUMNO >>> -->
        <?php if ($tipo_usuario == 1): ?> <!-- Información de asistencia -->
            <?php
            $sql1= "SELECT id_alumno FROM alumnos WHERE id_usuario = $id_usuario";
            $resultado = mysqli_query($conexion, $sql1);
            $fila= mysqli_fetch_assoc($resultado);
            $id_alumno = $fila['id_alumno'];
            $query = "SELECT d_asistidos, d_totales FROM asistencia_$id_grupo WHERE id_alumno = $id_alumno AND id_modulo = '$id_modulo'";
            $res = mysqli_query($conexion, $query)  or die("Error en el query: " . mysqli_error($conexion));
            $datos = mysqli_fetch_assoc($res);
            $porcentaje = asistencias_alumno($conexion, $id_alumno, $id_grupo, $id_modulo); 
            ?>

            <h3>Módulo: <?php echo $id_modulo; ?></h3>
            <table class="tabla"> 
                <tr>  <!-- Encabezado -->
                    <th>Mis Asistencias</th>
                    <th>Días de Clase Dados</th>
                    <th>Porcentaje de Asistencia</th>
                </tr>
                <?php if ($datos): ?>
                <tr> 
                    <!-- -- Si hay datos -->
                    <td><?php echo $datos['d_asistidos']; ?></td>
                    <td><?php echo $datos['d_totales']; ?></td>
                    <td><?php echo round($porcentaje, 1); ?>%</td>
                </tr>
                <?php else: ?> <!-- -- Si no hay datos -->
                <tr>
                    <td colspan="3">No se encontraron registros de asistencia para este módulo.</td>
                </tr>
                <?php endif; ?>
            </table>

        <!-- <<< VISTA: MAESTRO >>> -->
        <?php elseif ($tipo_usuario == 2): ?> <!-- Tabla para actualizar asistencias -->
            <h3>Módulo: <?php echo $id_modulo; ?> | Grupo: <?php echo $id_grupo; ?></h3>
            
            <form action="asistencia.php?grupo=<?php echo $id_grupo?>&modulo=<?php echo $id_modulo?>" method="POST">
                <table class="tabla">
                    <tr> <!-- Encabezado -->
                        <th>Alumnos</th>
                        <th>Número de veces que asistió</th>
                        <th>Número de clases dadas</th>
                        <th>Sumar Asistencia</th>
                        <th>Sumar Clase Dada</th>
                    </tr>

                    <?php
                    $query_grupo = "SELECT id_alumno, d_asistidos, d_totales FROM asistencia_$id_grupo WHERE id_modulo = '$id_modulo'";
                    $res_grupo = mysqli_query($conexion, $query_grupo);

                    if (mysqli_num_rows($res_grupo) > 0):
                        while ($alumno = mysqli_fetch_assoc($res_grupo)):  // Recorre cada alumno del grupo y módulo
                        ?>
                            <tr>
                                <td class="alumnos"><?php echo $alumno['id_alumno']; ?></td>
                                <td><?php echo $alumno['d_asistidos']; ?></td>
                                <td><?php echo $alumno['d_totales']; ?></td>
                                <td>
                                    <input type="number" name="mas_asistidos[<?php echo $alumno['id_alumno']; ?>]" value="0" min="0" style="width: 60px;">
                                </td>
                                <td>
                                    <input type="number" name="mas_totales[<?php echo $alumno['id_alumno']; ?>]" value="0" min="0" style="width: 60px;">
                                </td>
                            </tr>
                        <?php 
                        endwhile;
                    else: ?> <!-- -- Si no hay alumnos registrados -->
                        <tr>
                            <td colspan="5">No hay alumnos registrados en este módulo y grupo.</td>
                        </tr>
                    <?php endif; ?>
                </table>
                <br>
                <button type="submit" name="actualizar_asistencia" class="btn_guardar">Guardar y Actualizar Días</button>
            </form>
            <br>
            <p><strong>Promedio General del Módulo:</strong> <?php echo round(asistencias_grupal($conexion, $id_grupo, $id_modulo), 1); ?>%</p>
        <?php endif; ?>
    </main>
</body>
</html>