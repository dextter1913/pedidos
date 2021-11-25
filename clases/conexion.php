<?php
//error_reporting(E_ALL);
//ini_set("display_errors","On");
/*
Este script permite conectarse a la base de datos
y se usara como una clase para todas las clases que necesiten
una conexion a la base de datos
la conexion se realiza en el constructor
y este se heredara a las clases que lo requieran

*/
class conexion {
    public function __construct() { 
        if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
        if (!defined('DB_USER')) define('DB_USER', 'root');
        if (!defined('DB_PASS')) define('DB_PASS', '');
        if (!defined('DB_NAME')) define('DB_NAME', 'cursophp');
        $this->conectar = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conectar->connect_errno>0) {
            die("Se genero un error de conexion. Reviselo o contacte a su proveedor");
            exit(); 

        }

    }    
    
}
// testeo de la conexion
//$con=new conexion();