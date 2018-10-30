<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Estudiante.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
  if(!isset($_POST["periodo"])){
    Funciones::imprimeJSON(500, "Faltan parámetros", "");
    exit;
  }

  $id_periodo = $_POST["estudiante"];
  $objEstudiante = new Estudiante();
  $resultado = $objEstudiante->eliminar($id_persona);
  Funciones::imprimeJSON(200,"Periodo específico eliminado",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
