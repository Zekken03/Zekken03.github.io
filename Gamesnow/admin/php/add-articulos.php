<?php
include "./conexion.php";

$tipo = $_POST['txtTipo'];
$titulo = $_POST['txtTitulo']; 
$contenido = $_POST['txtContenido']; 
$autor = $_POST['txtAutor']; 
$fecha = date('Y-m-d');
$file = $_FILES['txtImg']['name'];
$temp = explode(".", $file);
$ext = end($temp);
$destino = "../../img/articulosImg/";
$file_name = date('Y_m_d_h_m_s') . "_" . rand(10000, 99999) . "." . $ext;

// Intentar mover el archivo a la carpeta destino
if (move_uploaded_file($_FILES["txtImg"]['tmp_name'], $destino . $file_name)) {

    // Insertar el archivo en la tabla 'multimedia'
    $consultaMultimedia = "INSERT INTO multimedia (url, estado) 
                           VALUES ('$file_name', 'Imagen')";

    if ($conexion->query($consultaMultimedia)) {
        // Obtener el ID del archivo recién insertado
        $idMult = $conexion->insert_id;

        // Verificar si el idTipo existe
        $resultTipo = $conexion->query("SELECT idTipo FROM Tipo WHERE idTipo = '$tipo'");
        if ($resultTipo->num_rows == 0) {
            die("Error: El tipo con id '$tipo' no existe en la tabla Tipo.");
        }

        // Verificar si el idAutor existe
        $resultAutor = $conexion->query("SELECT idAutor FROM Autores WHERE idAutor = '$autor'");
        if ($resultAutor->num_rows == 0) {
            die("Error: El autor con id '$autor' no existe en la tabla Autores.");
        }

        // Llamar al procedimiento almacenado para insertar en Publi
        $stmt = $conexion->prepare("CALL InsertarPubli(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiii", $titulo, $contenido, $fecha, $autor, $tipo, $idMult);

        if ($stmt->execute()) {
            header("Location: ../../dashboard/articulos.php?status=1");
            echo "Registro insertado correctamente";
        } else {
            die("Error al insertar en la tabla Publi: " . $stmt->error);
            header("Location: ../../dashboard/articulos.php?status=0");
        }

        $stmt->close();

    } else {
        die("Error al insertar el archivo en la tabla multimedia.");
    }

}  else {
    // Si ocurre un error en la consulta
    echo "Error al insertar registro: " . $consulta->error;
    header("Location: ../../dashboard/articulos.php?status=0");
    exit(); // Asegura que el script termine después de la redirección
}

// Cerrar la consulta y la conexión
$consulta->close();
$conexion->close();
?>