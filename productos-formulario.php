<?php
include("incluidos/sessiones.php");
// CRUD productos.php
include("clases/productos.php");
$registro=new productos();

$nombre="";
$referencia="";
$descripcion="";
$estado="";
$valorbase="";
$iva="";
$imagen="";

$id=0;
if (isset($_GET['id']) && $_GET['id']>0) {
    $id=$_GET['id'];
}
if (sizeof($_POST)>0) {
    if ($_POST['referencia']<>"" && $_POST['descripcion']<>"" && $_POST['valorbase']<>"" && $_POST['nombre']<>"" && $_POST['estado']<>"") { 
        if ($id>0) {
            $mensaje=$registro->actualizar($_POST['nombre'],$_POST['valorbase'],$_POST['descripcion'],$_POST['estado'],$_POST['referencia'],$_POST['iva'],$id);

        } else {
            $mensaje=$registro->registro($_POST['nombre'],$_POST['valorbase'],$_POST['descripcion'],$_POST['estado'],$_POST['referencia'],$_POST['iva']);

        }
    }
} 
if ($id>0) {
    $lista=$registro->listar($id);
    foreach ($lista as $fila) {
        $nombre=$fila["nombre"];
        $referencia=$fila["referencia"];
        $descripcion=$fila["descripcion"];
        $estado=$fila["estado"];
        $valorbase=$fila["valorbase"];
        $iva=$fila["iva"];
        $imagen=$fila["imagen"];


     }

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
    <li class="breadcrumb-item" ><a href="productos.php">Productos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Registro</li>
  </ol>
</nav>
<h1>Registro</h1>
<div class="container-fluid">

   <form method="POST" name="frm" id="frm" action="?id=<?php echo $id;?>" enctype="multipart/form-data">
    <div class="row p-2">
        <div class="col col-6">
            <label for="referencia">Referencia</label>
            <input type="text" name="referencia" id="referencia" class="form-control" placeholder="digite su referencia" required value="<?php echo $referencia;?>">
        </div>
        <div class="col col-6">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="digite su nombre" required value="<?php echo $nombre;?>">
        </div>
    </div>
    <div class="row p-2">
        <div class="col col-6">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="digite su descripcion" required value="<?php echo $descripcion;?>">
        </div>
        <div class="col col-6">
            <label for="valorbase">Valor base</label>
            <input type="number" name="valorbase" id="valorbase" class="form-control" placeholder="digite su valor base" required value="<?php echo $valorbase;?>" min=1>
        </div>
    </div>

    <div class="row p-2">
        <div class="col col-6">
            <label for="celular">% IVA</label>
            <input type="number" name="iva" id="iva" class="form-control" placeholder="digite su % de IVA" value="<?php echo $iva;?>" min=0>
        </div>
        <div class="col col-6">
            <label for="activo">Activar este registro</label>
            <select name="estado" id="estado" class="form-control">
            <option value="1" <?php if ($estado=="1") echo "selected";?>>SI</option>
            <option value="2" <?php if ($estado=="2") echo "selected";?>>NO</option>
            </select>
        </div>
    </div>
    <div class="row p-2">
    <div class="col col-4">
    <?php
        // validar si la imagen existe
        // preguntar si esta en la carpeta definida para subirla
        if ($imagen<>"") {
            $archivo=new archivos;
            $ruta=$archivo->cargaruta();
            if (is_file($ruta.$imagen)) {
                 ?>
                 <img src="<?php echo $ruta.$imagen;?>" class="image" style="width:120px;">
                 <br>
                 <input type="checkbox" name="borrar" id="borrar" value="1"> Eliminar imagen
                 <?php   
            }
        }
    ?> 
    <br>
    <input type="file" name="archivo" id="archivo" class="form-control">
    <input type="hidden" name="nombrearchivo" id="nombrearchivo" value=">">
    </div>
        <br>
        <div class="col col-4">
        <?php
        if (isset($mensaje)) {
            echo $mensaje;
        }
        ?>        </div>
        <div class="col col-4 text-right">
            <a href="productos.php" class="btn btn-danger">Cancelar</a>
            <button class="btn btn-secondary" id="boton" name="boton" >Guardar Registro</button>
        </div>
    </div>
   </form>


</div>
<br>
<br>
        <?php include("incluidos/footer.php");?>

    </body>
</html>

