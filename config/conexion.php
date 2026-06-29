<?php
// Creamos la conexión.
$conexion = new mysqli("localhost", "root", "", "patitas_db");

// Comprobación de errores.
if ($conexion->connect_error) {
    die("Error de conexión");
}

// Establecemos el conjunto de caracteres UTF-8 para español
$conexion->set_charset("utf8");
?>