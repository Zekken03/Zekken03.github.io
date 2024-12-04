<?php
    include "../admin/php/conexion.php";
    $sql = "select * from Tipo order by idTipo DESC";
    $res = $conexion -> query($sql) or die($conexion->error);
    $sql1 = "SELECT u.*, a.biografia, a.redes
        FROM Usuarios u
        JOIN Autores a ON u.idUsuario = a.idUsuario
        ORDER BY u.idUsuario DESC;";
    $res1 = $conexion -> query($sql1) or die($conexion->error);
    $sql2 = "SELECT p.idPubli, p.titulo, u.nombre, p.contenido, p.idAutor 
        FROM Publi p
        INNER JOIN Usuarios u ON p.idAutor = u.idUsuario
        ORDER BY p.idPubli DESC";
    $res2 = $conexion -> query($sql2) or die($conexion->error);
    $sql3 = "select * from Etiquetas order by idEtiqueta DESC";
    $res3 = $conexion -> query($sql3) or die($conexion->error);
    $sql4 = "select u.*, a.* from Autores a JOIN  usuarios u on u.idUsuario = a.idUsuario order by a.idAutor desc";
    $res4 = $conexion -> query($sql4) or die($conexion->error);
 


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
                <h4>Artículos</h4>
                <button class="btn btn-dark m-3 " data-bs-toggle="modal" data-bs-target="#exampleModal"> 
                    <i class="bi bi-plus"></i> 
                    Agregar
                </button>
            </div>
            
            <!-- TITTLE SECTION -->
            <!-- DATA -->
            <div class="row px-4">
            <?php
                $resPubli = mysqli_query($conexion, "
                SELECT publi.*, usuarios.nombre, tipo.tipo, autores.biografia, autores.redes, multimedia.*
                FROM publi
                JOIN usuarios ON publi.idAutor = usuarios.idUsuario
                JOIN tipo ON publi.idTipo = tipo.idTipo
                JOIN autores ON usuarios.idUsuario = autores.idUsuario
                JOIN multimedia ON publi.idMult = multimedia.idMult
                ORDER BY publi.idPubli ASC
            ") or die($conexion->error);
                while ($filaPubli = mysqli_fetch_array($resPubli)) {
            ?>
                <div class="col-3 p-0 my-2 px-2">
                    
                    <div class="card">
                        <img src="../img/articulosImg/<?php echo $filaPubli['url'] ?>" class="card-img-top" alt="..."style="height: 200px ;">
                        <div class="card-body "style="height: 260px ;">
                          <h5 class="card-title"><?php echo $filaPubli['titulo'] ?></h5>
                          <p class="card-text"><?php echo $filaPubli['nombre'] ?></p>
                          <a href="ver-articulo.php?id=<?php echo $filaPubli['idPubli']; ?>" class="btn btn-primary btn-dark">Ver</a>
                          <button class="btn btn-danger btn-sm mx-1 " data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                        <button class="btn btn-warning btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        </div>
                      </div>
                     
                </div>
                <?php
                            }

                          ?>   
                    </div>
                      
                </div>
             </div>
            <!-- DATA -->
        </section>
     </main>    
    <!-- END MAIN CONTENT --> 
   
    <!-- MODAL -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen p-4">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar artículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../admin/php/add-articulos.php" enctype="multipart/form-data" method="post" class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <div class="row px-2 py-2">
                            <div class="col-3">
                                <label for="">Tipo de publicación</label>
                                
                                <select name="txtTipo" class="form-control"required type="">
                                
                                    <option value="" selected>Seleccione la categoría</option>
                                    <?php
                                        while($fila = mysqli_fetch_array($res)){
                                    ?>
                                    <option value="<?php echo $fila['idTipo'] ?>"><?php echo $fila['tipo']; ?></option>
                                  
                                <?php
                                    }
                                ?>
                                </select>  
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Titular</label>
                                <input name="txtTitulo" required type="text" class="form-control" placeholder="Inserta los apellidos" pattern="[A-Za-zÀ-ÿ\s]+">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                        
                            <div class="col-3">
                                <label for="">Imagen</label>
                                <input accept="image/*" name="txtImg" type="file" required type="" class="form-control" placeholder="Inserte la imagen">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                        </div>
                        <div class="row  px-2 py-2">
                            <div class="col-6 mt-4 ">
                                <div class="form-check form-check-inline d-flex flex-wrap gap-4" required type="">
                                    
                                    <?php
                                        while($fila3 = mysqli_fetch_array($res3)){
                                    ?>
                                        <div class="d-flex align-items-center me-3 gap-2">
                                            <input name= "txtEtiqueta[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" >
                                            <label class="form-check-label" for="inlineCheckbox1"><?php echo $fila3['nombre'] ?></label>
                                        </div>           
                                    <?php
                                        }
                                    ?>
                                    <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Autor</label>
                                <select name="txtAutor" class="form-control" required type="">
                                    <option value="" selected>Seleccione al autor</option>
                                    <?php
                                        while($fila2 = mysqli_fetch_array($res4)){
                                    ?>
                                    <option value="<?php echo $fila2['idAutor'] ?>"><?php echo $fila2['nombre'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>    
                        </div>    
                        <div class="hero-unit" style="margin-top:20px">
		                        <h1 class="modal-title fs-5">Contenido</h1>
		                        <textarea required type="" class="somme-textarea" name="txtContenido" placeholder="Enter text ..." style="width: 100%; height: 200px"></textarea>
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>	 
                        <br>
                        <div class="alert alert-danger mt-4 d-none " id="divAlerta"  role="alert">
                            Favor de llenar los campos
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnGuardar1">Guardar</button>
                        
                    </div>
                </form>
                
                  
            </div>
        </div>

    </div>
    <!-- MODAL -->

     <!-- MODAL edit-->
    <div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen p-4">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class=" modal-title fs-5" id="exampleModalLabel" ><h3>Editar Artículo</h3></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <div class="row px-2 py-2">
                            <div class="col-3">
                                <label for="">Tipo de publicación</label>
                                <select class="form-control"required type="" >
                                    <option value="" selected>Seleccione el tipo</option>
                                    <option value="1">Análisis</option>
                                    <option value="2">Noticia</option>
                                    <option value="3">Guía</option>
                                </select>
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Titular</label>
                                <input required type="text" class="form-control" placeholder="Inserta los apellidos" pattern="[A-Za-zÀ-ÿ\s]+">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Documento</label>
                                <input type="file" required type="" class="form-control" placeholder="Inserte el artículo">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Imagen</label>
                                <input type="file" required type="" class="form-control" placeholder="Inserte la imagen">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                        </div>
                        <div class="row  px-2 py-2">
                            
                            <div class="col-4 ">
                                <label for="">Categoría</label>
                                <select class="form-control"required type="">
                                    <option value="" selected>Seleccione la categoría</option>
                                    <option value="1">PC</option>
                                    <option value="2">Móviles</option>
                                    <option value="3">Trucos</option>
                                    <option value="4">Hardware</option>
                                    <option value="5">Esports</option>
                                    <option value="6">Tecnología</option>
                                </select>
                            </div>
                            <div class="col-8 mt-4 ">
                                <div class="form-check form-check-inline " required type="">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" >
                                    <label class="form-check-label" for="inlineCheckbox1">PS5</label>
                                </div>
                                <div class="form-check form-check-inline " required type="">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">GPUs</label>
                                </div>
                                <div class="form-check form-check-inline" required type="">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Mundo Abierto</label>
                                </div>
                                <div class="form-check form-check-inline " required type="">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">VR</label>
                                </div>
                                <div class="form-check form-check-inline " required type="">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Inteligencia Artificial</label>
                                </div>
                                <div class="form-check form-check-inline " required type="">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">RPGs</label>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h1 class="h5">Autor</h1>
                        <div class="row  px-2 py-2">
                            <div class="col-3">
                                <label for="">Autor</label>
                                <select class="form-control" required type="">
                                    <option value="" selected>Seleccione al autor</option>
                                    <option value="1">Carlos Rivera</option>
                                    <option value="2">Sofía Martínez</option>
                                    <option value="3">Miguel López</option>
                                    <option value="4">Laura Sánchez</option>
                                    <option value="5">Ana Fernández</option>
                                    <option value="6">Pablo Gómez</option>
                                </select>
                            </div>
                        
                            <div class="col-6">
                                <label for="">Biografía</label>
                                <input required type="text" class="form-control" placeholder="Biografía" pattern="[A-Za-zÀ-ÿ\s]+">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Redes</label>
                                <select class="form-control" type="email" required type="">
                                    <option value="" selected>Seleccione la cuenta social</option>
                                    <option value="1">@crivera</option>
                                    <option value="2">@smartinez</option>
                                    <option value="3">@miguelgaming</option>
                                    <option value="4">@lauraia</option>
                                    <option value="5">@anafernandez</option>
                                    <option value="6">@pablogomez</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="">Foto</label>
                                <input type="file" class="form-control" placeholder="Inserta la foto del Autor" required type="">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL edit-->

        <!-- MODAL delete-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Desea eliminar este artículo?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#confirmModal">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL delete-->

     <!-- MODAL confirm delete-->
     <div class="modal fade " id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">¿Esta seguro que desea eliminar este artículo?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cambie de opinión</button>
                    <button type="submit" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL confirm delete-->



    

    <script src="lib/js/wysihtml5-0.3.0.js"></script>
<script src="lib/js/jquery-1.7.2.min.js"></script>
<script src="lib/js/prettify.js"></script>
<script src="lib/js/bootstrap.min.js"></script>
<script src="src/bootstrap-wysihtml5.js"></script>


<script type="text/javascript">
    $('#some-textarea').wysihtml5({
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/users.js"></script>


    <?php if (isset($_GET['status'])): ?>
    <script>
        // Obtener el parámetro "status" de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get("status");
        
        // Mostrar alerta según el valor de "status"
        Swal.fire({
            icon: status == 1 ? "success" : "error",
            title: status == 1 ? "¡Listo!" : "Oops...",
            text: status == 1 ? "Se guardó correctamente." : "Algo salió mal.",
        }).then(() => {
            // Eliminar el parámetro "status" de la URL sin recargar la página
            const newUrl = window.location.href.split("?")[0];
            history.replaceState(null, "", newUrl);
        });
    </script>
<?php endif; ?>


</body>
</html>