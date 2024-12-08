<?php
    include "../admin/php/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamesNow</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/effects.css">
    <link rel="stylesheet" href="../css/mediaquery.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="./img/black.webp" as="image" type="image/webp">
    <link rel="preload" href="./img/dead.webp" as="image" type="image/webp">
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
    <link rel="icon" href="../img/logo.ico">
</head>
<body>
    <div class="containeer">
        <header>
            <div class="logo">
            <a href="../index.php">
                <img src="../img/logo.webp" alt="GamesNow Logo">
</a>
            </div>
            <nav class="navbar">
                <div class="contentGames">
                    <div id="name">
                    <a href="../index.php">
                        <h1 id="gn">GAMESNOW</h1>
</a>
                    </div>

                    <div id="login">
                        <a href="iniciar.php" class="login-button"> Crear cuenta / Iniciar sesión</a>
                    </div>
                </div>
                <div id="barra"></div>
                <ul>
                <li><a href="../dashboard/section-analisis.php">Análisis</a></li>
                <li><a href="../dashboard/section-guias.php">Guías</a></li>
                    <li><a href="../dashboard/section-noticias.php">Noticias</a></li>
                    <li><a href="#guias">PC</a></li>
                    <li><a href="#">Xbox</a></li>
                    <li><a href="#">PlayStation</a></li>
                    <li><a href="#">Nintendo</a></li>
                    <li>
                        <div class="search-container">
                            <input type="text" placeholder="Buscar" class="search-bar">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        </div>
                    </li>
                    
                </ul>


            </nav>

        </header>
        <section id="mainplus">
            <div class="space"></div>
                <section id="main">
          

                    <section id="articulos">
                        <section class="recent-news">
                            <h2>ÚLTIMOS ANÁLISIS</h2>
                            <div class="news-list">
                                
                                    <?php
                                    $resPubli = mysqli_query($conexion, "
                                    SELECT publi.*, usuarios.nombre, tipo.tipo, autores.biografia, autores.redes, multimedia.*
                                    FROM publi
                                    JOIN usuarios ON publi.idAutor = usuarios.idUsuario
                                    JOIN tipo ON publi.idTipo = tipo.idTipo
                                    JOIN autores ON usuarios.idUsuario = autores.idUsuario
                                    JOIN multimedia ON publi.idMult = multimedia.idMult
                                    WHERE tipo.tipo = 'Analisis'
                                    ORDER BY publi.idPubli ASC
                                    LIMIT 5
                                ") or die($conexion->error);
                                    while ($filaPubli = mysqli_fetch_array($resPubli)) {
                                ?>
                                <a href="../dashboard/ver-articulo.php?id=<?php echo $filaPubli['idPubli']; ?>">
                                    <article class="recent-news-item">
                                        <div id="letra">
                                            <h3 style="margin-right:50px; margin-top:20px"><?php echo $filaPubli['titulo'] ?></h3>
                                            <p><?php echo $filaPubli['nombre']?></p>
                                            <p><?php echo $filaPubli['fechaPubli']?></p>
                                        </div>
                                        <div id="noticia">
                                            <img src="../img/articulosImg/<?php echo $filaPubli['url'] ?>"  alt="Noticia 1" width="600" height="400" loading="lazy">
                                        </div>
                                        </article>
                                        </a>
                                        <?php
                                    }
        
                                  ?>   
                                
                            
                            </div>
                        </section>
                    </section>
                </section>
            <div class="space"></div>
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
</body>
</html>
