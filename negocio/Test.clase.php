<?php
require_once __DIR__.'/../datos/conexion.php';

class Test extends Conexion{

  public function agregarTest($id_usuario,$id_periodo,$nota,$pregunta_1,$pregunta_2,$pregunta_3,$pregunta_4,$pregunta_5,$pregunta_6,$pregunta_7,$pregunta_8,$pregunta_9,$pregunta_10){
    $this->dblink->beginTransaction();

    try {
      $sql = "SELECT COALESCE(MAX(id_test),0) + 1 as id  from test;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->execute();
      $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
      $id_test = $resultado["id"];

      $sql = "INSERT INTO test (id_test,nota,id_tipo_test,id_usuario,id_periodo)
              values(:p_id_test, :p_nota, 1, :p_id_usuario, :p_id_periodo);";

      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_nota", $nota);
      $sentencia->bindParam(":p_id_usuario", $id_usuario);
      $sentencia->bindParam(":p_id_periodo", $id_periodo);
      $sentencia->execute();

      $obj = json_decode($pregunta_1);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_2);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_3);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_4);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_5);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_6);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_7);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_8);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_9);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $obj = json_decode($pregunta_10);
      $id_hueso = $obj->{'id_hueso'};
      $respuesta = $obj->{'respuesta'};
      $puntaje = $obj->{'puntaje'};
      $sql = "INSERT INTO detalle_test (id_test,id_hueso,respuesta,puntaje)
              values(:p_id_test,:p_id_hueso,:p_respuesta,:p_puntaje)";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->bindParam(":p_id_hueso", $id_hueso);
      $sentencia->bindParam(":p_respuesta", $respuesta);
      $sentencia->bindParam(":p_puntaje", $puntaje);
      $sentencia->execute();

      $this->dblink->commit();
      return true;
    } catch (Exception $exc) {
        $this->dblink->rollBack();
        throw $exc;
    }
    return false;
  }

  public function listarReportePromedio(){
    try {
      $sql = "SELECT UPPER(u.id_usuario) as id, concat(UPPER(p.paterno),' ',UPPER(p.materno),' ',UPPER(p.nombres)) as nombre_completo, UPPER(peri.nombre) as nom_peri, peri.id_periodo,(select count(*) from test as t where pu.id_usuario = t.id_usuario and t.id_periodo=pu.id_periodo) as num_veces, (select SUM(nota)/COUNT(*) from test as t where pu.id_usuario = t.id_usuario and t.id_periodo=pu.id_periodo) as prom from persona as p inner join usuario as u on(p.id_persona=u.id_persona) inner join periodo_usuario as pu on(pu.id_usuario=u.id_usuario) inner join periodo as peri on (pu.id_periodo=peri.id_periodo) where p.id_tipo_persona=2;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (Exception $e) {
      throw $e;
    }
  }
  
  public function listarReporteTestEstudiante($id_usuario,$id_periodo){
    try {
      $sql = "SELECT id_test, (UPPER(DATE_FORMAT(fecha_test, '%d de %M del %Y'))) as fecha, nota from test where id_usuario = :p_id_usuario and id_periodo = :p_id_periodo;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_usuario", $id_usuario);
      $sentencia->bindParam(":p_id_periodo", $id_periodo);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (Exception $e) {
      throw $e;
    }
  }
  
  public function listarDetalleTest($id_test){
    try {
      $sql = "SELECT dt.id_test, h.modelo, UPPER(h.nombre_hueso) as nom_hueso, UPPER(dt.respuesta) as rpta, dt.puntaje FROM detalle_test as dt inner join hueso as h on(dt.id_hueso=h.id_hueso) where dt.id_test = :p_id_test;";
      $sentencia = $this->dblink->prepare($sql);
      $sentencia->bindParam(":p_id_test", $id_test);
      $sentencia->execute();
      $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    } catch (Exception $e) {
      throw $e;
    }
  }

}
