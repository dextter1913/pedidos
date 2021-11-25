<?php
// Esto es un comentario
/*
Estgo es un comentario 
mas
extneso
o blque de terxto
*/
//1. como se instancia una variable
$nombre="Juan Fernando Fernandez";
//2. imprimir una variable en pantalla
echo $nombre;
echo "<hr>";
// 3. cambiar la naturaleza de una variable
$nombre="123000";
echo $nombre;
echo "<hr>";
// 4. operaciones con variables o constantes
// 4.1. definir una constante
define("PI","3.141621");
// 4.2. multiplicar la variable y la constante
$total=$nombre*PI;
echo $total;
// 5. concatenar texto y operaciones
echo "<hr>";
$resultado=$total+12536;
echo "El resultado final es ".$resultado;
// 6. combinar etiquetas html en una impresion
echo "<hr>";
echo "<h1>El resultado final es ".$resultado."</h1>";


?>