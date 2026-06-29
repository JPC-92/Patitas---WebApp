<?php
// Función para registrar al usuario
function registrarUsuario($conexion, $nombre, $apellidos, $telefono, $email, $password) {
    $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, email, password, rol)
            VALUES ('$nombre', '$apellidos', '$telefono', '$email', '$password', 'cliente')";
    return mysqli_query($conexion, $sql);
}

// Buscamos si hay usuario registrado con ese email en el login
function obtenerUsuarioPorEmail($conexion, $email) {
    $sql ="SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    }
    return false;
}
?>