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

        // Inserción en Publi
        $consultaPubli = "INSERT INTO Publi (titulo, contenido, fechaPubli, idAutor, idTipo, idMult) 
                          VALUES ('$titulo', '$contenido', '$fecha', '$autor', '$tipo', '$idMult')";

        if ($conexion->query($consultaPubli)) {
            header("Location: ../../dashboard/articulos.php?status=1");
            echo "Registro insertado correctamente";

        } else {
            die("Error al insertar en la tabla Publi: " . $conexion->error);
            header("Location: ../../dashboard/articulos.php?status=0");
        }

    } else {
        die("Error al insertar el archivo en la tabla multimedia.");
    }

} else {
    die("Algo falló en la subida del archivo.");
}

?>
