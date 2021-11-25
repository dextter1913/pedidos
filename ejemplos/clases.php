<?php
/*
Las clases son la forma de presentar un objeto en php
Dentro de una clase se puede invocar funciones, heredar
propiedades y funciones de otra clase, volverla estatica,
entre otros
*/
class matematicas {
    // una clase se puede instancias variables
    //  o usar un metodo que permite crear 
    // datos globales para todas las funciones de la case
    // este metodo constructor
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
    function impuesto($valor,$porcentaje) {
        if (!is_numeric($valor) || !is_numeric($porcentaje)) {
            return "Error, los valores deben ser numericos";
        }
        $total=($valor*$porcentaje/100);
        // agregar decimales
        $total=number_format($total,2,".","");
        return $total;

    }
}
// se crea una instancia de la clase
/*$mat=new matematicas();
echo $mat->operaciones(10,5,'+');
echo "<br>";*/
