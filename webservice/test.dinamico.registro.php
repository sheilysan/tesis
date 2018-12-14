<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../negocio/Test.clase.php';
require_once __DIR__.'/../util/Funciones/Funciones.clase.php';

try {
  $id_usuario = $_POST["id_usuario"];
  $id_periodo = $_POST["id_periodo"];
  $nota = $_POST["nota"];
  $pregunta_1 = $_POST["pregunta_1"];
  $pregunta_2 = $_POST["pregunta_2"];
  $pregunta_3 = $_POST["pregunta_3"];
  $pregunta_4 = $_POST["pregunta_4"];
  $pregunta_5 = $_POST["pregunta_5"];
  $pregunta_6 = $_POST["pregunta_6"];
  $pregunta_7 = $_POST["pregunta_7"];
  $pregunta_8 = $_POST["pregunta_8"];
  $pregunta_9 = $_POST["pregunta_9"];
  $pregunta_10 = $_POST["pregunta_10"];
//   [pregunta_10] => {"id_hueso":"5","respuesta":"Mandíbula","puntaje":"2"}
//   $obj = json_decode($pregunta_10);
//   print $obj->{'respuesta'};  => Mandíbula
//   return;
  $objTest = new Test();
  $resultado = $objTest->agregarTest($id_usuario,$id_periodo,$nota,$pregunta_1,$pregunta_2,$pregunta_3,$pregunta_4,$pregunta_5,$pregunta_6,$pregunta_7,$pregunta_8,$pregunta_9,$pregunta_10);
  Funciones::imprimeJSON(200,"Genial test registrado",$resultado);

} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
