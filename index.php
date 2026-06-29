<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login_Patitas</title>
        <link rel="stylesheet" href="public/css/estilos.css">
    </head>
    <body>
        <div class="formulario">
            <div class="logo">
                <img src="public/img/logo.png" alt="Logo Patitas">
            </div>

            <?php if (isset($_GET['registro']) && $_GET['registro'] =='ok'): ?>
                <div class="alerta-exito">
                    ¡Registro completado! Ya puedes entrar
                </div>
            <?php endif; ?>

            <h2>Iniciar Sesión</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="alerta-error">Email o contraseña incorrectos</div>
            <?php endif; ?>

            <form action="app/controladores/index_controlador.php" method="POST">
                <div class="campo">
                    <label>Email:</label>
                    <input type="email" name="email" required placeholder="Correo electrónico">
                </div>

                <div class="campo">
                    <label>Contraseña:</label>
                    <input type="password" name="password" required placeholder="******">
                </div>

                <button type="submit" class="button">Entrar</button>

                <p class="boton-registro">
                    ¿Aún no te has registrado? <a href="app/vistas/registro.php">Regístrate aquí</a>
                </p>
            </form>
        </div>
    </body>
</html>