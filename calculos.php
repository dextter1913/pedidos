<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ejemplo javascript de calculos 1</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
<script>
    function validar() {
        /*
        validar que los campos sean diferentes de vacios
        para eso usaremos una funcion interna de javascript que me permite capturar un objeto 
        del html por su id. Se llama getElementById
        */
       var valorbase=document.getElementById('valorbase');
       var poriva=document.getElementById('poriva');
       var totalprecio=document.getElementById('totalprecio');
       // usemos alert para validar que el objeto no este vacio y luego le decimos que se focalice en el para que pueda digitar los datos
       if (valorbase.value=="") {
            alert("El valor base no puede estar vacio. Valide nuevo ");
            valorbase.focus();
       }
        return false;
    }
    // funcion como la anterior pero se parsea o valida la naturaleza
    // del valor del campo
    function validar2() {

       var valorbase=document.getElementById('valorbase');
       var poriva=document.getElementById('poriva');
       var totalprecio=document.getElementById('totalprecio');
        
        if (isNaN(valorbase.value) || valorbase.value=="") {
            alert("El valor base no puede ser menor a cero Intente de nuevo");
            valorbase.focus();
            return false;
        }
        if (isNaN(poriva.value) || poriva.value=="") {
            alert("El iva no puede ser menor a cero Intente de nuevo");
            poriva.focus();
            return false;
        }
        // calculo del total
        iva=parseInt(valorbase.value)*(parseInt(poriva.value)/100);
        total=parseInt(valorbase.value)+iva;
        totalprecio.value=total;

        return false;
    }
    function validar3() {

       var valorbase=document.getElementById('valorbase');
       var poriva=document.getElementById('poriva');
       var totalprecio=document.getElementById('totalprecio');
       var mensajes=document.getElementById('mensajes');
        debugger
        if (isNaN(valorbase.value) || valorbase.value=="") {
            mensajes.innerHTML="El valor base no puede ser menor a cero Intente de nuevo";
            valorbase.focus();
            return false;
        }
        if (isNaN(poriva.value) || poriva.value=="") {
            mensajes.innerHTML="El iva no puede ser menor a cero Intente de nuevo";
            poriva.focus();
            return false;
        }
        // calculo del total
        iva=parseInt(valorbase.value)*(parseInt(poriva.value)/100);
        total=parseInt(valorbase.value)+iva;
        totalprecio.value=total;

        return false;
    }
    
</script>
    <body>
    
    <h1>Calculo de precios</h1>
    
    <form action="#" name="frm" id="frm" method="POST" onsubmit="return validar3();">
        <div class="container">
            <div class="row">
                <label for="valorbase">Valor base</label>
                <input type="text" id="valorbase" name="valorbase" class="form-control">
            </div>
            <div class="row">
                <label for="poriva">% IVA</label>
                <input type="text" id="poriva" name="poriva" class="form-control">
            </div>
            <div class="row">
                <label for="totalprecio">Total precio</label>
                <input type="text" id="totalprecio" name="totalprecio" class="form-control">
            </div>
            <div class="row">
                <label for=""></label>
                <button class="btn btn-info" name="calcular" id="calcular" >CALCULAR</button>
                <span id="mensajes"></span>
            </div>
        </div>
      </form> 
    </body>
</html>

