<?php
session_start();
include '../../config/conexion.php';
require '../modelos/citas_modelo.php';

// Si no es administrador lo mandamos a la página de citas para proteger la ruta
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: citas.php");
    exit();
}

// Obtenemos los datos combinados desde el modelo (usando los JOINs)
$resultado_citas = todasCitas($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Administrador - Patitas</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <div class="contenedor-admin">
        <header>
            <div class="logo">
                <img src="../../public/img/logo.png" alt="Logo Patitas">
            </div>
            <h1>Panel de Gestión de Citas</h1>
        </header>
        
        <p>Bienvenido, Administrador: <strong><?php echo $_SESSION['nombre']; ?></strong></p>

        <div class="campo">
            <label><strong>Filtrar citas:</strong></label>
            <input type="text" id="inputBusqueda" class="input-buscador" placeholder="Buscar por cliente, mascota o fecha...">
        </div>

        <?php if (isset($_GET['editado'])): ?>
            <div class="alerta-exito">¡Cita actualizada correctamente!</div>
        <?php endif; ?>

        <?php if (isset($_GET['borrado'])): ?>
            <div class="alerta-error">¡Cita eliminada correctamente!</div>
        <?php endif; ?>

        <table class="tabla-citas" id="tablaAdmin">
            <thead>
                <tr>
                    <th>Fecha / Hora</th>
                    <th>Cliente</th>
                    <th>Mascota</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado_citas)): ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($fila['fecha'])) . " - " . $fila['hora']; ?></td>
                    
                    <td><?php echo $fila['nombre_cliente'] . " " . $fila['apellidos_cliente']; ?></td> 
                    <td><?php echo $fila['nombre_mascota']; ?></td>
                    <td><?php echo $fila['motivo']; ?></td>
                    
                    <td>
                        <a href="editar_citas.php?id=<?php echo $fila['id_cita']; ?>" class="boton-editar">Editar</a>

                        <a href="../controladores/cancelar_citas.php?id=<?php echo $fila['id_cita']; ?>" 
                            class="boton-cancelar" 
                            onclick="return confirm('¿Seguro que quieres eliminar esta cita?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="../controladores/cerrar_sesion.php" class="cerrar-sesion">Cerrar Sesión</a>
    </div>

    <script>
        document.getElementById('inputBusqueda').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll('#tablaAdmin tbody tr');

            filas.forEach(fila => {
                let textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? '' : 'none';
            });
        });
    </script>
</body>
</html>