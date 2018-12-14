<?php
require_once __DIR__.'/../datos/conexion.php';

class Periodo extends Conexion{

  public function agregar($nombre,$inicio,$fin){
    $this->dblink->beginTransaction();

    try {
        $sql = "INSERT INTO periodo(nombre,fecha_inicio,fecha_fin)
                    VALUES (:p_nombre, :p_fecha_inicio, :p_fecha_fin);";

        $sentencia = $this->dblink->prepare($sql);
        $sentencia->bindParam(":p_nombre", $nombre);
        $sentencia->bindParam(":p_fecha_inicio", $inicio);
        $sentencia->bindParam(":p_fecha_fin", $fin);
        $sentencia->execute();

        $this->dblink->commit();
        return true;
    } catch (Exception $exc) {
        $this->dblink->rollBack();
        throw $exc;
    }
    return false;
  }

  public function editar($id_periodo,$nombre,$inicio,$fin){
    $this->dblink->beginTransaction();

    try {
        $sql = "UPDATE periodo set nombre = :p_nombre, fecha_inicio = :p_fecha_inicio, fecha_fin = :p_fecha_fin
                WHERE id_periodo = :p_id_periodo;";

        $sentencia = $this->dblink->prepare($sql);
        $sentencia->bindParam(":p_id_periodo", $id_periodo);
        $sentencia->bindParam(":p_nombre", $nombre);
        $sentencia->bindParam(":p_fecha_inicio", $inicio);
        $sentencia->bindParam(":p_fecha_fin", $fin);
        $sentencia->execute();

        $this->dblink->commit();
        return true;
    } catch (Exception $exc) {
        $this->dblink->rollBack();
        throw $exc;
    }
    return false;
  }

  public function leerDatos($id_periodo){
    try {
      $sql = "SELECT * from periodo where id_periodo = :p_id_periodo;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_periodo", $id_periodo);
      $sentencia->execute();
      $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function listar(){
    try {
      $sql = "SELECT * from periodo order by fecha_inicio, nombre;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function eliminar($id_periodo){
    try {
      $sql = "DELETE from periodo where id_periodo = :p_id_periodo;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_periodo", $id_periodo);
      $sentencia->execute();
      return true;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function listarInscritosPeriodo($id_periodo){
    try {
      $sql = "SELECT pu.id_periodo, pu.id_usuario, concat(UPPER(p.paterno),' ',UPPER(p.materno),' ',UPPER(p.nombres)) as nombre_completo, UPPER((DATE_FORMAT(pu.fecha_inscripcion, '%d de %M del %Y'))) as fecha from periodo_usuario as pu inner join usuario as u on (pu.id_usuario = u.id_usuario) inner join persona as p on (u.id_persona = p.id_persona) where pu.id_periodo = :p_id_periodo;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_periodo", $id_periodo);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
