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
    if (isset($_GET['grupo']))
    {
        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];
        $id_grupo = $_GET['grupo'];
        //$id_grupo = deshacer_secuencia(desencriptar($grupo_get, $_SESSION["llave"]));
        $sql1 = "SELECT id_ete FROM grupos WHERE id_grupo = '$id_grupo'";
        $resultado = mysqli_query($conexion, $sql1);
        $fila= mysqli_fetch_assoc($resultado);
        $id_ete = $fila['id_ete'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content ="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/style.css">

</head>
<body>
    <main id='main_modulos'>
        <h2 id="tit_mod">Módulos</h2>

        <div class="contenedor-boton">
            <a class="pag" href="listados.php?grupo=<?php echo $id_grupo?>">
                Ver listado de alumnos
            </a>
        </div>
        <?php
            // correccion: && tiene mayor precedencia que ||, el link aparecia para profesores y admin
            // en grupos CM1/CM2. Se agregan parentesis para que tipo_usuario se evalúe en todos los casos
            if(($id_ete == 'CM1' || $id_ete == 'CM2' || $id_ete == 1) && $tipo_usuario == 1)
            {
                echo "<a class='pag' href = 'cuestionario.php'> Cuestionario </a>";
            }
        ?>
        </div>
        <section class="contenedor_modulos">
            <?php
                $sql = "SELECT id_modulo, numero, nombre FROM modulos WHERE id_ete = '" . $id_ete . "';";
                $query = mysqli_query($conexion, $sql);
                $i = 1;
                while (($registro = mysqli_fetch_assoc($query))) {
                    // correccion: faltaba el '>' de cierre en la etiqueta <article>, el HTML resultaba invalido
                    if($i % 2 == 0){
                        echo "<article class='modulos_par'>";
                    }else{
                        echo "<article class='modulos_impar'>";
                    }
                    //esto lo vi en la documentacion de php, esta increible
                    echo <<<EOH
                            <h3>
                                <a href='dentro-modulos.php?grupo=$id_grupo&modulo={$registro['id_modulo']}'>Módulo {$registro['numero']} </a>
                            </h3>
                            <p>{$registro["nombre"]}</p>
                        </article>    
                    EOH;
                    $i++;
                }
            ?>    
        </section>
    </main>                
</body>
</html>
<?php
    }
    else {
        header("Location: inicio.php");
    }
?>