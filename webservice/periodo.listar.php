<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Periodo.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
    $objPeriodo = new Periodo();
    $resultado = $objPeriodo->listar();
    Funciones::imprimeJSON(200,"Listado de periodos",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
