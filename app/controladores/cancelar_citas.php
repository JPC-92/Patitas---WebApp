<?php
session_start();
include '../../config/conexion.php';
require '../modelos/citas_modelo.php';

// Verificamos que el usuario esta logueado y que tengamos el id de la cita
if (isset($_SESSION['id_usuario']) && isset($_GET['id'])) {
    
    $id_cita = $_GET['id'];
    $id_usuario = $_SESSION['id_usuario'];
    $rol = $_SESSION['rol'];

    // Borramos la cita y guardamos
    $resultado = borrarCita($conexion, $id_cita, $id_usuario, $rol);

    // comprobamos el borrado
    if ( $resultado) {
        if ($rol == 'admin') {
            header("Location: ../vistas/admin_citas.php?borrado=ok");
        } else {
            header("Location: ../vistas/citas.php?borrado=ok");
        }
    } else {
        if ($rol == 'admin') {
            header("Location: ../vistas/admin_citas.php?error=ok");
        } else {
            header("Location: ../vistas/citas.php?error=ok");        
        }
    }
} else {
    header("Location: ../../index.php");
}
exit();
?>