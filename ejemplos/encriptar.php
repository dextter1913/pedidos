<?php
// metodos de encripcion
// md5
$clave="@12345";
echo "La encripcion en md5 es: ".md5($clave);
echo "<hr>";
echo "La encripcion en sha es: ".sha1($clave);
echo "<hr>";
echo "La encripcion en con cambio de encripcion".password_hash($clave,PASSWORD_DEFAULT);