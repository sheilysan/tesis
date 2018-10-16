<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Periodo.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {

  if(!isset($_POST["nombre"]) || !isset($_POST["fechaIni"]) || !isset($_POST["fechaFin"])){
    Funciones::imprimeJSON(500, "Faltan parámetros", "");
    exit;
  }

    $id_periodo = $_POST["periodo"];
    $nombre = $_POST["nombre"];
    $inicio = $_POST["fechaIni"];
    $fin = $_POST["fechaFin"];

    $objPeriodo = new Periodo();

    if(is_numeric($id_periodo)){
      $resultado = $objPeriodo->editar($id_periodo,$nombre,$inicio,$fin);
    }else{
      $resultado = $objPeriodo->agregar($nombre,$inicio,$fin);
    }
    Funciones::imprimeJSON(200,"Genial",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
