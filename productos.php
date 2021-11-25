<?php
include("incluidos/sessiones.php");
include("clases/productos.php");
$registro=new productos;
if (sizeof($_GET)>0) {
    $mensaje=$registro->eliminar($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Productos del sistema</title>
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
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
  </ol>
</nav>
<h1>Listado de productos

<span class="text-right">
    <a href="productos-formulario.php" class="btn btn-success btn-sm" title="Click para crear un nuevo registro">Nuevo registro</a>
    <br>
</span>

</h1>

 <div class="container">
    <table class="table table-hover table-sm w-100">
        <thead class="">
            <tr>
                <th>Foto</th>
                <th>Fecha</th>
                <th>Ref</th>
                <th>Nombre</th>
                <th>Valor base</th>
                <th>IVA</th>
                <th>Precio</th>
                <th>Activo</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php 
          $listado=$registro->listar();
          foreach($listado as $fila) {
        ?>
            <tr>
                <td>
                <?php
                // validar si la imagen existe
                // preguntar si esta en la carpeta definida para subirla
                if ($fila["imagen"]<>"") {
                    $archivo=new archivos;
                    $ruta=$archivo->cargaruta();
                    if (is_file($ruta.$fila["imagen"])) {
                        ?>
                        <img src="<?php echo $ruta.$fila["imagen"];?>" class="image" style="width:120px;">
                        <?php   
                    }
                }
                ?> 
                </td>
                <td><?php echo $fila['fecharegistro'];?></td>
                <td><?php echo $fila['referencia'];?></td>
                <td><?php echo $fila['nombre'];?></td>
                <td><?php echo number_format($fila['valorbase'],0);?></td>
                <td>%<?php echo $fila['iva'];?></td>
             
                <td><?php 
                $precio=$fila['valorbase']*(1+($fila['iva']/100));
                $precio=number_format($precio,0);
                echo $precio;
                ?></td>


                </td>
                <td>
                <?php if ($fila["estado"]==1) {?>
                    <span class="btn-success btn-sm">Activo</span>
                <?php } else {?>
                    <span class="btn-danger btn-sm">Inactivo</span>
                <?php } ?>    
                
                </td>

                <td>
                    <a href="productos-formulario.php?id=<?php echo $fila["id"];?>"  title="Click para modificar" class="btn btn-info btn-sm">Modificar</a>
                    <a href="?id=<?php echo $fila["id"];?>"  title="Click para eliminar" class="btn btn-danger btn-sm">[X]</a>
                </td>

            </tr>
        <?php 
          }
        ?>    

        </tbody>
    </table>
</div>

        <?php include("incluidos/footer.php");?>

    </body>
</html>

