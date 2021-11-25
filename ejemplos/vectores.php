<?php
/*
Manejo de vectores
los vectores son variables multidimensionales
// tipos
// una sola linea
$var=[1,2,3,4,5];
// asociativos
$var=array("nombre"=>juan,"apellidos"=>fernandez)
// multidimensional
$var[]=array("nombre"=>juan,"apellidos"=>fernandez)
$var[]=array("nombre"=>pedro,"apellidos"=>perez)
*/
// ejemplos
//1. un vector basico
$numeros=array(1,2,3,4,5,6,7,8,9,10);
// imprimir una posicion
echo " El valor en la posicion 4 es ".$numeros[4];
// si queremos saber cuantos elementos tiene el vector
echo "<hr>";
echo "El total de posiciones del vector numeros es".count($numeros);
// un vector con datos tipo cadena o string
$meses=array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic");
// recorrerlo con un for
echo "<hr>";
for($i=0;$i<count($meses);$i++) {
echo "El mes en la posicion ".$i." es ".$meses[$i]."<br>";
}
echo "<hr>";
// imprimir el vector de manera completa para conocer todos sus elementos
print_r($meses);
// crear un arrar multidimensional o matriz
$usuarios[]=array("Nombre"=>"juan","Apellidos"=>"fernandez","correo"=>"juanff@gmail.com");
$usuarios[]=array("Nombre"=>"pedro","Apellidos"=>"perez","correo"=>"pedro@gmail.com");
$usuarios[]=array("Nombre"=>"carlos","Apellidos"=>"fernandez","correo"=>"carlos@gmail.com");
$usuarios[]=array("Nombre"=>"julian","Apellidos"=>"correa","correo"=>"julian@gmail.com");
$usuarios[]=array("Nombre"=>"jose","Apellidos"=>"alvarez","correo"=>"jose@gmail.com");
$usuarios[]=array("Nombre"=>"ana","Apellidos"=>"pelaez","correo"=>"ana@gmail.com");
echo "<hr>";
//print_r($usuarios);
for($i=0;$i<count($usuarios);$i++) {
    echo $usuarios[$i]["Nombre"]."<br>";
}
echo "<hr>";
// uso del foreach. Solo aplicar para vectores asociativos
foreach($usuarios as $fila) {
    echo $fila["Nombre"]."<br>";
    
}
