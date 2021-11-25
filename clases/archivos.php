<?php
/*
clase para el manejo de archivos
esta clase permite subir archivos al servidor
y eliminarlos
*/
class archivos {

    function __construct()
    {   
        $this->ruta="assets/img/";
    }
    // vamos a crear otra funcion que pemita
    // usar esta ruta invocandolo en otros lugares fuera de la clase
    function cargaruta() {
        return $this->ruta;
    }
    function cargararchivos() {

        // se pueden usar las variables superglobales sin necesidad de pasarlas como argumento. algunas de ellas solo aparecen cuando se estan usando formularios y otras cuando se buscar caracteristicas del servidor o sessiones
        // formulario: $_GET, $_POST $_FILES
        // sessiones: $_SESSION
        // servidor: $_SERVER
        // entorno $_ENV
        // argumentales $argv
        // antes de caargar el archivo se pregunta si existe
        if ($_FILES['archivo']['name']<>"") {
            // agregarle un valor antes del nombre para evitar que se sobreescriba
            $nombre=date("Ymdhis").$_FILES['archivo']['name'];
            // capturar el nombre temporal que le asigna php para cargar el archivo
            $temporal=$_FILES['archivo']['tmp_name'];
            // ejecutar la funcion para mover el temporal  a la ruta final
            // move_uploaded_file
            $cargar=move_uploaded_file($temporal,$this->ruta.$nombre);
            if (!$cargar) { 
                $nombre=""; // que no pase nada
            }
        } else {
            $nombre="";
        }
        return $nombre;


    }
    // eliminacion del archivo
    function eliminararchivo($archivo) {
        if (is_file($archivo)) { 
            unlink($archivo);
        }
        return true;
    }

}