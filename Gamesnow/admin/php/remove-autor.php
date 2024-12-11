<?php
include "./conexion.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Validar el ID como un número entero

    // Actualizar las publicaciones para que no tengan un autor asignado
    $consulta_publi = "UPDATE publi SET idAutor = NULL WHERE idAutor = $id";
    if (!$conexion->query($consulta_publi)) {
        die("Error al actualizar las publicaciones: " . $conexion->error);
    }

    // Obtener el idUsuario relacionado con el idAutor
    $consulta_usuario_relacionado = "SELECT idUsuario FROM autores WHERE idAutor = $id";
    $resultado = $conexion->query($consulta_usuario_relacionado);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $idUsuario = $fila['idUsuario']; // Obtener el idUsuario relacionado

        // Eliminar el autor
        $consulta_autor = "DELETE FROM autores WHERE idAutor = $id";
        if ($conexion->query($consulta_autor)) {
            // Eliminar el usuario relacionado
            $consulta_usuario = "DELETE FROM usuarios WHERE idUsuario = $idUsuario";
            if ($conexion->query($consulta_usuario)) {
                // Redirigir al usuario a autores.php si la eliminación fue exitosa
                header("Location: ../../dashboard/autores.php?status=3");
                exit(); // Detener la ejecución después de la redirección
            } else {
                die("Error al eliminar el usuario: " . $conexion->error);
            }
        } else {
            die("Error al eliminar el autor: " . $conexion->error);
        }
    } else {
        die("No se encontró un usuario relacionado con el autor.");
    }
} else {
    die("ID no proporcionado.");
}
?>
