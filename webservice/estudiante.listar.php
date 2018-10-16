<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Estudiante.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
    $objEstudiante = new Estudiante();
    $resultado = $objEstudiante->listar();
    Funciones::imprimeJSON(200,"Listado de estudiantes",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
