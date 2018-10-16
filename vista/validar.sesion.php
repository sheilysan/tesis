<?php
require_once __DIR__.'/../negocio/Sesion.clase.php';
$sesion = new Sesion();

session_start();
if(!$sesion->comprobarSesion()){
  header("Location: http://localhost/tesis/vista/login.php");
}
?>
