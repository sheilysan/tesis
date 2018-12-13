<?php
  $servidor = 'localhost';
  $usuario  = 'root';
  $password = '';
  $baseDatos = 'bd_tesis';

  $conexion = new mysqli($servidor, $usuario, $password, $baseDatos);

  $id_subtema = $_POST['id_subtema'];
  $nombres    = $_POST['nombre'];
  $nota       = $_POST['nota'];
  $id_tema    = $_POST['id_tema'];

  if(!$conexion){
    echo "400";
  } else{
    $sql    = "INSERT INTO subtema VALUES (NULL, $nombres, $nota, $id_tema);";
    $resultado = mysqli_query($conexion, $sql);
    echo "200";
  }

  $conexion = null;
  $sql      = null;
?>
