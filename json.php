<?php
//este script permite devolver parametros y devolver una respuesta al origen de la peticion
include("incluidos/sessiones.php");
if (sizeof($_GEWT)>0 && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pedido = new pedidos();
    $detalle = $pedido->listar($_GET['id']);
    // enviemos el resultado hacia el origen de la peticion
    // los vamos a enviar usando json
    echo json_encode($detalle);
}