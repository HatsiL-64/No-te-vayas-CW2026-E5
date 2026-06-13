<?php
include 'codigo_errores.php';
function sanitizar_entrada($conexion, $datos) {

    // Quitamos espacios en blanco vacíos al inicio y al final
    $datos = trim($datos);

    // Si meten "--", lo cambiamos por "".
    $datos = str_replace('--', '', $datos);

    // Si meten "/*", lo cambiamos por "".
    $datos = str_replace('/*', '', $datos);
    
    // Si meten "*/", lo cambiamos por "".
    $datos = str_replace('*/', '', $datos);

    // Límite de tamaño (Protección contra textos gigantes)
    // Corta el texto a un máximo de 50 caracteres para no saturar la BD
    $datos = substr($datos, 0, 50);

    // Busca comillas simples (') o dobles (") y les pone una diagonal inversa (\) antes.
    // Así la base de datos sabe que es parte del nombre y NO un comando SQL.
    $datosLimpio = mysqli_real_escape_string($conexion, $datos);
    
    return $datosLimpio;
}


function valida_correo($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        return false;
    return true;
}

function password_valida($password){
    if(strlen($password) != 10){
        return false;
    }
    if(!preg_match('/^[0-9\/]+$/', $password)){
        return false;
    }
    if($password[2] != '/' || $password[5] != '/'){
        return false;
    }
    return true;
}

function valida_nocta($nocta){
    if(strlen($nocta) != 9 || !is_numeric($nocta)){
        return false;
    }
    return true;
}

function codigo_error_valido($error){
    if(is_numeric($error) && $error <= $MAX_ERROR_INDEX && $error >= 0 ){
        return true;
    }
    return false;
}

function valida_plantel($plantel){
    if(!is_numeric($plantel))
        return false;
    if($plantel < 1 || $plantel > 9)
        return false;
    return true;
}