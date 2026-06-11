<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics/styles/crear.css">
    <title>Registrar alumno</title>
</head>

<body>
    <?php
    include 'layout.php'
    ?>
    <main class="contenido">
        <div id="nombre_seccion">
            <h2>Crear alumno</h2>
        </div>

        <div id="formulario">
            <form method="post">
                <input type="radio" name="nombre_formulario" value="alumno" required checked hidden>
                <div class="pregunta_formulario">
                    <label>Numero de cuenta del alumno: </label><input type="text" name="identificador" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Nombre(s) del alumno: </label><input type="text" name="nombre" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Apellido paterno del alumno: </label><input type="text" name="apellido_pat" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Apellido materno del alumno: </label><input type="text" name="apellido_mat" required>
                </div>
                <div class="pregunta_formulario">
                    <label>Fecha de nacimiento<input type="text" name="fecha_nacimiento" placeholder="DD/MM/YYYY"></label>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
