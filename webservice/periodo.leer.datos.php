<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Periodo.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
  if(!isset($_POST["periodo"])){
    Funciones::imprimeJSON(500, "Faltan parámetros", "");
    exit;
  }

  $id_periodo = $_POST["periodo"];
  $objPeriodo = new Periodo();
  $resultado = $objPeriodo->leerDatos($id_periodo);
  Funciones::imprimeJSON(200,"Periodo específico",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
