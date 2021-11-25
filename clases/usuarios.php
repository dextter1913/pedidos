<?php
/*
Este script es para el manejo de las operaciones con los usuarios
vamos a heredar la conexion de conexion.php
Para eso usaremos la opcion de cargar dentro de una clase 
heredada el constructor de la clase padre
*/
require_once("conexion.php");
class usuarios extends conexion{

    public function __construct()
    {
        parent:: __construct();
        $this->tabla="tblusuarios"; // esta variable se usara en todo el ambito de la clase
    }

    function validar_acceso($login,$clave) {
        // crear un array vacio
        $data=array();
        //crear una consulta
        $sql=" select id, nombre,clave,correo from ".$this->tabla." where correo='$login' and estado=1";
        $resultado=$this->conectar->query($sql);
       
        if ($resultado->num_rows==1) {
            $fila=$resultado->fetch_array();
            // comparar la clabve encriptada con la clave digitada
            // para eso usaremos password_verify que compara la clave digitada
            // con la clave encriptada en la base de datos
            // y ese resultado devuelve true o false
            $compara=password_verify($clave,$fila["clave"]);
            if ($compara) {
                $data[]=$fila; // aca se almacena los datos en un array
            }
        }    
        $resultado->close();
        return $data;
    }

    // metodo para actualizar el registro pedido
    // los parametros son los mismo de la insercion pero agregando el id del registro
    function actualizar($nombre,$clave,$telefono,$estado, $correo,$id) {
        $sql=" update ".$this->tabla." set ";
        $sql.=" nombre='$nombre',telefono='$telefono',estado='$estado'";
        if ($clave<>"") {
            $clave=password_hash($clave,PASSWORD_DEFAULT); // encriptamos la clave
            $sql.=",clave='$clave'";
        }
        $sql.=" where id=".$id;
        $this->conectar->query($sql);
        if ($this->conectar->errno>0) {
            $mensaje="<span class='btn btn-warning'>El registro no se puede modificar. Intente de nuevo</span>";

        } else {
            $mensaje="<span class='btn btn-success'>El registro ha sido modificado con exito</span>";
        }    
        return $mensaje;


    }

    function registro($nombre,$clave,$telefono,$estado, $correo) {
        // esta funcion permite registrar el usuario
        // para eso usaremos la sentencia insert
        // y evaluamos si registra o no el dato
        // ademas validaremos si el registro ya se encuentra duplicado
        // para evitar el query inicial de existencia del registro
        // el campo que no se pueda repetir lo volvemos unico en la tabla respectiva
        // y cuando la ejecucion devuelva que es duplicado capturamos ese error y lo enviamos como respuesta
        if ($clave<>"") { 
            $clave=password_hash($clave,PASSWORD_DEFAULT); // encriptamos la clave
        }
        // crear la sentencia insert
        $sql=" insert into ".$this->tabla." (correo,nombre,estado,telefono,clave) values ('$correo','$nombre','$estado','$telefono','$clave') ";
        $this->conectar->query($sql);
        // capturar los errores. 
        // si no traer errores es porque la sentencia de insercion funciono
        // en caso contrario puede haber problemas de sintaxis o el registro 
        // esta duplicado    
        if ($this->conectar->errno>0) {
            
            $mensaje=$this->conectar->errno;
            if ($mensaje==1062) { 
                $mensaje="<span class='btn btn-warning'>El registro ya existe previamente. Intente de nuevo</span>";
            }
        } else {
            $mensaje="<span class='btn btn-success'>Registro realizado con exito</span>";
        }

        return $mensaje;

    }

    // la funcion listar tambien nos puede servir para traernos un registro especifico
    // lo que podemos hacer es que el argumento de la funcion pueda ser nulo o no 
    
    function listar($param="") {
        // esta funcion permite traer todos los registros de la base de datos
        $sql=" select id, nombre, correo , telefono, estado,fecharegistro from ".$this->tabla;
        if ($param<>"") {
            $sql.=" where id=".$param;
        }
        $sql.=" order by nombre asc";
        // como ya tenemos el this->conectar ejeutamos una funcion propia de ese objeto que se llama query y los select devuelven contenido entonces se pueden almacenar o asociar a una variable
        $resultado=$this->conectar->query($sql);
        //print_r($this->conectar);
        // al usar query internamente nos permite consultar los resultados de varias maneras:
        // num_rows: permite saber cuantos registros
        // fetch_object: traer los resultados como un objeto
        // fetch_array: traer los resultados como un array
        // close: para cerrar el query
        $data=array();
        if ($resultado->num_rows>0) {
            while($fila=$resultado->fetch_array()) {
                $data[]=$fila;
            }
        }
        $resultado->close();
        return $data;
    }
    function eliminar($param) {

        if ($param>0) {
            $sql="delete from ".$this->tabla." where id=".$param;
            $this->conectar->query($sql);
            if ($this->conectar->errno>0) {
                $mensaje="<span class='btn btn-warning'>El registro no se puede eliminar</span>";
            } else {
                $mensaje="<span class='btn btn-success'>El registro eliminado del sistema. Este proceso no se puede devolver</span>";
            }    

        } else {
            $mensaje="<span class='btn btn-danger'>El parametro no es valido</span>";
        }

        return $mensaje;

    }

}
/* $usuario=new usuarios();
$listar=$usuario->listar();
print_r($listar); */
