<?php
session_start();
session_destroy();
header("Location: login.html"); // Redirige al usuario a la página de inicio de sesión
exit();
?>
