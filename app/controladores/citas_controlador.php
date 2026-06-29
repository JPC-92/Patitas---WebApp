<?php
session_start();

include '../../config/conexion.php';
require '../modelos/citas_modelo.php';

// Cogemos las variables del formulario
$mascota = trim($_POST['mascota']);
$motivo = trim($_POST['motivo']);
$fecha = trim($_POST['fecha']);
$hora = trim($_POST['hora']);

// Cogemos el ID del usuario de la sesión iniciada
$id_usuario = $_SESSION['id_usuario'];

// Obtenemos el ID de la mascota
$id_mascota = buscarOCrearMascota($conexion, $mascota, $id_usuario);

// Guardamos la cita
$resultado = crearCita($conexion, $id_mascota, $motivo, $fecha, $hora);

// Comprobacion y redireccion
if ($resultado) {
    header("Location: ../vistas/citas.php?cita=ok");
} else {
    header("Location: ../vistas/citas.php?error=si");
}
exit();
?>