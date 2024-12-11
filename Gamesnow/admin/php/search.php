<?php
// search.php

include "./conexion.php";

$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

// Evitar inyecciones SQL
$searchQuery = mysqli_real_escape_string($conexion, $searchQuery);

// Consulta SQL para buscar en la base de datos
$sql = "SELECT * FROM publi WHERE titulo LIKE '%$searchQuery%' OR contenido LIKE '%$searchQuery%'";

$result = mysqli_query($conexion, $sql);

$results = [];
while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
}

echo json_encode(['results' => $results]);
?>