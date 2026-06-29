<?php
session_start();
// Limpiamos las variables de la sesión
session_unset();
// Cerramos la sesión
session_destroy();
// Redirección al Login
header("Location: ../../index.php");
exit();
?>