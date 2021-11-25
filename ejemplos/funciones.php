<?php
/*
las funcioens son bloques de codigo que se pueden ejecutar
y que se pueden reutilizar
las funciones pueden invocar variables globales y locales
una funcion puede retornar un valor o invocar otra funcion
una funcion si esta en una clase puede ser privada o publica 
*/
//1 funcion que permita enviarles tres parametros. estos parametros son obligatorios
function operaciones($a,$b,$tipo) { 
    $total=0;
    if(!is_numeric($a) || !is_numeric($b)){
        return "Error, los valores deben ser numericos";
    }
    switch ($tipo) {
        case '+':
            $total=$a+$b;
            break;
        case '-':
            $total=$a-$b;
            break;
        case '*':
            $total=$a*$b;
            break;
        case '/':
            if ($b>0) {
                $total=$a/$b;
            } else {
                $total="No se puede dividir entre 0";
            }
            break;
        default:
            $total="El simbolo no es valido";
            break;
    }
    return $total;
}
// invocar la funcion
echo operaciones(10,5,'+');
echo "<br>";
echo operaciones(10,5,'-');
echo "<br>";
echo operaciones(10,5,'*');
echo "<br>";
echo operaciones(10,5,'/');
echo "<br>";
echo "<hr>";
// invocar la funcion dentro de ella
echo operaciones(operaciones(45,12,"-"),5,'+')."<br>";
echo "<hr>";
// forzar un error
echo operaciones(10,'+');
