<?php
// simular unos registros y los vamos a imprimir
// usando el foreach
$usuarios[]=array("Nombre"=>"juan","Apellidos"=>"fernandez","correo"=>"juanff@gmail.com");
$usuarios[]=array("Nombre"=>"pedro","Apellidos"=>"perez","correo"=>"pedro@gmail.com");
$usuarios[]=array("Nombre"=>"carlos","Apellidos"=>"fernandez","correo"=>"carlos@gmail.com");
$usuarios[]=array("Nombre"=>"julian","Apellidos"=>"correa","correo"=>"julian@gmail.com");
$usuarios[]=array("Nombre"=>"jose","Apellidos"=>"alvarez","correo"=>"jose@gmail.com");
$usuarios[]=array("Nombre"=>"karol","Apellidos"=>"yepes","correo"=>"karol@gmail.com");
$usuarios[]=array("Nombre"=>"luis","Apellidos"=>"angel","correo"=>"luis@gmail.com");
$usuarios[]=array("Nombre"=>"paula","Apellidos"=>"pelaez","correo"=>"paula@gmail.com");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo tabla leyendo vector o matriz</title>
</head>
<body>
    <table border="1" style="border:2px solid;border-collapse:collapse;width:100%;font-family:'Arial';font-size:12px;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $fila) {?>
            <tr>
                <td><?php echo $fila["Nombre"];?></td>
                <td><?php echo $fila["Apellidos"];?></td>
                <td><a href="mailto:<?php echo $fila["correo"];?>"><?php echo $fila["correo"];?></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
</body>
</html>