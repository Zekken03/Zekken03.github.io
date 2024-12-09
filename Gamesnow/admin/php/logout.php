<?php
session_start();

// Aquí se realiza el proceso para cerrar sesión
session_unset();
session_destroy();

// Comprobar si el parámetro redirect está presente y no está vacío
$redirectUrl = isset($_GET['redirect']) && !empty($_GET['redirect']) ? $_GET['redirect'] : '/'; // Si no hay redirección, redirige a la página principal

// Redirigir al usuario
header('Location: ' . $redirectUrl);
exit;
?>
