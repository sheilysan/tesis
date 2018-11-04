<?php
require_once __DIR__.'/../datos/conexion.php';

class Sesion extends Conexion{

    public function iniciarSesion($id_usuario,$clave) {
    	try{
        $stmt = $this->dblink->prepare("SELECT u.id_usuario,
                                               u.clave,
                                               u.estado,
                                               p.paterno,
                                               p.materno,
                                               p.nombres,
                                               p.sexo,
                                               tp.id_tipo,
                                               tp.nombre as tipo
                                        FROM
                                        	usuario u inner join
                                          persona p on (u.id_persona=p.id_persona) inner join
                                          tipo_persona tp on (p.id_tipo_persona = tp.id_tipo)
                                        WHERE u.id_usuario=:id_usuario LIMIT 1");
				$stmt->bindParam(":id_usuario", $id_usuario);
				$stmt->execute();
				$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    			if($stmt->rowCount()){
            if($userRow['id_tipo'] != 1){
              throw new Exception("Usted no tiene los permisos necesarios para iniciar sesión aquí");
            }
            if($userRow['estado']=="E"){
              throw new Exception("Usted ha sido restringido de la aplicación.");
            }
    				if($userRow['estado'] == "A"){
    					if($userRow['clave'] == $clave){
      					session_start();

                $_SESSION['id_usuario'] = $userRow['id_usuario'];
                $_SESSION['paterno'] = $userRow['paterno'];
                $_SESSION['materno'] = $userRow['materno'];
                $_SESSION['nombres'] = $userRow['nombres'];
                $_SESSION['sexo'] = $userRow['sexo'];
                $_SESSION['tipo'] = $userRow['tipo'];
                return true;
    					}else{
                //Contraseña incorrecta pero se manda error de datos al ingresar
    						throw new Exception("Contraseña incorrecta.");
    						exit;
    					}
    				}else{
              //Cuenta inactiva
    					throw new Exception("Su cuenta se encuentra inactiva.");
    					exit;
    				}
    			}else{
            //Cuenta no existe pero se manda error de datos al ingresar
    				throw new Exception("Datos de inicio de sesión incorrectos.");
    				exit;
    			}
    		}catch(PDOException $ex){
    			echo $ex->getMessage();
    		}
    }

    public function iniciarSesionApp($id_usuario,$clave) {
    	try{
        $stmt = $this->dblink->prepare("SELECT u.id_usuario,
                                               u.clave,
                                               u.estado,
                                               p.paterno,
                                               p.materno,
                                               p.nombres,
                                               p.sexo,
                                               tp.id_tipo,
                                               tp.nombre as tipo
                                        FROM
                                        	usuario u inner join
                                          persona p on (u.id_persona=p.id_persona) inner join
                                          tipo_persona tp on (p.id_tipo_persona = tp.id_tipo)
                                        WHERE u.id_usuario=:id_usuario LIMIT 1");
				$stmt->bindParam(":id_usuario", $id_usuario);
				$stmt->execute();
				$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    			if($stmt->rowCount()){
            if($userRow['id_tipo'] != 2){
              throw new Exception("Esta aplicacin es solo para los estudiantes. Usted no tiene los permisos necesarios para iniciar sesión aquí");
            }
            if($userRow['estado']=="E"){
              throw new Exception("Usted ha sido restringido de la aplicación.");
            }
    				if($userRow['estado'] == "A"){              
    					if($userRow['clave'] == $clave){
      					unset($userRow['clave']);
                return $userRow;
    					}else{
                //Contraseña incorrecta pero se manda error de datos al ingresar
    						throw new Exception("Contraseña incorrecta.");
    						exit;
    					}
    				}else{
              //Cuenta inactiva
    					throw new Exception("Su cuenta se encuentra inactiva.");
    					exit;
    				}
    			}else{
            //Cuenta no existe pero se manda error de datos al ingresar
    				throw new Exception("Datos de inicio de sesión incorrectos.");
    				exit;
    			}
    		}catch(PDOException $ex){
    			echo $ex->getMessage();
    		}
    }

  public function comprobarSesion(){
		if(isset($_SESSION['id_usuario'])){
			return true;
		}else{
      return false;
    }
	}

	public function cerrarSesion(){
    session_start();
    unset($_SESSION['id_usuario']);
    unset($_SESSION['paterno']);
    unset($_SESSION['materno']);
    unset($_SESSION['nombres']);
    unset($_SESSION['sexo']);
    unset($_SESSION['tipo']);
    session_destroy();
	}

}
