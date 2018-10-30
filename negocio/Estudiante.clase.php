<?php
require_once __DIR__.'/../datos/conexion.php';

class Estudiante extends Conexion{

  public function agregar($paterno,$materno,$nombres,$sexo,$nacimiento,$telefono,$usuario,$clave){
    $this->dblink->beginTransaction();

    try {
      $sql = "SELECT * from usuario where id_usuario = :p_id_usuario;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_usuario", $usuario);
      $sentencia->execute();

      if($sentencia->rowCount()){
        throw new Exception("El id de usuario $usuario ya se encuentra registrado.");
      }

      $sql = "SELECT MAX(id_persona) + 1 as id  from persona;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->execute();
      $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
      $id_persona = $resultado["id"];

      $sql = "INSERT INTO persona (id_persona,paterno,materno,nombres,sexo,fecha_nacimiento,telefono,id_tipo_person)
              values(:p_id_persona, :p_paterno, :p_materno, :p_nombres, :p_sexo, :p_fecha_nacimiento, :p_telefono,2);";

      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_persona", $id_persona);
      $sentencia->bindParam(":p_paterno", $paterno);
      $sentencia->bindParam(":p_materno", $materno);
      $sentencia->bindParam(":p_nombres", $nombres);
      $sentencia->bindParam(":p_sexo", $sexo);
      $sentencia->bindParam(":p_fecha_nacimiento", $nacimiento);
      $sentencia->bindParam(":p_telefono", $telefono);
      $sentencia->execute();

      $sql = "INSERT INTO usuario (id_usuario,clave,id_persona)
              values(:p_id_usuario, :p_clave, :p_id_persona)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_persona", $id_persona);
      $sentencia->bindParam(":p_id_usuario", $usuario);
      $sentencia->bindParam(":p_clave", $clave);

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
      $sql = "SELECT * from usuario as u inner join persona as p on(u.id_persona = p.id_persona) where p.id_tipo_persona = 2 order by p.paterno,p.materno,p.nombres;";
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
}
