<?php
session_start();
include '../../config/conexion.php';

// Solo el admin puede editar las citas
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Cogemos el ID de la cita para modificarla
$id_cita = $_GET['id'];


$sql = "SELECT citas.*,mascotas.nombre AS nombre_mascota
        FROM citas
        INNER JOIN mascotas ON citas.id_mascota = mascotas.id_mascota
        WHERE citas.id_cita = $id_cita";

$resultado = mysqli_query($conexion, $sql);
$cita = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <div class='formulario'>
        <h2>Editar Fecha y hora</h2>
        <p>Mascota: <strong><?php echo $cita['nombre_mascota']; ?></strong></p>

        <form action="../controladores/editar_citas_controlador.php" method="POST">
            <input type="hidden" name="id_cita" value="<?php echo $id_cita; ?>">

            <div class="campo">
                <label>Nueva Fecha:</label>
                <input type="date" name="fecha" value="<?php echo $cita['fecha']; ?>" required min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="campo">
                <label>Nueva Hora:</label>
                <select name="hora" required>
                    <option value="<?php echo $cita['hora']; ?>" selected><?php echo $cita['hora']; ?> (Actual)</option>
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                </select>
            </div>

            <button type="submit" class="button">Actualizar</button>
            <a href="admin_citas.php" class="cerrar-sesion">Cancelar</a>
        </form>
    </div>
</body>
</html>