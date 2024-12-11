<?php
include "./conexion.php";

// Obtener los datos del formulario
$nombre = $_POST['txtNombre'];
$correo = $_POST['txtCorreo'];
$password = $_POST['txtPassword'];

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($correo) || empty($password)) {
    // Si alguno de los campos está vacío, redirigir al formulario con un error
    header("Location: ../../dashboard/users.php?status=0");
    exit();
}

// Insertar directamente en la tabla 'Usuarios'
$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $correo, $password); // Asignar parámetros

// Ejecutar la consulta y redirigir según el resultado
if ($stmt->execute()) {
    header("Location: ../../dashboard/users.php?status=1"); // Redirigir con éxito
    echo "Registro insertado correctamente";
} else {
    die("Error al insertar en la tabla Usuarios: " . $stmt->error); // Redirigir con error
    header("Location: ../../dashboard/users.php?status=0");
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conexion->close();
?>
