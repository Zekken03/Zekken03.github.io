<?php
session_start();
include "./conexion.php";

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_data']) || !isset($_SESSION['user_data']['id'])) {
    echo "Debes iniciar sesión para comentar.";
    exit;
}

// Si el formulario se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibe el comentario y el ID de la publicación
    $comentario = $_POST['comentario'] ?? '';
    $idPubli = $_POST['idPubli'] ?? '';

    // Asegúrate de que los datos no estén vacíos
    if (empty($comentario) || empty($idPubli)) {
        echo "Comentario o ID de publicación no válido.";
        exit;
    }

    // Obtiene el ID del usuario desde la sesión
    $idUsuario = $_SESSION['user_data']['id'];

    // Inserta el comentario en la base de datos
    $sql = "INSERT INTO comentarios (idPubli, idUsuario, comentario, fecha) VALUES (?, ?, ?, NOW())";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iis", $idPubli, $idUsuario, $comentario);

    if ($stmt->execute()) {
        // Redirige con un parámetro en la URL para indicar éxito
        header("Location: ../../dashboard/ver-articulo.php?id=" . $idPubli . "&status=1");
        exit;
    } else {
        // Redirige con un parámetro en la URL para indicar error
        header("Location: ../../dashboard/ver-articulo.php?id=" . $idPubli . "&status=0");
        exit;
    }
}
?>

