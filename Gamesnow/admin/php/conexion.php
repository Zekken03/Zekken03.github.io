<?php
    $servidor='skyzerozx.com';
    $port="3306";
    $user="skyzeroz_games-now-admin";
    $password="5k7xsg#urcO0";
    $db="skyzeroz_games-now";
    $conexion= new mysqli($servidor,$user,$password,$db);
    if($conexion->connect_error){
        die("no se puede conectar al mysql ENCIENDELO");
    }
    $conexion->set_charset("utf8mb4");
?>