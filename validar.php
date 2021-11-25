<?php
/*
Este script permoite recibir los datos del formulario que viene del index.php
y realiza las siguientes funciones

1. validar que se hayan enviados los parametros desde ese formulario
2. validar que tanto el usuario como la clave esten llenos
3. crear variables de session para poder blindar el aplicativo
4. una vez creadas redireccionarlo a principal
si los puntos 1 y 2 no son validos entonces que lo devuelva al index.php
*/
// 1. las variables que vienen de un formulario se recuperan dependiendo del metodo que se use en el:
// POST: $_POST
// GET: $_GET
// si se desea por cualquiera de los dos se usa $_REQUEST
// estas variables que se conocen superglobales son en el fondo un array
if (sizeof($_POST)>0) {
    // 2. Validar que tanto login como clave esten llenos y a la vez existan
    // para validar la existencia de una variable se usa isset
    if (isset($_POST['login']) && $_POST['login']<>"" && isset($_POST['clave']) && $_POST['clave']<>"")  { 
        // activar las sessiones
        session_start();
/*         $_SESSION['s_login']=$_POST['login'];
        $_SESSION['s_clave']=$_POST['clave']; */
        // validar el acceso consultando el usuario en la clase usuarios
        include("clases/usuarios.php");
        $registro=new usuarios;
        // vamos a ejecuta el validar_registro
        $validar=$registro->validar_acceso($_POST['login'],$_POST['clave']);
        
        if (sizeof($validar)>0) {
            foreach ($validar as $fila) {
                $_SESSION['s_login']=$_POST['login'];
                $_SESSION['s_nombre']=$fila['nombre'];
                $_SESSION['s_correo']=$fila['correo'];
                $_SESSION['s_idusuario']=$fila['id'];
            }
            header("Location: principal.php");
        } else {
            header("Location: index.php");

        }

    } else { 
        header("Location: index.php");
    }

} else {
    header("Location: index.php");
}






