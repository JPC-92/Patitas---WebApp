<?php

// Llamamos al archivo de conexión
require '../../config/conexion.php';

// Llamamos al modelo
require '../modelos/usuario_modelo.php';

// Recogemos los datos
$nombre = trim($_POST['nombre']);
$apellidos = trim($_POST['apellidos']);
$telefono = trim($_POST['telefono']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Encriptamos la contraseña
$password = password_hash($password, PASSWORD_DEFAULT);

// Bloque try-catch
try {
    registrarUsuario($conexion, $nombre, $apellidos, $telefono, $email, $password);
    header("Location: ../../index.php?registro=ok");
    
} catch (\mysqli_sql_exception $e) {
    // Error genérico
    $tipo_error = "generico";
    
    // Si el error es el email o el teléfono, cambiamos la variable
    if (strpos($e->getMessage(), 'email') !== false) $tipo_error = "email";
    if (strpos($e->getMessage(), 'telefono') !== false) $tipo_error = "telefono";
    
    // Redirigimos con el error correspondiente
    header("Location: ../vistas/registro.php?error=$tipo_error");
}
exit();
?>