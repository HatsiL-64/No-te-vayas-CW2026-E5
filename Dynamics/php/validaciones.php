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


function crear_secuencia(string $texto){
    $largo = strlen($texto);
    $paquetes = array();
    $paquete = 0;
    $letra_en_paquete = $largo < 7 ? $largo-1: 6; //las letras en el paquete van de 6 a 0, guarda 7 letras por paquete
    //Secciona en grupos de 7 letras para empaquetar en enteros.
    for($i = 0; $i < $largo; $i++){ //recorre toda la cadena
        if(($i % 7 == 0 && $i != 0)){
            $paquetes[] = $paquete;
            $paquete = 0; 
            $letra_en_paquete = 6;
        }
        $letra = ord($texto[$i]); //letra contiene el caracter de la cadena indice i en decimal
        for($j = 7; $j >= 0; $j--){ //Este for pretende guardar los 8 bits de cada letra en un paquete
            $paquete = $paquete | (($letra & (1 << $j)) << ($letra_en_paquete * 8)); //Esta parte es la bonita, por cada bit de la letra 
        }//se le aplica una mascara(i<<$j) que se recorre x espacios segun la letra en el empaque que sea (<< ($letra_en_paquete *8)) y se suma
        $letra_en_paquete--; 
        if($i == $largo -1){
            $paquetes[] = $paquete;
        }
    }
    return $paquetes;
}
//Recibe solo un arreglo de enteros o un entero
function encriptar($secuencia, int $llave): string{
    $cadena = "";
    if(is_array($secuencia)){
        foreach ($secuencia as $paquete){
            $cadena = $cadena . dechex($paquete ^ $llave) ;
        }
    } else if(is_int($secuencia)){
        $cadena = dechex($secuencia ^ $llave);
    }
    return $cadena;
}

//Retorna un arreglo de enteros decimal, o una secuencia de numeros
function desencriptar(string $texto, int $llave){
    $secuencia = array();
    for($i = 0; $i < strlen($texto); $i+=14){
        $secuencia[] = hexdec(substr($texto, $i, 14)) ^ $llave;
    }
    return $secuencia;
}

//Nose xdxdxdxddx
function deshacer_secuencia(array $secuencia): string{
    $cadena = "";
    foreach ($secuencia as $paquete){ //por cada paquete
        for($i = 6; $i >= 0; $i--){
            $caracter_ascii = 0;
            for($j = 7; $j >= 0; $j--){
                $caracter_ascii = $caracter_ascii | (($paquete & (1 << $j + $i * 8)) >> $i * 8);
            }
            $cadena .= chr($caracter_ascii);
        }
    }
    return $cadena;
}

/*Ejemplo de uso
$lalo = crear_secuencia("61d");
$encriptado = encriptar($lalo, $key);
$secuencia = desencriptar($encriptado, $key);
$desencriptado = deshacer_secuencia($secuencia);
*/
