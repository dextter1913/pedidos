<?php
// este script es para explicar el manejo de condicionales
/*

if (evaluar) {

}elseif() {

} else {

}

() ? resp:resp1 ;
*/

// 1. manejo de boleanos
$entrada=false;
if ($entrada) { 
 echo "La entrada es verdadera";
} else {
    echo "La entrada es falsa";
}
echo "<hr>";
// 2. comparacion de resultados en un condicional
$precio=10000;
$iva=16;
$venta=$precio +($precio*$iva/100);

if ($venta>=100000 && $venta<=170000 && $iva>0) {
    echo "El precio es ideal";
}elseif($venta>170000 && $iva>0) { 
    echo "El precio es elevado";
} elseif ($iva>0) {
    echo "El precio esta por debajo";
} else {
    echo "Debo validar que el iva sea mayor de cero";
}
// 3. El mismo del anterior pero con un if con el iva>0
echo "<hr>";
if ($iva>0) { 
    if ($venta>=100000 && $venta<=170000) {
        echo "El precio es ideal";
    }elseif($venta>170000) { 
        echo "El precio es elevado";
    } else {
        echo "El precio esta por debajo";
    }
} else {
    echo "Debo validar que el iva sea mayor de cero";
}






