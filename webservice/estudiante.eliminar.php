<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Estudiante.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
  if(!isset($_POST["persona"])){
    Funciones::imprimeJSON(500, "Faltan parámetros", "");
    exit;
  }

  $id_persona = $_POST["persona"];
  $objEstudiante = new Estudiante();
  $resultado = $objEstudiante->eliminar($id_persona);
  Funciones::imprimeJSON(200,"Estudiante específico eliminado",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
