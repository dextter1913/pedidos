<?php
// el case permite evaluar valores determinados y es una alternativa
// para el if
/*
switch (variable) { 
    
    case 

    default
}
*/
// evaluar de una division si el valor da 1 que imprima resultado deficiente, 2 resultado regular, 3 resultado bueno, 4 resultado excelente
$valor1=12;
$valor2=4;
$resultado=$valor1/$valor2;
switch ($resultado) {
    case '1':
        echo "El resultado es <span style='color:red'>deficiente</span>";
        break;
    case '2':
        echo "El resultado es regular";
        break;
    case '3':
        echo "El resultado es bueno";
        break;
    case '4':
        echo "El resultado es excelente";
        break;
    default:
        echo "No esta dentro del parametro a evaluar";
        break;
}
