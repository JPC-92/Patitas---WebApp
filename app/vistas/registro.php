<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Patitas</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <div class="formulario">
        <div class="logo">
            <img src="../../public/img/logo.png" alt="Logo Patitas">
        </div>

        <div id="registro">
            <h2>Registro de clientes</h2>

            <?php if(isset($_GET['error'])): ?>
                <div class="alerta-error">
                    <?php 
                        if ($_GET['error'] == 'email') echo "Este correo electrónico ya está registrado.";
                        elseif ($_GET['error'] == 'telefono') echo "Este teléfono ya está registrado.";
                        else echo "Ha ocurrido un error durante el registro.";
                    ?>
                </div>
            <?php endif; ?>

            <form action="../controladores/registro_controlador.php" method="POST">

                <div class="campo">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" minlength="3" placeholder="Introduce tu nombre" required>
                </div>

                <div class="campo">
                    <label>Apellidos:</label>
                    <input type="text" name="apellidos" minlength="3" placeholder="Introduce tus apellidos" required>
                </div>

                <div class="campo">
                    <label>Teléfono:</label>
                    <input type="text" name="telefono" pattern="[0-9]{9}" placeholder="Introduce tu nº de teléfono" required>
                </div>

                <div class="campo">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="Introduce tu Email" required>
                </div>

                <div class="campo">
                    <label>Contraseña:</label>
                    <input type="password" name="password" minlength="6" placeholder="Introduce tu contraseña" required>
                </div>

                <button type="submit" class="button">Registrarse</button>

                <p class="boton-registro">
                    ¿Ya tienes cuenta? <a href="../../index.php">Inicia Sesión</a>
                </p>

            </form>
        </div>
    </div>

    <script src="../../public/js/registro.js"></script>
</body>
</html>