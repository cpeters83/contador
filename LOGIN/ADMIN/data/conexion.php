<?php
/*Parametros de conexion a base de datos*/
$host       = "localhost";
$username   = "root";
$password   = "M3tr02017";
$dbname     = "testing";
$dsn        = "mysql:host=$host;dbname=$dbname"; 
$options    = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
  }
?>