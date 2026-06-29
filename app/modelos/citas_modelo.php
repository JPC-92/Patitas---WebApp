<?php

function buscarOCrearMascota($conexion, $nombre_mascota, $id_usuario) {
    $sql_buscar = "SELECT id_mascota FROM mascotas WHERE nombre = '$nombre_mascota' AND id_usuario = '$id_usuario'";
    $resultado_buscar = mysqli_query($conexion, $sql_buscar);

    if (mysqli_num_rows($resultado_buscar) > 0) {
        // La mascota existe
        $fila = mysqli_fetch_assoc($resultado_buscar);
        return $fila['id_mascota'];
    } else {
        // Si la mascota no existe, la creamos
        $sql_crear = "INSERT INTO mascotas (nombre, id_usuario) VALUES ('$nombre_mascota', '$id_usuario')";
        mysqli_query($conexion, $sql_crear);

        // Devolvemos el ID de la mascota creada
        return mysqli_insert_id($conexion);
    }
}

// Insertamos la cita en la base de datos (Ya no necesita id_usuario)
function crearCita($conexion, $id_mascota, $motivo, $fecha, $hora) {
    $sql_cita = "INSERT INTO citas (id_mascota, motivo, fecha, hora)
                 VALUES ('$id_mascota', '$motivo', '$fecha', '$hora')";
    try {
        return mysqli_query($conexion, $sql_cita);
    } catch (mysqli_sql_exception $e) {
        return false;
    }
}

// Borrar cita (Comprobando la propiedad a través de la tabla mascotas)
function borrarCita($conexion, $id_cita, $id_usuario, $rol) {
    if ($rol === 'admin') {
        // El admin puede borrar cualquier cita
        $sql = "DELETE FROM citas WHERE id_cita = '$id_cita'";
    } else {
        // El cliente solo puede borrar citas de sus propias mascotas mediante una subconsulta
        $sql = "DELETE FROM citas 
                WHERE id_cita = '$id_cita' 
                AND id_mascota IN (SELECT id_mascota FROM mascotas WHERE id_usuario = '$id_usuario')";
    }
    return mysqli_query($conexion, $sql);
}

// Editar cita
function editarCita($conexion, $id_cita, $nueva_fecha, $nueva_hora) {
    $sql = "UPDATE citas SET fecha = '$nueva_fecha', hora = '$nueva_hora'
            WHERE id_cita = '$id_cita'";
    return mysqli_query($conexion, $sql);
}

// Obtener los datos cruzados de una sola cita para el formulario de editar
function obtenerCitaPorId($conexion, $id_cita) {
    $sql = "SELECT
                c.id_cita,
                c.fecha,
                c.hora,
                c.motivo,
                m.nombre AS nombre_mascota,
                u.nombre AS nombre_cliente,
                u.apellidos AS apellidos_cliente
            FROM citas c
            INNER JOIN mascotas m ON c.id_mascota = m.id_mascota
            INNER JOIN usuarios u ON m.id_usuario = u.id_usuario
            WHERE c.id_cita = '$id_cita'";
            
    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_assoc($resultado);
}

// Citas propias que ve el usuario (Filtramos por el dueño de la mascota)
function citasUsuario($conexion, $id_usuario) {
    $sql = "SELECT c.id_cita, c.fecha, c.hora, m.nombre AS nombre_mascota, c.motivo
            FROM citas c
            INNER JOIN mascotas m ON c.id_mascota = m.id_mascota
            WHERE m.id_usuario = '$id_usuario'
            ORDER BY c.fecha ASC, c.hora ASC";

    return mysqli_query($conexion, $sql);
}

// Citas que ve el admin (Múltiple INNER JOIN)
function todasCitas($conexion) {
    $sql = "SELECT c.id_cita, c.fecha, c.hora,
                   m.nombre AS nombre_mascota,
                   c.motivo,
                   u.nombre AS nombre_cliente,
                   u.apellidos AS apellidos_cliente
            FROM citas c
            INNER JOIN mascotas m ON c.id_mascota = m.id_mascota
            INNER JOIN usuarios u ON m.id_usuario = u.id_usuario
            ORDER BY c.fecha ASC, c.hora ASC";

    return mysqli_query($conexion, $sql);
}
?>