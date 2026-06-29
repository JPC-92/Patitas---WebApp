<?php
session_start();
include '../../config/conexion.php';
require '../modelos/citas_modelo.php';

// Si el usuario no ha iniciado sesión, lo mandamos al login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../index.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

$resultado_citas = citasUsuario($conexion, $id_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Citas_Patitas</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <div class="formulario form-citas">
        <div class="logo">
            <img src="../../public/img/logo.png" alt="Logo Patitas">
        </div>
        <!-- Mensaje de bienvenida con el nombre del cliente -->
        <h2>¡Hola, <?php echo $_SESSION['nombre']; ?>!</h2>
        <p class="mensaje2">Desde aquí puedes gestionar tus citas.</p>

        <hr class="separador">

        <?php if (isset($_GET['cita']) && $_GET['cita'] == 'ok'): ?>
            <div class="alerta-exito">¡Cita registrada correctamente!</div>
        <?php endif; ?>
       
        <?php if (isset($_GET['borrado']) && $_GET['borrado'] == 'ok'): ?>
            <div class="alerta-error">¡Cita cancelada!</div>
        <?php endif; ?> 

        <?php if (isset($_GET['error'])): ?>
            <div class="alerta-error">Ha ocurrido un error.</div>
        <?php endif; ?>

        <h3>Pedir nueva cita:</h3>
        <form action="../controladores/citas_controlador.php" method="POST">

            <div class="campo">
                <label>Nombre de la mascota:</label>
                <input type="text" name="mascota" required placeholder="Introduce el nombre de tu mascota">
            </div>

            <div class="campo">
                <label>Motivo de la cita:</label>
                <select name="motivo" required>
                    <option value= "" disabled selected>-- Selecciona un motivo --</option>
                    <option value="Revisión">Revisión</option>
                    <option value="Vacunación">Vacunación</option>
                    <option value="Peluquería">Peluquería</option>
                    <option value="Urgencia">Urgencia</option>
                </select>
            </div>
            
            <div class="campo-fecha-hora">
                <!-- No permitimos el uso de fechas pasadas -->
                <div class="campo">                    
                    <label>Fecha:</label>
                    <input type="date" id="fecha_cita" name="fecha" required min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="campo">
                    <label>Hora:</label>
                    <select name="hora" id="hora_cita" required>
                        <option value="">-- Selecciona --</option>
                        <option value="09:00">09:00</option>
                        <option value="09:30">09:30</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
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
            </div>

            <button type="submit" class="button">Confirmar cita</button>
            <small style="display: block; margin-top: 5px; color: rgb(136, 136, 136);">L-V: 9:00-13:30 y 16:00-19:30</small> 
        </form>

        <hr class="separador">

        <h3>Tus citas</h3>
        <table class="tabla-citas">
            <thead>
                <tr>
                    <th>Fecha / Hora</th>
                    <th>Mascota</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($resultado_citas) > 0): ?>
                    <?php while ($fila = mysqli_fetch_assoc($resultado_citas)): ?>
                <tr>
                    <td>
                        <?php
                            // Cambiamos el formato de la fecha
                            $fecha = date_format(date_create($fila['fecha']), 'd/m/Y');
                            echo $fecha . " - " . $fila['hora'];
                        ?>    
                    </td>
                    <td><?php echo $fila['nombre_mascota']; ?></td>
                    <td><?php echo $fila['motivo']; ?></td>
                    <td>

                        <a href="../controladores/cancelar_citas.php?id=<?php echo $fila['id_cita']; ?>"
                        class="boton-cancelar"
                        onclick="return confirm('¿Seguro que quieres cancelar esta cita?')">
                        Cancelar
                        </a>
                    </td>    
                </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="vacia">No tienes citas programadas</td></tr>
                <?php endif; ?>
            </tbody>
        </table> 

            <a href="../controladores/cerrar_sesion.php" class="cerrar-sesion">Cerrar sesión</a>
    </div>

    <script src="../../public/js/citas.js"></script>
    
</body>
</html>