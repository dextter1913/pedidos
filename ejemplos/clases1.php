<?php
// heredar una clase 
// esta opcion permite traer todos lo que contiene una clase
// a otra clase
include("clases.php");
// crear una clase que hereda de otra
class cotizador extends matematicas {
    function valorventa($costo,$utilidad,$impuesto) {
    
        if(!is_numeric($costo) || !is_numeric($utilidad) || !is_numeric($impuesto)) {
            return "Error: Los valores deben ser numericos";
        }
        if ($utilidad<=0) {
            return "Error: Revisa la utilidad";
        }
        if ($impuesto<0) {
            return "Error: El impuesto no puede ser negativo";
        }
        if ($costo<=0) {
            return "Error: El costo no puede ser negativo o cero";
        }

        // calcular primero el valor del impuesto
        $base=$costo+($costo*($utilidad/100));
        $valorimpuesto=$this->impuesto($base,$impuesto);
        // calcular el valor de venta
        $venta=$base+$valorimpuesto;
        return $venta;
    }
}
$cotizar=new cotizador();
$valorproducto=$cotizar->valorventa(10000,30,19);
echo "El valor del producto es: ".$valorproducto;
$valor

