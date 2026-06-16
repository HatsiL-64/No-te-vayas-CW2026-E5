<?php
include_once 'validaciones.php';
include_once 'config.php';

function procesar_cookies(){
    if(isset($_COOKIE["usuario"])){
        $llave = crear_secuencia("rayas");
        $usuario = deshacer_secuencia(desencriptar($_COOKIE["usuario"], $llave[0]));
        $sql = "SELECT nombre, id_usuario, tipo_usuario FROM usuarios WHERE id_usuario = '$usuario';";
        $query = mysqli_query(connect(), $sql);
        $registro = mysqli_fetch_assoc($query);
        if($registro){
            $_SESSION['usuario'] = $registro["id_usuario"];
            $_SESSION['tipo_usuario'] = $registro["tipo_usuario"];
            $_SESSION['nombre'] = $registro["nombre"];
            $_SESSION['llave'] = random_int(1, 72057594037927935); //un entero de 7 bytes    
        }
    }
    else{
        header("Location: ../../login.html");
        exit();
    }
}