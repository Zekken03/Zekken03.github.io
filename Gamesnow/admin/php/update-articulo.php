<?php
include "./conexion.php";

// Recibir datos del formulario
$id = $_POST['id'];
$titulo = $_POST['txtTitulo'];
$contenido = $_POST['txtContenido'];
$nombreAutor = $_POST['txtAutor'];
$idTipo = $_POST['txtTipo'];

// Validación de datos
if (empty($id) || empty($titulo) || empty($contenido) || empty($nombreAutor) || empty($idTipo)) {
    die("Error: Todos los campos son obligatorios.");
}

// Obtener el idAutor basado en el nombre del autor
$stmtAutor = $conexion->prepare("SELECT a.idAutor 
                                 FROM autores a
                                 INNER JOIN usuarios u ON a.idUsuario = u.idUsuario
                                 WHERE u.nombre = ?");
$stmtAutor->bind_param("s", $nombreAutor);
$stmtAutor->execute();
$resultAutor = $stmtAutor->get_result();
if ($rowAutor = $resultAutor->fetch_assoc()) {
    $idAutor = $rowAutor['idAutor'];
} else {
    die("Error: Autor no encontrado.");
}

// Consulta para actualizar la tabla `publi`
$stmtUpdate = $conexion->prepare("UPDATE publi SET 
    titulo = ?, 
    contenido = ?, 
    idTipo = ?,
    idAutor = ? 
    WHERE idPubli = ?");
$stmtUpdate->bind_param("ssiii", $titulo, $contenido, $idTipo, $idAutor, $id);
if ($stmtUpdate->execute()) {
    header("Location: ../../dashboard/articulos.php?status=2");
    exit();
} else {
    error_log("Error al actualizar publicación: " . $stmtUpdate->error, 3, "errores.log");
    header("Location: ../../dashboard/articulos.php?status=0");
    exit();
}

$stmtAutor->close();
$stmtUpdate->close();
$conexion->close();
?>
