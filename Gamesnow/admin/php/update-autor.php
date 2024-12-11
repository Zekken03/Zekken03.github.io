<?php
include "./conexion.php";

// Recibir los datos del formulario
$nombre = $_POST['txtNombre'];  // Nombre del autor
$correo = $_POST['txtCorreo'];  // Correo del autor
$biografia = $_POST['txtBiografia'];  // Biografía del autor
$redes = $_POST['txtRedes'];  // Redes sociales del autor

// Obtener el idUsuario basado en el nombre y correo del autor
$stmtUsuario = $conexion->prepare("SELECT idUsuario FROM usuarios WHERE nombre = ? AND correo = ?");
$stmtUsuario->bind_param("ss", $nombre, $correo);
$stmtUsuario->execute();
$resultUsuario = $stmtUsuario->get_result();

if ($rowUsuario = $resultUsuario->fetch_assoc()) {
    $idUsuario = $rowUsuario['idUsuario'];
} else {
    die("Error: Usuario no encontrado.");
}

// Verificar si el autor existe en la tabla Autores
$stmtAutor = $conexion->prepare("SELECT idAutor FROM autores WHERE idUsuario = ?");
$stmtAutor->bind_param("i", $idUsuario);
$stmtAutor->execute();
$resultAutor = $stmtAutor->get_result();

if ($rowAutor = $resultAutor->fetch_assoc()) {
    // Si el autor existe, actualizamos los datos
    $idAutor = $rowAutor['idAutor'];
    
    $stmtUpdate = $conexion->prepare("UPDATE autores SET biografia = ?, redes = ? WHERE idAutor = ?");
    $stmtUpdate->bind_param("ssi", $biografia, $redes, $idAutor);
    
    if ($stmtUpdate->execute()) {
        echo "Autor actualizado correctamente.";
        header("Location: ../../dashboard/autores.php?status=2");  // Redirigir a otra página después de la actualización
    } else {
        echo "Error al actualizar autor: " . $stmtUpdate->error;
        header("Location: ../../dashboard/autores.php?status=0");  // Redirigir en caso de error
    }
} else {
    die("Error: El autor no existe.");
}

$stmtUsuario->close();
$stmtAutor->close();
$stmtUpdate->close();
$conexion->close();
?>
