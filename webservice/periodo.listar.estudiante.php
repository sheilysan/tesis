<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Periodo.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
    $id_periodo = $_POST["id_periodo"];
    $objPeriodo = new Periodo();
    $resultado = $objPeriodo->listarInscritosPeriodo($id_periodo);
    Funciones::imprimeJSON(200,"Listado de personas en periodo",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
