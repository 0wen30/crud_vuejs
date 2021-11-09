<?php

class ApptivaDB{

    private $host = "localhost";
    private $usuario = "root";
    private $clave = "usbw";
    private $db = "vue";
    private $conexion;

    public function __construct(){
        $this->conexion = new mysqli($this->host,$this->usuario,$this->clave,$this->db);
        $this->conexion->set_charset("utf-8");
    }

    public function insertar($tabla, $datos){
        return $this->conexion->query("INSERT INTO $tabla VALUES (null,$datos)") or die($this->conexion->error);
    }
    public function borrar($tabla, $condicion){
        return $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die($this->conexion->error);
    }
    public function actualizar($tabla, $campos, $condicion){
        return $this->conexion->query("UPDATE $tabla SET $campos WHERE $condicion") or die($this->conexion->error);
    }
    public function buscar($tabla, $condicion){
        $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : false;
    }
}

?>