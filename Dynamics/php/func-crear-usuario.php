<?php
session_start();
require 'config.php';
require 'validaciones.php';

function registra_alumno($conexion){
  $error = "";

  $plantel_entrada = trim($_POST["plantel"]);
  $identificador_entrada = trim($_POST["identificador"]);
  $nacimiento_entrada = trim($_POST["fecha_nacimiento"]);
  if(!is_numeric($plantel_entrada) || !valida_nocta($identificador_entrada) || !password_valida($nacimiento_entrada))  {
    $error = 1;//"Los datos ingresados no cumplen el formato"; //no son validos  
    return $error;
  }
  
  $grupo = sanitizar_entrada($conexion, $_POST["grupo"]);
  $plantel = sanitizar_entrada($conexion, $plantel_entrada);
  $identificador = sanitizar_entrada($conexion, $identificador_entrada);
  $id_usuario = "1" . $identificador;
  $nombre = sanitizar_entrada($conexion, $_POST["nombre"]);
  $apellido_pat = sanitizar_entrada($conexion, $_POST["apellido_pat"]);
  $apellido_mat = sanitizar_entrada($conexion, $_POST["apellido_mat"]);
  $nacimiento = hash("sha256", $nacimiento_entrada);
  $correo = $identificador . "@alumno.enp.unam.mx";
  
  $sql = "SELECT COUNT(*) FROM grupos WHERE id_grupo = '". $plantel . $grupo ."';";
  $querry = mysqli_query($conexion, $sql);
  $respuesta = mysqli_fetch_assoc($querry);
  if($respuesta["COUNT(*)"] != 1){
    $error = 3;//"El grupo ingresado es invalido";
    return $error;
  }
  
  $sql = "SELECT COUNT(*) FROM usuarios WHERE id_usuario = '". $id_usuario ."';";
  $querry = mysqli_query($conexion, $sql);
  $respuesta = mysqli_fetch_assoc($querry);
  if($respuesta["COUNT(*)"] == 1){
    $error = 2;//"Ya existe un alumno con estos datos";
    return $error;
  }

  //Insercion de usuario y alumno
  $sql = "INSERT INTO usuarios VALUES( " . $id_usuario . ", '" . $nombre . "', '" . $apellido_pat . "', '" . $apellido_mat . "', '" . $correo . "', '" . $nacimiento . "', '1');";
  mysqli_query($conexion, $sql);
  $sql = "INSERT INTO alumnos( id_alumno, id_usuario, id_grupo1, desercion) VALUES( ". $identificador . ", " . $id_usuario . ", '" . $plantel . $grupo . "', '0');";
  mysqli_query($conexion, $sql);
  return 0;
}

function registra_profesor($conexion){
  $error = "";

  $identificador_entrada = $_POST["identificador"];
  $nacimiento_entrada = trim($_POST["fecha_nacimiento"]);
  $correo = trim($_POST["correo"]);
  if(!is_numeric($identificador_entrada) || !password_valida($nacimiento_entrada) || !valida_correo($correo))  {
    $error = 1;//"Los datos ingresados no cumplen el formato"; //no son validos  
    return $error;
  }
  
  $identificador = sanitizar_entrada($conexion, $identificador_entrada);
  $id_usuario = "2" . $identificador;
  $nombre = sanitizar_entrada($conexion, $_POST["nombre"]);
  $apellido_pat = sanitizar_entrada($conexion, $_POST["apellido_pat"]);
  $apellido_mat = sanitizar_entrada($conexion, $_POST["apellido_mat"]);
  $nacimiento = hash("sha256", $nacimiento_entrada);
 
  $sql = "SELECT COUNT(*) FROM usuarios WHERE id_usuario = '". $id_usuario ."';";
  $querry = mysqli_query($conexion, $sql);
  $respuesta = mysqli_fetch_assoc($querry);
  if($respuesta["COUNT(*)"] == 1){
    $error = 2;//"Ya existe un profesor con estos datos";
    return $error;
  }

  //Insercion de usuario y profesor
  $sql = "INSERT INTO usuarios VALUES( " . $id_usuario . ", '" . $nombre . "', '" . $apellido_pat . "', '" . $apellido_mat . "', '" . $correo . "', '" . $nacimiento . "', '2');";
  mysqli_query($conexion, $sql);
  $sql = "INSERT INTO profesores VALUES( " . $identificador . ", " . $id_usuario . ");";
  mysqli_query($conexion, $sql);
  return 0;
}

if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["nombre_formulario"])) 
{
  if($_POST["nombre_formulario"] == "alumno"){
    if(($error = registra_alumno($conexion)) != 0){
      header("Location: crear-alumno.php?error=$error");
      exit();
    }    
    header("Location: crear-alumno.php");
  }
  if($_POST["nombre_formulario"] == "profesor"){
    if(($error = registra_profesor($conexion)) != 0){
      header("Location: crear-profesor.php?error=$error");
      exit();
    }
    header("Location: crear-profesor.php");
  }
}