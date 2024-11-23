<?php

    include "./conexion.php";
    //CACHAR DATOS
    $email = $_POST['txtUser'];
    $password = $_POST['txtPassword'];

    echo "Bienvenido: $email tu password es: $password";
?>
