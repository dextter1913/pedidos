<?php
include("incluidos/sessiones.php");
// crear el include que valide que las sessiones no estan activas
// no lo deje pasar
include_once("clases/clientes.php");
$clientes=new clientes;
$listadocliente=$clientes->listar();
include_once("clases/usuarios.php");
$usuarios=new usuarios;
$listadousuarios=$usuarios->listar();
include_once("clases/productos.php");
$productos=new productos;
$listadoproductos=$productos->listar();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Principal del sistema</title>
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
    <li class="breadcrumb-item active" aria-current="page">Bienvenido al sistema, <?php echo $_SESSION['s_nombre'];?></li>
  </ol>
</nav>

<br>
        <div class="container">

            <div class="row">
    
                <div class="panel panel-info col-4">
                        <div class="panel-heading">Usuarios <span class="badge badge-danger text-right"><?php echo sizeof($listadousuarios);?></span></div>
                        <div class="panel-body" style="height: 320px;">

                        <table class="table table-striped table-sm" >
                            <thead class="">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php

                                $i=0;
                                foreach($listadousuarios as $usuario){
                                $i++;
                                if ($i<=3) {
                                ?>
                                <tr>
                                    <td><?php echo $usuario['fecharegistro'];?></td> 
                                     </td>
                                    <td><?php echo $usuario['correo'];?></td>
                                    <td><?php echo $usuario['nombre'];?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        </div>

                        <div class="panel panel-footer text-right" >
                        <a href="usuarios.php" class="btn btn-dark btn-sm">Ir al modulo</a>
                        </div>

                </div>

                <div class="panel panel-info col-4">
                        <div class="panel-heading">Clientes <span class="badge badge-danger text-right"><?php echo sizeof($listadocliente); ?></span></div>
                        <div class="panel-body" style="height: 320px;">

                        <table class="table table-striped table-sm">
                            <thead class="">
                                <tr>
                                    <th>Fecha</th>
                                    <th>NIT</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                foreach($listadocliente as $cliente){
                                $i++;
                                if ($i<=5) {
                                ?>
                                <tr>
                                    <td><?php echo $cliente['fecharegistro'];?></td>
                                    <td><?php echo $cliente['nombre'];?></td>
                                    <td><?php echo $cliente['correo'];?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                        </div>
                        <div class="panel panel-footer text-right" >
                        <a href="clientes.php" class="btn btn-dark btn-sm">Ir al modulo</a>
                        </div>

                    </div>

                <div class="panel panel-info col-4">
                        <div class="panel-heading">Productos <span class="badge badge-danger text-right"><?php echo sizeof($listadoproductos); ?></span></div>
                        <div class="panel-body" style="height: 320px;">
                        <table class="table table-striped table-sm">
                            <thead class="">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Ref</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                foreach($listadoproductos as $producto){
                                $i++;
                                if ($i<=5) {
                                ?>
                                <tr>
                                    <td><?php echo $producto['fecharegistro'];?></td>
                                    <td><?php echo $producto['referencia'];?></td>
                                    <td><?php echo $producto['nombre'];?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            
                            </tbody>
                        </table>
                        </div>
                        <div class="panel panel-footer text-right" >
                        <a href="productos.php" class="btn btn-dark btn-sm">Ir al modulo</a>
                        </div>

                </div>

            </div>
         </div>

        <?php include("incluidos/footer.php");?>

    </body>
</html>

