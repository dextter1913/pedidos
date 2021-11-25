<?php
/*
Clientes
*/
require_once("conexion.php");
class clientes extends conexion{

    public function __construct()
    {
        parent:: __construct();
        $this->tabla="tblclientes"; // esta variable se usara en todo el ambito de la clase
    }


    function actualizar($nombre,$direccion,$telefono,$estado, $correo,$id) {
        $sql=" update ".$this->tabla." set ";
        $sql.=" nombre='$nombre',telefono='$telefono',estado='$estado'";
        $sql.=",direccion='$direccion'";
        $sql.=" where id=".$id;
        $this->conectar->query($sql);
        if ($this->conectar->errno>0) {
            $mensaje="<span class='btn btn-warning'>El registro no se puede modificar. Intente de nuevo</span>";

        } else {
            $mensaje="<span class='btn btn-success'>El registro ha sido modificado con exito</span>";
        }    
        return $mensaje;


    }

    function registro($nombre,$direccion,$telefono,$estado, $correo) {
        // crear la sentencia insert
        $sql=" insert into ".$this->tabla." (correo,nombre,estado,telefono,direccion) values ('$correo','$nombre','$estado','$telefono','$direccion') ";
        $this->conectar->query($sql);
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

    function listar($param="") {
        // esta funcion permite traer todos los registros de la base de datos
        $sql=" select id, nombre, correo , telefono, estado,fecharegistro,direccion from ".$this->tabla;
        if ($param<>"") {
            $sql.=" where id=".$param;
        }
        $sql.=" order by nombre asc";
        $resultado=$this->conectar->query($sql);
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