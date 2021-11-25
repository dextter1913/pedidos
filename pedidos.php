<?php
include("incluidos/sessiones.php");
include_once("clases/pedidos.php");
$pedidos = new pedidos;
$listarpedidos = $pedidos->listar();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pedidos del sistema</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <?php include("incluidos/encabezado.php");?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="principal.php">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
  </ol>
</nav>
<h1>Listado de pedidos

<span class="text-right">
    <a href="pedidos-formulario.php" class="btn btn-success btn-sm" title="Click para crear un nuevo pedido">Nuevo pedido</a>
    <br>
</span>

</h1>

 <div class="container">
    <table class="table table-hover table-sm w-100">
        <thead class="">
            <tr>
                <th>Consecutivo</th>
                <th>Cliente</th>
                <th>Unidades</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listarpedidos as $pedido){?>
            <tr>
            <tr>
                <td><?php echo $pedido["id"];?></td>
                <td><?php echo $pedido["nombrecliente"];?></td>
                <td><?php echo $pedido["totalunidades"];?></td>
                <td><?php echo number_format($pedido["totalvalor"],0);?></td>
                <td><?php echo $pedido["fecharegistro"];?></td>
                <td>
                    <a href="pedidos.imprimir.php?id=<?php echo $pedido["id"];?>"  title="Click para imprimir" class="btn btn-dark btn-sm">Imprimir</a>
                </td>

            </tr>
        <?php  } ?>    

        </tbody>
    </table>
</div>

        <?php include("incluidos/footer.php");?>

    </body>
</html>

