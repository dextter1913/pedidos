<?php
include("incluidos/sessiones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Imprimir pedido numero <?php echo $_GET['id']; ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body onload="cargar_pedido();">
    <h1>Impresion pedido <span id="numeropedido">{numeropedido}</span></h1>
    <form method="POST" name="frm" id="frm" action="?id=1" enctype="multipart/form-data">


        <div class="container-fluid" id="capa_impresion">
            <div class="col col-12 text-center">
                <button class="btn btn-secondary" id="boton" name="boton" type="button" onclick="imprimir();">Imprimir</button>
                <a href="pedidos.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col col-3">
                    Cliente: <span id="cliente">{cliente}</span>
                </div>
                <div class="col col-3">
                    Direccion: <span id="direccion">{direccion}</span>
                </div>
                <div class="col col-3">
                    Telefono: <span id="telefono">{telefono}</span>
                </div>
                <div class="col col-3">
                    Fecha: <span id="fecha">{fecha}</span>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <table class="table table-hover table-sm" id="tabla-resultados" name="tabla-resultados">
                <thead class="">
                    <tr>
                        <th>Referencia</th>
                        <th>Unidades</th>
                        <th>Valor unidad</th>
                        <th>% impuestos</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="container-fluid">
            <div class="row p-2">
                <div class="col col-6">
                </div>
                <div class="col col-6 text-right">
                    Total cantidad...... <span id="totalcantidad">{00000}</span><br>
                    Subtotal......$ <span id="subtotal">{00000}</span><br>
                    IVA......$ <span id="iva">{000.0000}</span><br>
                    TOTAL......$ <span id="total">{000.0000}</span><br>
                    <br>
                </div>
            </div>
        </div>



    </form>

    <br>

</body>

</html>
<script>
    function cargar_pedido() {
        // CAPTURAR EL ID DEL PEDIDO QUE VIENE EN EL METODO GET POR LA RUTA
        var id_pedido = "<?php echo $_GET['id'] ?>";
        // vamos a generar un objeto tipo xmlhttprequest para solicitar y esperar la respuesta de la fuente de datos que vamos a consumir

        const peticion = new XMLHttpRequest();

        //este objeto permite hacer lo siguiente:
        //send: lo que hace es enviar la peticion hacia la fuente de datos
        //open: abre la conexion hacia la fuente de datos
        //responseText: permite obtener la respuesta de la fuente de datos

        peticion.open("GET", "json.php?id=" + id_pedido, false);
        peticion.send();
        const pedido = peticion.responseText;
        //como sabemos como llega el response, cuando es json se debe formatear
        // para eso usamos el metodo JSON.parse
        var detalle = JSON.parse(pedido);
        console.log(detalle);
        // ahora vamos a recorrer el objeto detalle para obtener los datos
        // y mostrarlos en el html
        if (detalle.length > 0) {
            //vamos a mostrar en pantalla los datos del encabezado
            document.getElementById("numeropedido").innerHTML = detalle[0]["id"];
            document.getElementById("cliente").innerHTML = detalle[0]["cliente"];
            document.getElementById("direccion").innerHTML = detalle[0]["direccion"];
            document.getElementById("telefono").innerHTML = detalle[0]["telefono"];
            document.getElementById("fecha").innerHTML = detalle[0]["fecha"];
            //vamos a mostrar en pantalla los datos del detalle
            var html = "";
            for (var i = 0; i < detalle.length; i++) {
                html += "<tr>";
                html += "<td>" + detalle[i]["referencia"] + "</td>";
                html += "<td>" + detalle[i]["unidades"] + "</td>";
                html += "<td>" + detalle[i]["valor_unidad"] + "</td>";
                html += "<td>" + detalle[i]["impuestos"] + "</td>";
                html += "<td>" + detalle[i]["subtotal"] + "</td>";
                html += "</tr>";
            }
            document.getElementById("tabla-resultados").innerHTML = html;
        }
    }
</script>