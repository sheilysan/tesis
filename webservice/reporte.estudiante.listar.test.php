<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Test.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
    $id_usuario = $_POST["id_usuario"];
    $id_periodo = $_POST["id_periodo"];
    $objTest = new Test();
    $resultado = $objTest->listarReporteTestEstudiante($id_usuario,$id_periodo);
    Funciones::imprimeJSON(200,"Listado de Tests por person",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
