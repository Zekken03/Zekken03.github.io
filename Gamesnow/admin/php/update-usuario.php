<?php
include "./conexion.php"; // Incluir la conexión a la base de datos

$id = $_POST['id'];         // ID del usuario que se está editando
$nombre = $_POST['txtNombre'];  // Nombre del usuario
$correo = $_POST['txtCorreo'];  // Correo del usuario

// Verificar si el correo ya existe en otro usuario
$consultaCheck = "SELECT idUsuario FROM usuarios WHERE correo = ? AND idUsuario != ?";
$stmt = $conexion->prepare($consultaCheck);
$stmt->bind_param("si", $correo, $id); // Parametros: correo (string) y id (entero)
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Si el correo ya está en uso por otro usuario, redirige con un mensaje de error
    header("Location: ../../dashboard/usuarios.php?status=error&message=Correo ya registrado");
    exit();
}

// Si el correo no está duplicado, realizar la actualización
$consulta = "UPDATE usuarios SET nombre = ?, correo = ? WHERE idUsuario = ?";
$stmtUpdate = $conexion->prepare($consulta);
$stmtUpdate->bind_param("ssi", $nombre, $correo, $id); // Parametros: nombre (string), correo (string), id (entero)

if ($stmtUpdate->execute()) {
    // Redirige a la página de usuarios con un status de éxito
    header("Location: ../../dashboard/users.php?status=2");
} else {
    // Si ocurre un error en la actualización, redirige con un mensaje de error
    header("Location: ../../dashboard/users.php?status=0");
}

?>
