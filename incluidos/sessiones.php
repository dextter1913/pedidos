<?php
/*
Este script permite activar las variables de session
y preguntar si estan seteadas y ademas tienen valor
*/
session_start();
if (!isset($_SESSION['s_login'])) {
    header("Location: index.php");
}