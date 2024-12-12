
<?php
    include "../admin/php/conexion.php";
?>
<header class="pt-2">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div>     
                        <a href="../index.php">                  
                        <img src="../img/logo.webp" style="height: 50px; width: 50px;" alt="GamesNow Logo">
</a>
                    </div>
                    
                    
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="navbar-item mx-3">
                                <button type="button" class="btn position-relative">
                                    <i class="bi bi-bell-fill"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      99+
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                            </li>
                            <li class="navbar-item-mx-3">
                                <?php
                                // Obtener una sola fila de la tabla multimedia
                                    $resPubli = mysqli_query($conexion, "
                                        SELECT m.* 
                                        FROM multimedia m
                                        JOIN autores a ON a.idMult = m.idMult
                                        ORDER BY m.idMult ASC
                                        LIMIT 1
                                    ") or die($conexion->error);

                                // Comprobar si la consulta devuelve resultados
                                if ($filaPubli = mysqli_fetch_array($resPubli)) {
                                ?>
                                <div>                       
                                    <img src="../img/autoresImg/<?php echo $filaPubli['url'] ?>" style="height: 50px; width: 50px; border-radius: 50%;" alt="user">
                                </div>
                                <?php
                                }
                                ?>
                            </li>
                            <li class="navbar-item mx-3 dropdown">
                                <a href="" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        echo $user_data['nombre'];
                                    ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a href="" class="dropdown-item">
                                            <i class="bi bi-person"></i>&nbsp;&nbsp;Perfil</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider"/>
                                    </li>
                                    <li>
                                        <a href="../admin/php/cerrar-sesion.php" class="dropdown-item">
                                            <i class="bi bi-box-arrow-left"></i>&nbsp;&nbsp;Cerrar Sesión</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>       
            </nav>
        </header>