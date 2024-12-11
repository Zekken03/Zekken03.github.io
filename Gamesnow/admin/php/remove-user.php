<?php
include "./conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Validar el ID como un número entero

    // Consulta de eliminación
    $consulta = "DELETE FROM usuarios WHERE idUsuario = $id";

    if ($conexion->query($consulta)) {
        // Redirigir al usuario a users.php si la eliminación fue exitosa
        header("Location: ../../dashboard/users.php?status=3");
        exit(); // Asegúrate de detener la ejecución del script después de redirigir
    } else {
        die("Error al eliminar el moderador: " . $conexion->error);
    }
} else {
    die("ID no proporcionado.");
}
?>
