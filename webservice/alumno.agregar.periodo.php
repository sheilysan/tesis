<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Periodo.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {

  if(!isset($_POST["id_periodo"]) || !isset($_POST["codigo_usuario"])){
    Funciones::imprimeJSON(500, "Faltan parámetros", "");
    exit;
  }

    $id_periodo = $_POST["id_periodo"];
    $codigo_usuario = $_POST["codigo_usuario"];

    $objPeriodo = new Periodo();

    $resultado = $objPeriodo->agregarAlumnoPeriodo($id_periodo,$codigo_usuario);
    Funciones::imprimeJSON(200,"El alumno con código $codigo_usuario ha sido agregado.",$resultado);


} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
