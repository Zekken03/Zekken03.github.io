<?php
include "./conexion.php";

// Obtener los datos del formulario
$nombre = $_POST['txtNombre'];
$correo = $_POST['txtCorreo'];
$password = $_POST['txtPassword'];

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($correo) || empty($password)) {
    header("Location: ../../index.php?status=campos_vacios");
    exit();
}

// Intentar insertar en la tabla 'Usuarios'
try {
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $password);

    if ($stmt->execute()) {
        // the message
        $msg = "Hola mundo, ganaste 100000 pesos";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail($correo,"Registrado correctamente",$msg);
        // Éxito al insertar
        header("Location: ../../index.php?status=registro_exitoso");
    } else {
        throw new Exception($stmt->error);
    }

} catch (Exception $e) {
    // Verificar si el error es por entrada duplicada
    if (strpos($e->getMessage(), "Duplicate entry") !== false) {
        header("Location: ../../index.php?status=correo_duplicado");
    } else {
        header("Location: ../../index.php?status=error_general");
    }
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cerrar la sentencia y la conexión
$stmt->close();
$conexion->close();
?>


