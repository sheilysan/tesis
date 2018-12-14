<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Test.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
    $objTest = new Test();
    $resultado = $objTest->listarReportePromedio();
    Funciones::imprimeJSON(200,"Listado de Tests",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
