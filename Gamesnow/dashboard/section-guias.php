<?php
session_start();
include "../admin/php/conexion.php";

// Verificar si hay un usuario autenticado
$usuarioAutenticado = isset($_SESSION['user_data']);
$user_data = $usuarioAutenticado ? $_SESSION['user_data'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamesNow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    
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
                    <a class="pt-3" href="../index.php">
                        <h1 id="gn">GAMESNOW</h1>
</a>
                    </div>

                    <div id="login">
    <?php if ($usuarioAutenticado): ?>
        <a href="../admin/php/logout.php" class="login-out" >Cerrar sesión</a>
    <?php else: ?>
        <a href="../iniciar.php" class="login-button">Crear cuenta / Iniciar sesión</a>
    <?php endif; ?>
</div>

<?php if ($usuarioAutenticado): ?>
    <span class="user-welcome">¡Hola, <?php echo htmlspecialchars($user_data['nombre']); ?>!</span>
<?php endif; ?>
                </div>
                <div id="barra"></div>
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
    <input style="height:25px" type="text" placeholder="Buscar" class="search-bar" id="search-input">
    <i class="fa-solid fa-magnifying-glass search-icon" onclick="searchPubli()"></i>
</div>
<div id="search-results"></div> <!-- El contenedor ahora solo está vacío al cargar la página -->

<?php if (isset($result) && mysqli_num_rows($result) > 0 && isset($search_query)): ?>
    <h3>Resultados de búsqueda:</h3>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="search-item">
            <h4>
                <a href="ver_articulo.php?id=<?php echo $row['idPubli']; ?>">
                    <?php echo htmlspecialchars($row['titulo']); ?>
                </a>
            </h4>
        </div>
    <?php endwhile; ?>
<?php elseif (isset($search_query) && $search_query != ''): ?>
    <div class="no-results">
        <p>No se encontraron resultados para "<?php echo htmlspecialchars($search_query); ?>".</p>
    </div>
<?php endif; ?>

                    </li>
                    
                </ul>


            </nav>

        </header>
        <section id="mainplus">
            <div class="space"></div>
                <section id="main">
          

                    <section id="articulos">
                        <section class="recent-news">
                            <h2>ÚLTIMAS GUÍAS</h2>
                            <div class="news-list">
                                
                                    <?php
                                    $resPubli = mysqli_query($conexion, "
                                    SELECT publi.*, usuarios.nombre, tipo.tipo, autores.biografia, autores.redes, multimedia.*
                                    FROM publi
                                    JOIN usuarios ON publi.idAutor = usuarios.idUsuario
                                    JOIN tipo ON publi.idTipo = tipo.idTipo
                                    JOIN autores ON usuarios.idUsuario = autores.idUsuario
                                    JOIN multimedia ON publi.idMult = multimedia.idMult
                                    WHERE tipo.tipo = 'Guia'
                                    ORDER BY publi.idPubli DESC
                                ") or die($conexion->error);
                                    while ($filaPubli = mysqli_fetch_array($resPubli)) {
                                ?>
                                <a href="../dashboard/ver-articulo.php?id=<?php echo $filaPubli['idPubli']; ?>">
                                    <article class="recent-news-item">
                                        <div id="letra">
                                            <h3 style="margin-right:50px; margin-top:40px"><?php echo $filaPubli['titulo'] ?></h3>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="lib/js/wysihtml5-0.3.0.js"></script>
<script src="lib/js/jquery-1.7.2.min.js"></script>
<script src="lib/js/prettify.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/articulos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
function searchPubli() {
    const searchQuery = document.getElementById('search-input').value;

    // Si el término de búsqueda está vacío, limpiar resultados y no continuar
    if (searchQuery.trim() === '') {
        document.getElementById('search-results').innerHTML = '';
        return;
    }

    // Vaciar el contenedor de resultados antes de agregar nuevos
    const resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = ''; // Limpiar el contenedor

    // Hacer la solicitud al servidor para obtener los resultados
    fetch('../admin/php/search.php?q=' + encodeURIComponent(searchQuery))
        .then(response => response.json())
        .then(data => {
            if (data.results.length > 0) {
                resultsContainer.innerHTML = '<h3>Resultados de búsqueda:</h3>';
                data.results.forEach(result => {
                    resultsContainer.innerHTML += `
                        <div class="search-item">
                            <h4>
                                <a href="./ver-articulo.php?id=${result.idPubli}">
                                    ${result.titulo}
                                </a>
                            </h4>
                        </div>
                    `;
                });
            } else {
                resultsContainer.innerHTML = `<div class="no-results"><p>No se encontraron resultados para "${searchQuery}".</p></div>`;
            }
        })
        .catch(error => {
            console.error('Error al realizar la búsqueda:', error);
        });
}

// Agregar un event listener al campo de búsqueda para ejecutar la función mientras se escribe
document.getElementById('search-input').addEventListener('input', function() {
    searchPubli();
});
</script>

</body>
</html>
