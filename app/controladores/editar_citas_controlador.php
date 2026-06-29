<?php
session_start();
include '../../config/conexion.php';
require '../modelos/citas_modelo.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../vistas/citas.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cita = $_POST['id_cita'];
    $nueva_fecha = $_POST['fecha'];
    $nueva_hora = $_POST['hora'];

    if (editarCita($conexion, $id_cita, $nueva_fecha, $nueva_hora)) {
        header("Location: ../vistas/admin_citas.php?editado=ok");
        exit();
    } else {
        echo "Error al actualizar la cita";
    }
}
header("Location: ../vistas/admin_citas.php");
?>