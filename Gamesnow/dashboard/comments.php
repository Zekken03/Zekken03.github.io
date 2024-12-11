<?php
    include "../admin/php/conexion.php";
    $sql = "SELECT 
                c.idComentario,
                c.comentario,
                c.fecha AS fechaComentario,
                u.nombre AS nombreUsuario,
                p.titulo AS tituloPublicacion
            FROM comentarios c
            JOIN usuarios u ON c.idUsuario = u.idUsuario
            JOIN publi p ON c.idPubli = p.idPubli
            ORDER BY c.fecha DESC;";
    $res = $conexion -> query($sql) or die($conexion->error);
?>
<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ../iniciar.php");
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
    <link rel="icon" href="../img/logo.ico">
</head>
<body class="row d-flex"style="height: 100%;">
    <!-- SIDEBAR -->
    <?php
        include "../layouts/aside.php"; 
    ?>

    <!-- END SIDEBAR -->
    <!-- MAIN CONTENT -->
     <main class="flex-grow-1 col-9 ">
        <?php
            include "../layouts/header.php"; 
        ?>
        <hr class="mx-4">
        <section class="container mt-4 pt-4">
            
            <!-- TITTLE SECTION -->
            <div class="d-flex justify-content-between">
                <h4>Comentarios</h4>
            </div>
            
            <!-- TITTLE SECTION -->
            <!-- DATA -->
            <?php
                while($fila = mysqli_fetch_array($res)){
            ?>
            <div class="col-12 p-0 my-2 px-2">
                <div class="card">
                    <div class="card-header">
                        Comentario
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p><?php echo $fila['comentario'] ?></p>
                            <footer class="blockquote-footer"><?php echo $fila['nombreUsuario'] ?> en <cite title="Source Title">GamesNow</cite></footer>
                        </blockquote>
                    </div>
                    <div class="card-footer text-body-secondary">
                    <?php echo $fila['fechaComentario'] ?>
                        <button class="btn text-white position-absolute bottom-0 end-0 m-1 " data-bs-toggle="modal" data-bs-target="#checkModal"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 3rem; --bs-btn-font-size: 1rem;">Revisar</button>
                    </div>
                </div>   
                <br>
            <hr>
            <br>                
            </div>
            <?php
                }

            ?>  
            



           
            
            <!-- DATA -->
        </section>
     </main>
    <!-- END MAIN CONTENT --> 
    <!-- MODAL check -->
     <div class="modal fade " id="checkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="row">
                <div class="col-12 p-0 my-2 px-2">
                    <div class="card">
                        <div class="card-header">
                            Comentario
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores delectus tenetur nostrum 
                                    consequuntur nulla, omnis voluptate rerum, quam, natus numquam non odit deserunt reiciendis eaque 
                                    ipsum qui eius fuga. Modi?</p>
                                <footer class="blockquote-footer">************************* <cite title="Source Title">GamesNow</cite></footer>
                            </blockquote>
                        </div>
                        <div class="card-footer text-body-secondary">
                            hace *******************
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-0 my-2 px-2">
                    <div class="card">
                        <div class="card-header">
                            Publicación
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores delectus tenetur nostrum 
                                    consequuntur nulla, omnis voluptate rerum, quam, natus numquam non odit deserunt reiciendis eaque 
                                    ipsum qui eius fuga. Modi?</p>
                                <footer class="blockquote-footer">Autor: ************************* <cite title="Source Title">GamesNow</cite></footer>
                            </blockquote>
                        </div>
                        <div class="card-footer text-body-secondary">
                            hace *******************
                            <button class="btn text-white position-absolute bottom-0 end-0 m-1 " data-bs-toggle="modal" data-bs-target="#checkModal"
                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 3rem; --bs-btn-font-size: 1rem;">Ver publicación</button>
                        </div>
                    </div>                   
                </div>
            </div>
           
        </div>
    </div>
    <!-- MODAL check-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/articulos.js"></script>
</body>
</html>