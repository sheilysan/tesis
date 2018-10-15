<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Sesion.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {

  if(!isset($_POST["txtIdUsuario"]) || !isset($_POST["txtclave"])){
    Funciones::imprimeJSON(500, "Debe ingresar ambos datos: id y clave", "");
    exit;
  }

    $id_usuario = $_POST["txtIdUsuario"];
    $clave = $_POST["txtclave"];

    $objSesion = new Sesion();

    $resultado = $objSesion->iniciarSesion($id_usuario,$clave);
    Funciones::imprimeJSON(200,"http://localhost/tesis/vista",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
