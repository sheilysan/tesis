<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Test.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
    $id_test = $_POST["id_test"];
    $objTest = new Test();
    $resultado = $objTest->listarDetalleTest($id_test);
    Funciones::imprimeJSON(200,"Listado detallado del test",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
