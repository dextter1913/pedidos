<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pagina de acceso</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
    <h1>Acceso al sistema</h1>
       <form action="validar.php" name="frm" id="frm" method="POST">
        <div class="container">

            <div class="row">
                <label for="login">Login o correo electronico</label>
                <input type="text" required id="login" name="login" class="form-control">
            </div>
        
            <div class="row">
                <label for="clave">Clave</label>
                <input type="password" id="clave" name="clave" class="form-control" required>
            </div>
        

            <div class="row">
                <label for=""></label>
                <button class="btn btn-info" name="calcular" id="calcular" >Enviar</button>
            </div>
        </div>
      </form> 
    </body>
</html>

