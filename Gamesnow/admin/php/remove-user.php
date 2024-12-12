<?php
include "./conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Validar el ID como un número entero

    // Iniciar una transacción para asegurar que ambas operaciones se completen o ninguna
    $conexion->begin_transaction();

    try {
        // Eliminar comentarios asociados al usuario
        $consultaComentarios = "DELETE FROM comentarios WHERE idUsuario = $id";
        $conexion->query($consultaComentarios);

        // Eliminar el usuario
        $consultaUsuario = "DELETE FROM usuarios WHERE idUsuario = $id";
        $conexion->query($consultaUsuario);

        // Confirmar la transacción
        $conexion->commit();

        // Redirigir al usuario a users.php si la eliminación fue exitosa
        header("Location: ../../dashboard/users.php?status=3");
        exit(); // Asegúrate de detener la ejecución del script después de redirigir
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        die("Error al eliminar el moderador y sus comentarios: " . $e->getMessage());
    }
} else {
    die("ID no proporcionado.");
}
?>
