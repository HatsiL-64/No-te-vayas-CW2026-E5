<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/crear.css">
    <title>Registrar profesor</title>
</head>

<body>
    <?php
    include 'layout.php'
    ?>
    <main class="contenido">
        <div id="nombre_seccion">
            <h2>Crear profesor</h2>
        </div>
        <div id="formulario">
            <form method="post" action="">
                <input type="radio" name="nombre_formulario" value="profesor" required hidden checked>
                <div class="pregunta_formulario">
                    <label>Numero de trabajador del profesor: </label><input type="text" name="identificador" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Nombre(s) del profesor: </label><input type="text" name="nombre" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Apellido paterno del profesor: </label><input type="text" name="apellido_pat" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Apellido materno del profesor: </label><input type="text" name="apellido_mat" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Fecha de nacimiento<input type="text" name="fecha_nacimiento" placeholder="DD/MM/YYYY"></label>
                </div>
                <div class="pregunta_formulario">
                    <label>Correo del profesor<input type="text" name="correo" placeholder=""></label>
                </div>

            </form>
        </div>
    </main>
</body>

</html>
