<?php
include "./conexion.php";

// Recibir datos del formulario
$id = $_POST['id'];
$titulo = $_POST['txtTitulo'];
$contenido = $_POST['txtContenido'];
$nombreAutor = $_POST['txtAutor']; // Nombre del autor
$idTipo = $_POST['txtTipo']; // ID del tipo (ya es un número)

// Obtener el idAutor basado en el nombre del autor
$stmtAutor = $conexion->prepare("SELECT a.idAutor 
                                 FROM Autores a
                                 INNER JOIN Usuarios u ON a.idUsuario = u.idUsuario
                                 WHERE u.nombre = ?");
$stmtAutor->bind_param("s", $nombreAutor);
$stmtAutor->execute();
$resultAutor = $stmtAutor->get_result();
if ($rowAutor = $resultAutor->fetch_assoc()) {
    $idAutor = $rowAutor['idAutor'];
} else {
    die("Error: Autor no encontrado.");
}

// Consulta para actualizar la tabla `Publi`
$stmtUpdate = $conexion->prepare("UPDATE Publi SET 
    titulo = ?, 
    contenido = ?, 
    idTipo = ?, 
    idAutor = ? 
    WHERE idPubli = ?");
$stmtUpdate->bind_param("ssiii", $titulo, $contenido, $idTipo, $idAutor, $id);
if ($stmtUpdate->execute()) {
    header("Location: ../../dashboard/articulos.php?status=2");
    echo "Publicación actualizada correctamente.";
} else {
    header("Location: ../../dashboard/articulos.php?status=0");
    echo "Error al actualizar: " . $stmtUpdate->error;
}

$stmtAutor->close();
$stmtUpdate->close();
$conexion->close();
?>
