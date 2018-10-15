<?php
// header('Access-Control-Allow-Origin: *');

require_once __DIR__.'/../datos/conexion.php';

class Sesion extends Conexion{

    public function iniciarSesion($id_usuario,$clave) {
    	try{
        $stmt = $this->dblink->prepare("SELECT *
                                        FROM
                                        	usuario u inner join
                                          persona p on (u.id_persona=p.id_persona)
                                        WHERE u.id_usuario=:id_usuario LIMIT 1");
				$stmt->bindParam(":id_usuario", $id_usuario);
				$stmt->execute();
				$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    			if($stmt->rowCount()){
            if($userRow['estado']=="E"){
              throw new Exception("Su registro al CONEII 2018 ha sido cancelado.");
            }
    				if($userRow['estado'] == "Y"){
    					if($userRow['clave'] == md5($clave)){
      					session_start();

                $fotovalidada = '';

                if ($userRow['url_foto'] === NULL) {
                  $fotovalidada = 'sin-foto.jpg';
                }else{
                  $fotovalidada = $userRow['url_foto'];
                }

                $_SESSION['userSession'] = $userRow['id_usuario'];
                $_SESSION['id_persona'] = $userRow['id_persona'];
                $_SESSION['correo'] = $userRow['correo'];
                $_SESSION['dni'] = $userRow['numero_documento'];
                $_SESSION['tipo'] = $userRow['id_area'];
                $_SESSION['delegado'] = $userRow['delegado'];
                $_SESSION['nombre'] = $userRow['nombres'];
                $_SESSION['paterno'] = $userRow['apellido_paterno'];
                $_SESSION['materno'] = $userRow['apellido_materno'];
                $_SESSION['sexo'] = $userRow['sexo'];
                $_SESSION['telefono'] = $userRow['telefono'];
                $_SESSION['cumple'] = $userRow['fecha_nacimiento'];
                $_SESSION['foto'] = $fotovalidada;
                $_SESSION['iduniv'] = $userRow['codUniv'];
                $_SESSION['univ'] = $userRow['univnomb'];
                $_SESSION['coduniv'] = $userRow['codigo_universitario'];
                $_SESSION['ciclo'] = $userRow['ciclo_academico'];
                $_SESSION['inscrip'] = $userRow['tipo'];
                $_SESSION['dep'] = $userRow['depart'];
                $_SESSION['cdep'] = $userRow['id_departamento'];
                $_SESSION['prov'] = $userRow['provi'];
                $_SESSION['cprov'] = $userRow['id_provincia'];
                $_SESSION['dist'] = $userRow['distri'];
                $_SESSION['cdist'] = $userRow['id_distrito'];
                $_SESSION['deuda'] = $userRow['estadoDeuda'];// -- N -> pago pediente     ## NM -> no inscrito    ##  S -> si pago
                $_SESSION['pais'] = $userRow['id_pais'];
                $_SESSION['etapa'] = $userRow['etapa'];
                $_SESSION['catreg'] = $userRow['categoria_registro'];
                $_SESSION['inscrito'] = $userRow['ins'];
                $_SESSION['id_etapa'] = $userRow['id_etapa'];
                return $userRow["id_area"];

    					}else{
                //Contraseña incorrecta pero se manda error de datos al ingresar
    						throw new Exception("N");
    						exit;
    					}
    				}else{
              //Cuenta inactiva
    					throw new Exception("I");
    					exit;
    				}
    			}else{
            //Cuenta no existe pero se manda error de datos al ingresar
    				throw new Exception("N");
    				exit;
    			}
    		}catch(PDOException $ex){
    			echo $ex->getMessage();
    		}
    }

  public function is_logged_in(){
		if(isset($_SESSION['userSession'])){
			return true;
		}
	}

	public function redirect($url){
		header("Location: $url");
	}

  public function updateInfo(){

  }

	public function logout(){
    session_start();
    unset($_SESSION['userSession']);
    unset($_SESSION['correo']);
    unset($_SESSION['dni']);
    unset($_SESSION['tipo']);
    unset($_SESSION['delegado']);
    unset($_SESSION['nombre']);
    unset($_SESSION['paterno']);
    unset($_SESSION['materno']);
    unset($_SESSION['sexo']);
    unset($_SESSION['telefono']);
    unset($_SESSION['foto']);
    unset($_SESSION['univ']);
    unset($_SESSION['coduniv']);
    unset($_SESSION['ciclo']);
    unset($_SESSION['inscrip']);
    unset($_SESSION['cumple']);
    unset($_SESSION['dep']);
    unset($_SESSION['cdep']);
    unset($_SESSION['prov']);
    unset($_SESSION['cprov']);
    unset($_SESSION['dist']);
    unset($_SESSION['cdist']);
    unset($_SESSION['etapa']);
    unset($_SESSION['catreg']);
    unset($_SESSION['deuda']);
    unset($_SESSION['pais']);
    unset($_SESSION['inscrito']);
    session_destroy();
	}

}
