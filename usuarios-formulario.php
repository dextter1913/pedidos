<?php
include("incluidos/sessiones.php");
include("clases/usuarios.php");
$registro=new usuarios();

$nombre="";
$correo="";
$telefono="";
$estado="";
$id=0;
if (isset($_GET['id']) && $_GET['id']>0) {
    $id=$_GET['id'];
}

// CRUD usuarios.php
// validar si se envio el formulario, pasamos los parametros al metodo registro de la clase usuarios e imprimos por ahora el mensaje que arroja la funcion
if (sizeof($_POST)>0) {
    // validar que todos los datos tengan informacion    
    if ($_POST['correo']<>"" && $_POST['telefono']<>"" && $_POST['nombre']<>"" && $_POST['estado']<>"") { 
        if ($id>0) {
            // actualizar el registro
            $mensaje=$registro->actualizar($_POST['nombre'],$_POST['clave'],$_POST['telefono'],$_POST['estado'],$_POST['correo'],$id);

        } else {
            // inxsertar el registro
            $mensaje=$registro->registro($_POST['nombre'],$_POST['clave'],$_POST['telefono'],$_POST['estado'],$_POST['correo']);

        }
        //echo $mensaje;
    }
} 
//  este mismo formulario lo podemos usar para actualizar el registro
// validamos que pasemos el id, consultamos los datos, los traemos en variables y los pasamos
// a cada uno de los input del formulario
if ($id>0) {
        // invocar la clase con el parametro id para traer los datos
        // del registro deseado
        $lista=$registro->listar($id);
        // si llegan datos los recorremos con un foreach
        foreach ($lista as $fila) {
           $nombre=$fila["nombre"];
           $correo=$fila["correo"];
           $telefono=$fila["telefono"];
           $estado=$fila["estado"];

        }

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Usuarios del sistema</title>
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
    <li class="breadcrumb-item" ><a href="usuarios.php">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Registro</li>
  </ol>
</nav>
<h1>Registro</h1>
<div class="container-fluid">

   <form method="POST" name="frm" id="frm" action="usuarios-formulario.php?id=<?php echo $id;?>" enctype="multipart/form-data">
    <div class="row p-2">
        <div class="col col-6">
            <label for="correo">Correo electronico</label>
            <input type="email" name="correo" id="correo" class="form-control" placeholder="digite su correo" required value="<?php echo $correo;?>">
        </div>
        <div class="col col-6">
            <label for="clave">Clave del usuario</label>
            <input type="password" name="clave" id="clave" class="form-control" placeholder="digite su clave" value="">
        </div>
    </div>
    <div class="row p-2">
        <div class="col col-6">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="digite su nombre" required value="<?php echo $nombre;?>">
        </div>
        <div class="col col-6">
            <label for="telefono">Telefono</label>
            <input type="number" name="telefono" id="telefono" class="form-control" placeholder="digite su telefono" required value="<?php echo $telefono;?>">
        </div>
    </div>

    <div class="row p-2">
        <div class="col col-6">
        </div>
        <div class="col col-6">
            <label for="estado">Activar este registro</label>
            <select name="estado" id="estado" class="form-control">
            <option value="1" <?php if ($estado=="1") echo "selected";?>>SI</option>
            <option value="2" <?php if ($estado=="2") echo "selected";?>>NO</option>
            </select>
        </div>
    </div>
    <div class="row p-2">
    <div class="col col-4">
    </div>
        <br>
        <div class="col col-4">
    <?php
        if (isset($mensaje)) {
            echo $mensaje;
        }
    ?>
        </div>
        <div class="col col-4 text-right">
            <a href="usuarios.php" class="btn btn-danger">Cancelar</a>
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

