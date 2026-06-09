<?php    
    const DBHOST = "localhost";
    const DBUSER = "root";
    const PASSWORD = "";
    const DB = "equipo5";

    function connect()
    {
        $conexion = mysqli_connect(DBHOST, DBUSER, PASSWORD, DB);
        /*
        --PASO : var_dump de $conexion:
        --PASO: regresar variable para un archivo externo
        */
        return $conexion;
        
    }
    // --PASO : llamar a la funcion antes de pasarla a otro archivo
    $conexion = connect();
?>