<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Sesion.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {

  if(!isset($_GET["txtIdUsuario"]) || !isset($_GET["txtclave"])){
    Funciones::imprimeJSON(500, "Debe ingresar ambos datos: id y clave", "");
    exit;
  }

    $id_usuario = $_GET["txtIdUsuario"];
    $clave = $_GET["txtclave"]; 

    $objSesion = new Sesion();

    $resultado = $objSesion->iniciarSesionApp($id_usuario,$clave);
    // echo "200";
    Funciones::imprimeJSON(200,"Bienvenido",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
