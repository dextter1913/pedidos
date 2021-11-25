<?php
/*
Este script permite limpiar las variables de session, destruirlas y devolverlo al index.php
*/
session_start();
unset($_SESSION);
session_destroy();
header("Location: index.php");