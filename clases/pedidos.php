<?php
/*
Este script es para el manejo de los pedidos
*/
require_once("conexion.php");
class pedidos extends conexion{

    public function __construct()
    {
        parent:: __construct();
        $this->tabla="tblpedidose"; //
    }



    
    function registro() {
        // en vez de pasar los argumentos en la funcion
        // usaremos $_POST y recuperamos los valores
        // vamos a traer el cliente
        $cliente=$_POST['cliente'];
        $clientes=new clientes(); // instanciar para poder usarla dentro de otra clase
        $listadocliente=$clientes->listar($cliente);
        foreach($listadocliente as $filacliente) {
            $nombrecliente=$filacliente["nombre"];
            $telefonocliente=$filacliente["telefono"];
            $direccioncliente=$filacliente["direccion"];
        } 
        // con estos procedemos a realizar la insercion en la tabla 
        // pedidose
        $sql=" INSERT INTO tblpedidose (nombrecliente,telefonocliente,direccioncliente)  ";
        $sql.=" values ";
        $sql.=" ('$nombrecliente','$telefonocliente','$direccioncliente')  ";
        $this->conectar->query($sql);

        if ($this->conectar->errno>0) {
            $mensaje="<span class='btn btn-warning'>El pedido no se puede registrar.Valide los datos</span>";
        } else {
            // capturar el consecutivo de la insercion
            $numeropedido=$this->conectar->insert_id;
            $mensaje="<span class='btn btn-success'>El pedido numero ".$numeropedido." ha sido creado en el sistema</span>";
            // agregar los datos del detalle del pedido, pero lo vamos a hacer en otra funciones que se llama registro_detalle y le pasamos como argumento el numero de pedido. Esta funcion devolvera si el detalle ha sido ingresado  o no 
            $mensajedetalle=$this->registro_detalle($numeropedido);
        }
        return $mensaje;

    }
    function registro_detalle($numeropedido) { 
        // el proceso es recuperar los valores que estan en cada fila de detalle de producto: referencia, cantidad, preciounitario, subtotaliva y subtotal
        // pero ademas de esto, vamos a actualizar la tabla tblpedidose con los totalesunidades, subtotal y el total
        $totalunidades=0;
        $totalsubtotal=0;
        $totalsubtotaliva=0;
        $totalvalor=0;
        // como los input todos tienen la misma cantidad de filas y columnas 
        for($i=0;$i<count($_POST['referencia']);$i++) {
            // capturar los valores de cada input
            $referencia=$_POST['referencia'][$i];
            $cantidad=$_POST['cantidad'][$i];
            $preciounitario=$_POST['preciounitario'][$i];
            $subtotaliva=$_POST['subtotaliva'][$i];
            $subtotal=$_POST['subtotal'][$i];
            // insertar en base de datos
            $sql=" INSERT INTO tblpedidosd (pedido,referencia,cantidad,preciounitario,subtotal,subtotaliva) values ($numeropedido,'$referencia','$cantidad','$preciounitario','$subtotal','$subtotaliva') ";
            $this->conectar->query($sql);
            if ($this->conectar->errno>0) {
                $mensaje="<span class='btn btn-warning'>El detalle del pedido no se puede registrar.Valide los datos</span>";
            } else {
                $mensaje="";
            }
            $totalunidades+=$cantidad;
            $totalsubtotal=$totalsubtotal+($preciounitario*$cantidad);
            $totalsubtotaliva=$totalsubtotaliva+($preciounitario*$cantidad*$subtotaliva/100);
            $totalvalor=$totalvalor+$subtotal;

        }
        // actualizar en la tabla pedidose los totales
        $sql=" update tblpedidose set totalunidades='$totalunidades',subtotal='$totalsubtotal',subtotaliva='$totalsubtotaliva',totalvalor='$totalvalor' where id=$numeropedido ";
        $this->conectar->query($sql);
        if ($this->conectar->errno>0) {
            $mensaje.="<span class='btn btn-warning'>El pedido no se puede actualizar en los totales.Valide los datos</span>";
        }

        return $mensaje;
    }

    // la funcion listar tambien nos puede servir para traernos un registro especifico
    // lo que podemos hacer es que el argumento de la funcion pueda ser nulo o no 
    
    function listar($param="") {
        // esta funcion permite traer todos los registros de la base de datos
        $sql=" select id, nombrecliente, telefonocliente,direccioncliente, totalunidades,totalvalor,subtotal,subtotaliva,fecharegistro from ".$this->tabla;
        if ($param<>"") {
            $sql.=" where id=".$param;
        }
        $sql.=" order by id desc";
        $resultado=$this->conectar->query($sql);
        $data=array();
        if ($resultado->num_rows>0) {
            while($fila=$resultado->fetch_array()) {
                // por cada uno traer el detalle del pedido y pasarlo aca como un elemento mas del array
                $detallepedido=$this->detalle($fila["id"]);
                $fila+=array("detalle"=>$detallepedido);                
                $data[]=$fila;
            }
        }
        $resultado->close();
        return $data;
    }
    // detalle del pedido
    function detalle($id) {
        $sql=" select id, referencia, cantidad , preciounitario, subtotal,subtotaliva,total from tblpedidosd";
        $sql.=" where pedido=".$id;
        $sql.=" order by id asc";
        $resultado=$this->conectar->query($sql);
        //print_r($this->conectar);

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
