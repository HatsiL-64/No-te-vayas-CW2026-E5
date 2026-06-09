<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewpport" content ="width?device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Statics\styles\mensajes.css">
    <title>Página Principal </title>
</head>
<body>
    <nav class="encabezado"> 
        <div class="escudos"> 
            <img src="./media\img/escudo-prepa.jpg" class="logo">
            <img src="./media\img/escudo-unam.png" class="logo">
        </div>
        <div class="usuario">
            <img src="./media\img/logo-usuario.png" class="logo">
        </div>
    </nav>
    <nav>
        <div class="menu_lateral">
            <div><input type="submit" value="Inicio"></div>
            <div><input type="submit" value="Mi Perfil"></div>
            <div><input type="submit" value="Mensajes"></div>
            <div><input type="submit" value="Cerrar Sesión"></div>
        </div>
    </nav>
    <main>
        <h2>Mensajes</h2> 
        <div class="email">
            <img class = "foto_perfil" src = "../../Statics/media/img/foto_default.jpg" alt = "Foto de perfil">
            <h3>Usuario</h3>
        </div>
        <textarea rows="4" placeholder="Asunto..." ></textarea>

        <div class="email">
            <img class = "foto_perfil" src = "../../Statics/media/img/foto_default.jpg" alt = "Foto de perfil">
            <h3>Profesor</h3>
        </div>
        <textarea rows="4" placeholder="Respuesta..." ></textarea>
    </main>
</body>
</html>