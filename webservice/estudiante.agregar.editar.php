<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Estudiante.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {

  if(!isset($_POST["nombres"]) ||
     !isset($_POST["paterno"]) ||
     !isset($_POST["materno"]) ||
     !isset($_POST["sexo"]) ||
     !isset($_POST["nacimiento"]) ||
     !isset($_POST["telefono"]) ||
     !isset($_POST["usuario"]) ||
     !isset($_POST["clave"])){
    Funciones::imprimeJSON(500, "Faltan parámetros", "");
    exit;
  }

  $id_persona = $_POST["persona"];
  $nombres = $_POST["nombres"];
  $paterno = $_POST["paterno"];
  $materno = $_POST["materno"];
  $sexo = $_POST["sexo"];
  $nacimiento = $_POST["nacimiento"];
  $telefono = $_POST["telefono"];
  $usuario = $_POST["usuario"];
  $clave = $_POST["clave"];

  $objEstudiante = new Estudiante();

  if(is_numeric($id_persona)){
    $validarContra = strpos($clave, "****");
    if(strlen($clave) < 4 || $validarContra !== false){
      $clave = '****';
    }
    $resultado = $objEstudiante->editar($id_persona,$paterno,$materno,$nombres,$sexo,$nacimiento,$telefono,$usuario,$clave);
    $msg = "de la";
    if($sexo == "M"){
      $msg = "del";
    }
    Funciones::imprimeJSON(200,"Los datos $msg estudiante $nombres $paterno $materno han sido actualizados.",$resultado);
  }else{
    $resultado = $objEstudiante->agregar($paterno,$materno,$nombres,$sexo,$nacimiento,$telefono,$usuario,$clave);
    $msg = "La";
    $msg2 = "a";
    if($sexo == "M"){
      $msg = "El";
      $msg2 = "o";
    }
    Funciones::imprimeJSON(200,"$msg estudiante $nombres $paterno $materno ha sido agregad$msg2.",$resultado);
  }

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
