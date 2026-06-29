<?php
session_start();
require '../../config/conexion.php';

// Llamamos al modelo
require '../modelos/usuario_modelo.php';

// Cogemos el mail y la contraseña del formulario
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Buscamos al usuario mediante la función del modelo
$usuario = obtenerUsuarioPorEmail($conexion, $email);

// Si el correo no existe, lo expulsamos
if (!$usuario) {
    header("Location: ../../index.php?error=si");
    exit();
}

// Si la contraseña no coincide, lo expulsamos
if (!password_verify($password, $usuario['password'])) {
    header("Location: ../../index.php?error=si");
    exit();
}

// Guardamos los datos de la sesión
$_SESSION['id_usuario'] = $usuario['id_usuario'];
$_SESSION['nombre'] = $usuario['nombre'];
$_SESSION['rol'] = $usuario['rol'];

// Redirigimos a la siguiente página según el rol del usuario
if ($_SESSION['rol'] === 'admin') {
    header("Location: ../vistas/admin_citas.php");
} else {
    header ("Location: ../vistas/citas.php");
}
exit();
?>