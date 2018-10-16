<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__.'/../negocio/Sesion.clase.php';

$objSesion = new Sesion();
$objSesion->cerrarSesion();
header("Location: http://localhost/tesis/vista/login.php");
