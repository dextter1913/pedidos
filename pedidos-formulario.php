<?php
include("incluidos/sessiones.php");
// modo testing
include_once("clases/productos.php");
$productos=new productos;
$listadoproductos=$productos->listar();
include_once("clases/clientes.php");
$clientes=new clientes;
$listadocliente=$clientes->listar();
$mensaje="";
if(sizeof($_POST)>0){
    // invocar la clase pedidos y dentro de ella el metodo registro
    include("clases/pedidos.php");
    $pedidos=new pedidos;
    $mensaje=$pedidos->registro();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Realizar pedido</title>
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
    <li class="breadcrumb-item" ><a href="pedidos.php">Productos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Registro</li>
  </ol>
</nav>
<h1>Nuevo pedido</h1>
<form method="POST" name="frm" id="frm" action="?id=1" enctype="multipart/form-data">

<div class="container-fluid">
    <div class="row p-2">
        <div class="col col-6">
            <select name="ref" id="ref" class="form-control" placeholder="digite su correo" required onchange="agregar_pedido();">
                <option value="">...Producto...</option>
                <?php
        foreach ($listadoproductos as $producto) {
            echo "<option  value='".$producto['id']."|".$producto['nombre']."|".$producto['valorbase']."|".$producto['iva']."'>".$producto['nombre']."</option>";
        }?>    

            </select>
        </div>
        <div class="col col-2">
        <?php echo $mensaje;?>
    </div>
        <div class="col col-4 text-right">

            <button class="btn btn-secondary" id="boton" name="boton" type="button"  onclick="agregar_pedido();">Agregar al pedido</button>
            <a href="pedidos.php" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</div>
<br>
<div class="container">
    <table class="table table-hover table-sm" id="tabla-resultados" name="tabla-resultados">
        <thead class="">
            <tr>
                <th>Nombre</th>
                <th>Referencia</th>
                <th>Unidades</th>
                <th>Valor unidad</th>
                <th>% impuestos</th>
                <th>Subtotal</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="container-fluid">
    <div class="row p-2">
        <div class="col col-6">
            <select name="cliente" id="cliente" class="form-control" placeholder="" required>
                <option value="">...Cliente...</option>
                <?php
        foreach ($clientes->listar() as $cliente) {
            echo "<option value='".$cliente['id']."'>".$cliente['nombre']."</option>";
        }?>    

            </select>
        </div>
        <div class="col col-6 text-right">
        Subtotal......$ <span id="subtotal">00000</span><br>
        IVA......$ <span id="iva">000.0000</span><br>
        TOTAL......$ <span id="total">000.0000</span><br>
        <br>
        <button class="btn btn-secondary" id="boton" name="boton" >FINALIZAR</button>


        </div>
    </div>
</div>


</form>

<br>
        <?php include("incluidos/footer.php");?>

    </body>
</html>
<script>
//funcion para agregar la fila de un producto
function agregar_pedido() {
    // capturar el valor del select de los productos
    var campo=document.getElementById('ref').value;
    if (campo!="") {
        // selecciono un producto de la lista
        // el valor esta construido de esta manera:
        // id|nombre|valorbase|iva
        // las cadenas se pueden separar por medio de un simbolo
        // en este caso vamos a separar los valores por simbolo |
        // y esto devuelve un array de posiciones. Para separalo usamos la funcion split
        var datos=campo.split("|");
        // como vamos a crear una fila o tr dentro de una tabla,
        // vamos a crear cada componente o celda
        var celdanombre="<td>"+datos[1]+"</td>";
        var celdaref="<td><input class='form-control col col-6' name='referencia[]' id='referencia_"+datos[0]+"' value='"+datos[0]+"' readonly type='text'></td>";
        //
        var celdacantidad="<td><input class='form-control col col-4' name='cantidad[]' id='cantidad_"+datos[0]+"' value='1' type='number' onKeyup='calcular("+datos[0]+")' onchange='calcular("+datos[0]+")'></td>";
        //
        var celdavalorbase="<td><input class='form-control col col-8' name='preciounitario[]' id='preciounitario_"+datos[0]+"' value='"+datos[2]+"' readonly type='number'></td>";
        //
        var celdaimpuestos="<td><input class='form-control col col-4' name='subtotaliva[]' id='subtotaliva_"+datos[0]+"' value='"+datos[3]+"' readonly type='number'></td>";
        //
        var celdasubtotal="<td><input class='form-control col col-8' name='subtotal[]' id='subtotal_"+datos[0]+"' value='' readonly type='number'></td>";
        //
        var celdaopciones="<td><a onclick='borrarfila(this)' class='btn btn-danger' title='Click para eliminar la fila deseada'>[X]</a></td>";
        //
        // para insertar una fila, primero debemos indicarle a que tabla y que se ubique en el tbody
        let tabladatos=document.getElementById('tabla-resultados').getElementsByTagName('tbody')[0];
        // una vez posicionados en el tbody vamos a insetar una fila y sus respectivos datos o celdas
        // para eso usaremos insertrow, insertcell y innerHTML
        let fila = tabladatos.insertRow();
        let celda1=fila.insertCell(0);
        celda1.innerHTML=celdanombre;
        //
        let celda2=fila.insertCell(1);
        celda2.innerHTML=celdaref;
        //
        let celda3=fila.insertCell(2);
        celda3.innerHTML=celdacantidad;
        //
        let celda4=fila.insertCell(3);
        celda4.innerHTML=celdavalorbase;
        //
        let celda5=fila.insertCell(4);
        celda5.innerHTML=celdaimpuestos;
        //
        let celda6=fila.insertCell(5);
        celda6.innerHTML=celdasubtotal;
        //
        let celda7=fila.insertCell(6);
        celda7.innerHTML=celdaopciones;

        calcular(datos[0]);
        

    }    
}
function borrarfila(fila) {
    // el proceso de borrado se hace con parentnode que permite ubicarse en el elemento
    // y removechild que permite quitar el elemento deseado
    // en este caso vamos a quitar la fila. Como estamos ubicados en el href tenemos que devolvernos hasta el tbody para decirle que borre la fila o tr
    var borrado=fila.parentNode.parentNode;
    borrado.parentNode.removeChild(borrado);
    actualizar_totales();
}
function calcular(ref) {
    // este proceso permite calcular el valor subtotal de cada pedido
    // se basa en cantidas, preciounitario, subtotaliva y generan el subtotal
    var cantidad=document.getElementById('cantidad_'+ref);
    var preciounitario=document.getElementById('preciounitario_'+ref);
    var subtotaliva=document.getElementById('subtotaliva_'+ref);
    // calcular el valor antes de iva
    precio=preciounitario.value*cantidad.value;
    iva=precio*(subtotaliva.value/100);
    subtotal=precio+iva;
    // antes de pasar el valor al subtotal validemos que sea mayor a cero
    if (subtotal>0) {
        document.getElementById('subtotal_'+ref).value=subtotal;
        // invocar funcion para actualizar los totales de los pedidos
        actualizar_totales();
    } else {
        document.getElementById('subtotal_'+ref).value=0
    }

}
function actualizar_totales() {
    // para actualizar los totales que estan abajo y que son:
    // subtotal, iva y total
    // vamos a recorrer la tabla tabla-resultados, ubicandonos en el tbody
    // y luego recorrermos el total de el y nos ubicamos en cada fila y capturamos los datos que estan cargados en cada input 
    var filas=document.getElementById('tabla-resultados').getElementsByTagName('tbody');
    // iniciar los contadores en cero para capturar los datos dentro de un ciclo
    var subtotal=0;
    var iva=0;
    var total=0;
    // con filas creada, vamos a ubicarnos en los tr
    var filadetalle=filas[0].getElementsByTagName("tr");
    // recorrer los tr por medio de un for
    for (var i=0;i<filadetalle.length;i++) {
        // ubicarnos en cada filadetalle y extraer los valores de cada celda
        var celdas=filadetalle[i].getElementsByTagName("td");
        //
        var cantidad=celdas[2].getElementsByTagName("input")[0].value;
        var preciounitario=celdas[3].getElementsByTagName("input")[0].value;
        var subtotaliva=celdas[4].getElementsByTagName("input")[0].value;
        //
        precio=preciounitario*cantidad;
        subtotal=subtotal+precio;

        iva=iva+precio*(subtotaliva/100);
        total=total+(precio+iva);
    }
    // asignar los valores acumulados a cada elemento ubicado en la parte inferior
    document.getElementById('subtotal').innerHTML=subtotal;
    document.getElementById('iva').innerHTML=iva;
    document.getElementById('total').innerHTML=total;

}
</script>
