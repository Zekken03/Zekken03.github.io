<?php 
session_start();
if (!isset($_SESSION['user_data'])) {
    header("Location: ../iniciar.php");
    exit;
}

include "../admin/php/conexion.php";

// Verificar si el usuario es autor
$idUsuario = $_SESSION['user_data']['id'];
$sqlAutor = "SELECT * FROM autores WHERE idUsuario = $idUsuario";
$resAutor = $conexion->query($sqlAutor);

if (mysqli_num_rows($resAutor) == 0) {
    // Si no es autor, redirigir al login
    header("Location: ../iniciar.php");
    exit;
}

$user_data = $_SESSION['user_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/stylesBoot.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="icon" href="../img/logo.ico">
</head>
<body class="row d-flex"style="height: 100%;">
    <!-- SIDEBAR -->
    <?php
        include "../layouts/aside.php"; 
    ?>
    <!-- END SIDEBAR -->
    <!-- MAIN CONTENT -->
     <main class="flex-grow-1 col-9">
        <?php
            include "../layouts/header.php"; 
        ?>
        <hr class="mx-4">
        <section class="container mt-4 pt-4">
            <h4>Bienvenido</h4>
            <!-- STATS -->
             <div class="row">
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body">
                            <label class="">
                                <i class="bi bi-people-fill" style="color:#1e9090 ;"></i>
                                PERSONAS ALCANZADAS
                            </label>
                            <h5 class="h2"> 486 </h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body">
                            <label class="">
                                <i class="bi bi-person-check-fill" style="color: #1e9090;"></i>
                                USUARIOS ACTIVOS
                            </label>
                            <h5 class="h2"> 180 </h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body">
                            <label class="">
                                <i class="bi bi-pen-fill"style="color: #1e9090;"></i>
                                AUTORES ACTIVOS
                            </label>
                            <h5 class="h2"> 5 </h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body">
                            <label class="">
                                <i class="bi bi-book-fill"style="color: #1e9090;"></i>
                                ARTÍCULOS PUBLICADOS
                            </label>
                            <h5 class="h2"> 158 </h5>
                        </div>
                    </div>
                </div>
             </div>
            <!-- STATS -->
            <!-- CHARTS -->
             <div class="row mt-4">
                <div class="col-6">
                    <div class="card" style="height: 500px;">
                        <div class="card-header">
                            ALCANCE POR MESES
                        </div>
                        <div class="card-body mt-4">
                            <canvas id="chartAlcance"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="height: 500px;">
                        <div class="card-header">
                            ALCANCE POR CATEGORÍAS
                        </div>
                        <div class="card-body ms-4" style="height: 400px; width: 500px;">
                            <canvas id="chartCategorias" style="height: 300px; width: 300px;" class="ms-4"></canvas>
                        </div>
                    </div>
                </div>
             </div> 
             <div class="row mt-4">
                <div class="col-6">
                    <div class="card" style="height: 500px;">
                        <div class="card-header">
                            PAÍSES DE USUARIOS
                        </div>
                        <div class="card-body mt-4">
                            <canvas id="chartPaises" style="color: #1e9090;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="height: 500px;">
                        <div class="card-header">
                            EDADES DE USUARIOS
                        </div>
                        <div class="card-body ms-4" style="height: 400px; width: 500px;">
                            <canvas id="chartEdades" style="height: 300px; width: 300px; "`class="ms-4"></canvas>
                        </div>
                    </div>
                </div>
             </div>
            <!-- CHARTS -->
        </section>
        <br>
        <br>
        <h4 class="h5 mx-4">Progreso de meta actual:</h4>
        <br>
        <div class="progress mx-4"  role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 45%; background-color:#1e9090">45%</div>
          </div>
     </main>
    <!-- END MAIN CONTENT --> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>