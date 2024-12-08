<?php
include "./conexion.php";

// Verificamos si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibimos los datos del formulario
$nombreCompleto = $_POST['txtNombre'] ?? ''; // Aseguramos que las variables no estén vacías
$biografia = $_POST['txtBiografia'] ?? '';
$redes = $_POST['txtRedes'] ?? '';
$correo = $_POST['txtCorreo'] ?? '';
$password = $_POST['txtPassword'] ?? '';
 // Recibimos el campo de apellidos

// Validación inicial de los datos
if (empty($nombreCompleto) || empty($correo) || empty($password) || empty($biografia) || empty($redes)) {
    header("Location: ../../dashboard/autores.php?status=0");
    exit; // Detenemos la ejecución
}

// Verificar si el correo ya está registrado
$query_check_email = "SELECT idUsuario FROM Usuarios WHERE correo = ? LIMIT 1";
$stmt_check_email = $conexion->prepare($query_check_email);
$stmt_check_email->bind_param("s", $correo);
$stmt_check_email->execute();
$result_check_email = $stmt_check_email->get_result();

if ($result_check_email->num_rows > 0) {
    // El correo ya está registrado
    echo "Error: El correo '$correo' ya está registrado.";
} else {
    // Procedemos con la inserción si el correo no existe
    // Insertamos en la tabla Usuarios con el campo de apellidos
    $query_insert_usuario = "INSERT INTO Usuarios (nombre, correo, password) 
                             VALUES (?, ?, ?)";
    
    $stmt_insert_usuario = $conexion->prepare($query_insert_usuario);
    $stmt_insert_usuario->bind_param("sss", $nombreCompleto, $correo, $password);

    if ($stmt_insert_usuario->execute()) {
        // Después de insertar el usuario, insertamos en la tabla Autores
        $query_insert_autor = "INSERT INTO Autores (biografia, redes, idUsuario) 
                               VALUES (?, ?, (SELECT idUsuario FROM Usuarios WHERE correo = ? LIMIT 1))";
        
        $stmt_insert_autor = $conexion->prepare($query_insert_autor);
        $stmt_insert_autor->bind_param("sss", $biografia, $redes, $correo);
        
        if ($stmt_insert_autor->execute()) {
            header("Location: ../../dashboard/autores.php?status=1"); // Redirigir con éxito
            echo "Registro insertado correctamente";
        } else {
            echo "Error al agregar el autor: " . $stmt_insert_autor->error;
        }
    } else {
        die("Error al insertar en la tabla Usuarios: " . $stmt->error); // Redirigir con error
        header("Location: ../../dashboard/autores.php?status=0");
    }

    // Cerramos las sentencias
    $stmt_insert_usuario->close();
    $stmt_insert_autor->close();
}

// Cerramos la conexión
$conexion->close();
?>
