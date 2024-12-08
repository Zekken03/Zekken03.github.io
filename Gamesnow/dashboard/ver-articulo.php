<?php
include "../admin/php/conexion.php";

// Verifica si el ID está presente
if (isset($_GET['id'])) 
    $id = intval($_GET['id']); // Convierte el ID a entero para mayor seguridad

    // Consulta para obtener título, contenido y nombre del elemento seleccionado
    $sql = "SELECT Publi.titulo, Publi.contenido, Usuarios.nombre, Multimedia.idMult, Multimedia.estado, Multimedia.url, Multimedia.descripcion
            FROM Publi
            INNER JOIN Usuarios ON Publi.idAutor = Usuarios.idUsuario
            INNER JOIN Multimedia ON Publi.idMult = Multimedia.idMult
            WHERE Publi.idPubli = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    // Consulta para los comentarios
    $sqlComentarios = "SELECT Usuarios.nombre, Comentarios.comentario, Comentarios.fecha
    FROM Comentarios
    INNER JOIN Usuarios ON Comentarios.idUsuario = Usuarios.idUsuario
    WHERE Comentarios.idPubli = ?
    ORDER BY Comentarios.fecha DESC"; // Ordenar por fecha
    $stmtComentarios = $conexion->prepare($sqlComentarios);
    $stmtComentarios->bind_param("i", $id);
    $stmtComentarios->execute();
    $resComentarios = $stmtComentarios->get_result();

    // Verifica si hay resultados
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamesNow</title>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
      
<link rel="stylesheet" href="../css/stylesBoot.css">  
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/mediaquery.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" as="style" onload="this.rel='stylesheet'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
            crossorigin="anonymous" referrerpolicy="no-referrer">
    </noscript>
    <style>
        /* Agregar espacio a los lados del contenido principal */
        .news-item0 {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Agregar espacio al texto del contenido */
        .news-list {
            padding-left: 30px; /* Espacio izquierdo */
            padding-right: 30px; /* Espacio derecho */
        }
    </style>

    <link rel="icon" href="../img/logo.ico">

</head>
<body>
    <div class="containeer">
        <header >
            <div class="logo">
            <a href="../index.php" >
                <img src="../img/logo.webp" alt="GamesNow Logo">
</a>
            </div>
            <nav class="navbar">
                <div class="contentGames">
                    <div id="name">
                    <a class="pt-3" href="../index.php">
                        <h1 id="gn">GAMESNOW</h1>
                        </a>
                    </div>

                    <div id="login">
                        <a  href="../iniciar.php" class="login-button"> Crear cuenta / Iniciar sesión</a>
                    </div>
                </div>
                <div id="barra" ></div>
                <ul class="pt-3">
                <li><a href="../dashboard/section-analisis.php">Análisis</a></li>
                    <li><a href="../dashboard/section-guias.php">Guías</a></li>
                    <li><a href="../dashboard/section-noticias.php">Noticias</a></li>
                    <li><a href="#guias">PC</a></li>
                    <li><a href="#">Xbox</a></li>
                    <li><a href="#">PlayStation</a></li>
                    <li><a href="#">Nintendo</a></li>
                    <li>
                        <div class="search-container">
                            <input style="height:25px" type="text" placeholder="Buscar" class="search-bar">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        </div>
                    </li>
                    
                </ul>


            </nav>

        </header>
      
        <section id="mainplus" >
            <div  class="space"></div> 
                <section id="main">
                    <section id="articulos">
                        <section class="news-item0">
                            <div  class="news-list">
                            <?php
if ($fila = $res->fetch_assoc()) { 
    // Aquí obtenemos los datos de una sola fila
    $titulo = htmlspecialchars($fila['titulo']);
    $nombre = htmlspecialchars($fila['nombre']);
    $contenido = $fila['contenido'];  // Usamos directamente el contenido desde la base de datos

?>
    <!-- Mostramos cada elemento por separado -->
    <h3 class="h1 mt-3 mx-4"><?php echo $titulo; ?></h3>
    <p class="h6 mx-4"><?php echo $nombre; ?></p>
    <img src="../img/articulosImg/<?php echo $fila['url'] ?>" class="card-img-top" alt="..." style="height: 100%;">  
    <div id="contenido"><?php echo $contenido; ?></div>  <!-- Contenedor para el contenido -->

<?php 
} else { 
    echo "<p>No se encontraron datos.</p>";
} 
?>



                            </div>
                        </section>
                    </section>
                </section>
            <div class="space"></div>
        </section>
        <section id="comentarios"> 
        <div class="col-12 p-0 my-2 px-4 ">
        <?php 
        if ($resComentarios->num_rows > 0) {
            while ($comentario = $resComentarios->fetch_assoc()) { 
                $nombreUsuario = htmlspecialchars($comentario['nombre']);
                $textoComentario = htmlspecialchars($comentario['comentario']);
                $fechaComentario = htmlspecialchars($comentario['fecha']);
        ?>
                <div class="card mx-4 mt-4"style="background-color: #efeffff; width:92%;">


                    <div class="card-body"style="background-color: #ef0ff ; width:100%;">
                        <blockquote class="blockquote mb-0" style="background-color: transparent; color: inherit;width:100%;">
                            <p><?php echo $textoComentario; ?></p>
                            <div class="blockquote-footer"style="background-color: transparent; color: inherit;width:100%;"><?php echo $nombreUsuario;?><cite title="Source Title"> en  GamesNow</cite></div>
                    </div>
                    <div class="card-footer text-body-secondary" style="background-color: #ef0ff; ">
                    <?php echo $fechaComentario; ?>
                    </div>
                </div>  
                <?php 
            
        } 
        } 
        ?> 
                <br>
            <hr>
            <br>                
            </div>
            </section>
        <section class="subscription">
            <h3>Recibe nuestras últimas noticias:</h3>
            <form action="#">
                <input type="email" placeholder="Escribe tu correo electrónico">
                <button type="button">Suscribirse</button>
            </form>
            <p>Suscribiéndote aceptas nuestras
                <a href="#" class="link-privacidad">políticas de privacidad</a>
            </p>
        </section>
    </div>

    <footer>
        <div class="footer-info">
            <div>
                <ul>
                    <li><a class="upper" href="#">Nosotros</a></li>
                    <li><a href="#">Sobre nosotros</a></li>
                    <li><a href="#">Autores</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><a class="upper" href="#">Nuestra política</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Política de cookies</a></li>
                    <li><a href="#">Política de privacidad</a></li>
                </ul>
            </div>

        </div>
        <div class="footer-info1">
            <div class="indice">
                <ul>
                    <li><a class="upper"href="#">Índice</a></li>
                    <li><a href="#analisis">Análisis</a></li>
                    <li><a href="#">Tecnología</a></li>
                    <li><a href="#articulos">Artículos</a></li>
                    <li><a href="#guias">Guías</a></li>
                    <li><a href="#">PC</a></li>
                    <li><a href="#">PlayStation</a></li>
                    <li><a href="#">Xbox</a></li>
                    <li><a href="#">Nintendo</a></li>
    
                </ul>
    
    
            </div>
            <div class="social-media">
                <div>
                    <h2>Síguenos:</h2>
                </div>
                <div class="redes">
                    <ul>
                        <li><a href="https://www.facebook.com" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="https://web.whatsapp.com" target="_blank" aria-label="Whatsapp"><i class="fa-brands fa-whatsapp"></i></a></li>
                        <li><a href="https://www.instagram.com" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="https://www.youtube.com" target="_blank" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a></li>
                        <li><a href="https://x.com/?lang=es" target="_blank" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="lib/js/wysihtml5-0.3.0.js"></script>
<script src="lib/js/jquery-1.7.2.min.js"></script>
<script src="lib/js/prettify.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/articulos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
</body>
</html>
