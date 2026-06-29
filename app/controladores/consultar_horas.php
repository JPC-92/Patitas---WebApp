<?php
require '../../config/conexion.php';

header('Content-Type: application/json');

if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    $horas_ocupadas = [];

    // Buscamos si hay horas reservadas para ese dia
    $sql = "SELECT hora FROM citas WHERE fecha = '$fecha'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            // Guardamos la hora
            $horas_ocupadas[] = $fila['hora'];
        }
    }
    
    echo json_encode($horas_ocupadas);
} else {
            echo json_encode([]);
        }
?>