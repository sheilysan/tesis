<?php
class Conexion {
    protected $dblink;
    public function __construct() {
        $this->abrirConexion();
    }
    public function __destruct() {
        $this->dblink = NULL;
    }
    private function abrirConexion() {
        try {
            $this->dblink = new PDO("mysql:dbname=bd_tesis;host=localhost", "root", '');
            $this->dblink->exec("SET NAMES 'utf8', lc_time_names='es_PE', time_zone = '-05:00';");
            $this->dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $this->dblink;
    }
}
