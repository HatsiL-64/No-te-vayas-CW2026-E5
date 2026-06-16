<?php
    include 'layout.php';
    include 'validaciones.php';
    include 'config.php';
    session_start();

    $usuario = $_SESSION['usuario'];
    $sql1 = "SELECT tipo_usuario FROM usuarios WHERE id_usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql1);
    $fila = mysqli_fetch_assoc($resultado);
    $tipo_usuario = $fila['tipo_usuario'];  
    if (isset($_GET['grupo']) && isset($_GET['modulo'])) {
        $id_grupo = $_GET['grupo'];
        $id_modulo =$_GET['modulo'];
        if(isset($_GET['g'])){
            $g = $_GET['g'];
        } else {$g = 1;}
    } else {
        $id_grupo = '61B'; 
        $id_modulo = 'CM1'; 
    }

    $sql2 = "SELECT id_ete FROM modulos WHERE id_modulo = '$id_modulo'";
    $resultado = mysqli_query($conexion, $sql2);
    
    $fila = mysqli_fetch_assoc($resultado);
    $id_ete = $fila['id_ete']; 
    if($tipo_usuario == 2)
    {    
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/cuestionario.css">
    <title>Añadir Recurso</title>
</head>
<body>
    <main class="contenido">
        <h2> Añadir recursos </h2>
        <?php
            if($g == 0)
            {
                echo "<div id='cat_par'> <p> Recurso guardado <br> Puedes añadir otro recurso </p></div>";
            }
        ?>
        <div id="cat_imp">
            <form id="form-recursos" action="añade-recurso.php?grupo=<?php echo $id_grupo; ?>&modulo=<?php echo $id_modulo;?>" method="POST" enctype="multipart/form-data">
                <label><select name="tipo_recurso" required>
                    <option value="">Selecciona un tipo de recurso...</option>
                    <option value="a"> Archivo (.pdf/.docs/.img/.jpg) </option>
                    <option value="e"> Ejercicios/ Actividad extra </option>
                    <option value="l"> Ligas / enlaces </option>
                    <?php
                    if($id_ete == 'CM1' || $id_ete == 'CM2' || $id_ete == 1)
                        echo "<option value='s'> Script </option>";
                    ?>
                </select> </label>
                <label> Nombre del recurso
                    <input type="text" name="nombre" required> 
                </label>
                <label> Añade una descripción
                    <input type="textarea" rows="4" name="descripcion" required> 
                </label>

                <label>Opción A: Sube un Archivo </lable>
                    <input type="file" name="archivo" accept=".pdf, .doc, .docx, .jpg, .jpeg, .png">
                <label>Opción B: Añade una liga</lable>
                    <input type="url" name="enlace">
                <div class="contenedor-boton">
                    <button type="submit" class="btn-enviar">Guardar Recurso</button>
                </div>
        </div>
<?php
        if($_SERVER["REQUEST_METHOD"] == 'POST')
        {   
            $g = 1;
            $tipo_recurso = $_POST['tipo_recurso'];
            $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
            $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
            $confirma = 0;
            if($tipo_recurso == 'l'){
                if(empty($_POST['enlace'])){
                    echo "<div id= 'cat_par' > <p> Seleccionaste liga pero no pegaste un enlace</p> </div>";
                    $confirma = 1; 
                }
                $valor_final = $_POST['enlace'];
            }
            else
            {
                if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK){
                    echo "<div id= 'error' > <p> Seleccionaste subir algún archivo pero no subiste algún archivo valido</p> </div>";
                    $confirma = 1; 
                }
                $ruta_temporal = $_FILES['archivo']['tmp_name'];
                $carpeta_destino = "../../Statics/media/recursos-subidos/";
                if (!file_exists($carpeta_destino)) {
                    mkdir($carpeta_destino, 0777, true);
                }
                $nombre_original = $_FILES['archivo']['name'];
                $ext = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
                $ruta_final = $carpeta_destino . uniqid(). time() . "_" . $nombre . "." . $ext;

                if (move_uploaded_file($ruta_temporal, $ruta_final)) {
                    $valor_final = mysqli_real_escape_string($conexion, $ruta_final); // Guardamos la ruta
                } 
                else 
                { echo "<div id= 'error' > <p> Error al mover archivo al servidor </p> </div>";
                    $confirma = 1; 
                }
            }
            if($confirma != 1)
            {
                $sql3 = "INSERT INTO recursos_$id_grupo(id_modulo, tipo_recurso, ruta, nombre, descripcion)
                        VALUES('$id_modulo', '$tipo_recurso', '$valor_final', '$nombre', '$descripcion')";
                $resultado = mysqli_query($conexion, $sql3);
                if(!$resultado){
                    echo "<div id= 'error' > <p> Problema al ingresar a base de datos </p> </div>";
                    die("Error en SQL1: " . mysqli_error($conexion));
                }
                else { 
                    $g = 0;
                    header("Location: añade-recurso.php?grupo=" . $id_grupo . "&modulo=" . $id_modulo . "&g=0");
                }
            }
        }
    }
    else {
        header("Location: inicio.php");
    }
?>