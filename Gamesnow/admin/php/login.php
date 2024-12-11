<?php
session_start();
include "./conexion.php";

// CACHAR DATOS
$user = mysqli_real_escape_string($conexion, $_POST['txtUser']);
$password = mysqli_real_escape_string($conexion, $_POST['txtPassword']);

// Validar usuario y contraseña
$sql = "SELECT * FROM usuarios WHERE nombre = '$user' AND password = '$password';";
$res = $conexion->query($sql) or die($conexion->error);

if (mysqli_num_rows($res) > 0) {
    $fila = mysqli_fetch_assoc($res);
    $idUsuario = $fila['idUsuario'];
    $name = $fila['nombre'];
    $email = $fila['correo'];

    // Consultar si el usuario es un autor
    $sqlAutor = "SELECT * FROM autores WHERE idUsuario = $idUsuario";
    $resAutor = $conexion->query($sqlAutor);

    // Guardar datos en sesión
    $_SESSION['user_data'] = [
        'id' => $idUsuario,
        'nombre' => $name,
        'correo' => $email
    ];

    // Obtener la URL de redirección desde el formulario
    $redirectUrl = isset($_POST['redirect']) ? $_POST['redirect'] : 'index.php';

    // Redirigir según si es autor o no
    if (mysqli_num_rows($resAutor) > 0) {
        // Usuario es un autor (Administrador)
        header('Location: ../../dashboard/admin.php');
    } else {
        // Usuario no es autor (Usuario regular)
        header('Location: ' . $redirectUrl); // Redirige a la página donde estaba el usuario
    }
    exit;
} else {
    // Usuario no válido
    header("Location: ../../iniciar.php?error=1");
    exit;
}
?>
