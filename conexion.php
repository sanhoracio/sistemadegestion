<?php

//
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'c1602068_isft225';

// Crear la conexión
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
/* $conn->set_charset("utf8"); */

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
?>