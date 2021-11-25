<?php
/*
productos
*/
require_once("conexion.php");
include("archivos.php");
class productos extends conexion{

    public function __construct()
    {
        parent:: __construct();
        $this->tabla="tblproductos"; // esta variable se usara en todo el ambito de la clase
    }

    // funcion que permite interactuar con archivos.php
    function actualizararchivo($id) {
        $archivo=new archivos;
        $nombre=$archivo->cargararchivos();
        //si el nombre es diferente de vacio, actualice
        // la tabla en el campo imagen
        if ($nombre<>"") {
            $sql=" update ".$this->tabla." set imagen='$nombre' where id=".$id;
            $this->conectar->query($sql);
        }

        return true;

    }


    function actualizar($nombre,$valorbase,$descripcion,$estado, $referencia,$iva,$id) {
        $sql=" update ".$this->tabla." set ";
        $sql.=" nombre='$nombre',descripcion='$descripcion',iva='$iva',estado='$estado'";
        $sql.=",valorbase='$valorbase'";
        $sql.=" where id=".$id;
        $this->conectar->query($sql);
        if ($this->conectar->errno>0) {
            $mensaje="<span class='btn btn-warning'>El registro no se puede modificar. Intente de nuevo</span>";

        } else {
            $mensaje="<span class='btn btn-success'>El registro ha sido modificado con exito</span>";
        }    
        // preguntar si borrar es igual a 1 entonces invocar funcion que 
        // permite borrar fisicamente el archivo y actualizar el campo imagen a vacio o nada
        if ($_POST["borrar"]=="1") {
            $this->borrararchivo($id); //esta borrar el archivo
        } else {
            $this->actualizararchivo($id); // esta ingresa un nuevo archivo
        }
        return $mensaje;


    }

    function borrararchivo($id) {
        // este proceso realiza lo siguiente
        // 1. consulta el nombre de la imagen en la tabla productos
        // 2. borrar la imagen fisicamente con la funcion eliminararchivo
        // 3. actualizar a nulo o vacio en la tabla productos
        $consulta=$this->listar($id);
        foreach($consulta as $fila) {
            $imagen=$fila["imagen"];
            $archivo=new archivos;
            $ruta=$archivo->cargaruta();
            $archivo->eliminararchivo($ruta.$imagen); 
            $sql=" update ".$this->tabla." set imagen='' where id=".$id;
            $this->conectar->query($sql);
        }
        return true;
    }

    function registro($nombre,$valorbase,$descripcion,$estado, $referencia,$iva) {
        // crear la sentencia insert
        $sql=" insert into ".$this->tabla." (referencia,nombre,estado,descripcion,valorbase,iva) values ('$referencia','$nombre','$estado','$descripcion','$valorbase','$iva') ";
        $this->conectar->query($sql);
        if ($this->conectar->errno>0) {
            
            $mensaje=$this->conectar->errno;
            if ($mensaje==1062) { 
                $mensaje="<span class='btn btn-warning'>El registro ya existe previamente. Intente de nuevo</span>";
            }
        } else {
            $mensaje="<span class='btn btn-success'>Registro realizado con exito</span>";
        }
        $this->actualizararchivo($this->conectar->insert_id);
        return $mensaje;

    }

    function listar($param="") {
        // esta funcion permite traer todos los registros de la base de datos
        $sql=" select id, nombre, referencia,imagen,valorbase,iva , descripcion, estado,fecharegistro,valorbase from ".$this->tabla;
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