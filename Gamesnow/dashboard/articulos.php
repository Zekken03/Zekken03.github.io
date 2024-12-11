<?php
    include "../admin/php/conexion.php";
    $sql = "select * from tipo order by idTipo DESC";
    $res = $conexion -> query($sql) or die($conexion->error);
    $sql1 = "SELECT u.*, a.biografia, a.redes
        FROM usuarios u
        JOIN autores a ON u.idUsuario = a.idUsuario
        ORDER BY u.idUsuario DESC;";
    $res1 = $conexion -> query($sql1) or die($conexion->error);
    $sql2 = "SELECT p.idPubli, p.titulo, u.nombre, p.contenido, p.idAutor 
        FROM publi p
        INNER JOIN usuarios u ON p.idAutor = u.idUsuario
        ORDER BY p.idPubli DESC";
    $res2 = $conexion -> query($sql2) or die($conexion->error);
    $sql3 = "select * from etiquetas order by idEtiqueta DESC";
    $res3 = $conexion -> query($sql3) or die($conexion->error);
    $sql4 = "select u.*, a.* from autores a JOIN  usuarios u on u.idUsuario = a.idUsuario order by a.idAutor desc";
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
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
        // Consulta para obtener las publicaciones
        $resPubli = mysqli_query($conexion, "
      SELECT p.idPubli, p.titulo, p.contenido, p.fechaPubli, 
       p.idAutor, p.idTipo, 
       t.tipo, 
       COALESCE(m.url, 'No disponible') AS url
FROM publi p
LEFT JOIN tipo t ON p.idTipo = t.idTipo
LEFT JOIN multimedia m ON p.idMult = m.idMult
ORDER BY p.idPubli;

        ") or die($conexion->error);

        // Consulta para obtener los datos de los autores y usuarios
        $resAutores = mysqli_query($conexion, "
        SELECT u.nombre, a.biografia, a.redes, a.idAutor 
        FROM usuarios u 
        JOIN autores a ON u.idUsuario = a.idUsuario
        ORDER BY a.idAutor DESC;
        ") or die($conexion->error);

        // Guardamos los autores en un array para fácil acceso
        $autores = [];
        while ($filaAutor = mysqli_fetch_array($resAutores)) {
            $autores[$filaAutor['idAutor']] = [
                'nombre' => $filaAutor['nombre'],
                'biografia' => $filaAutor['biografia'],
                'redes' => $filaAutor['redes']
            ];
        }

        // Iteramos sobre las publicaciones y mostramos los datos
        while ($filaPubli = mysqli_fetch_array($resPubli)) {
            // Obtenemos el idAutor de la publicación
            $idAutor = $filaPubli['idAutor'];

            // Comprobamos si el autor existe en el array
            $nombreAutor = isset($autores[$idAutor]) ? $autores[$idAutor]['nombre'] : 'Desconocido';
            $biografia = isset($autores[$idAutor]) ? $autores[$idAutor]['biografia'] : 'No disponible';
            $redes = isset($autores[$idAutor]) ? $autores[$idAutor]['redes'] : 'No disponible';
    ?>
        <div class="col-3 p-0 my-2 px-2">
            <div class="card">
                <img src="../img/articulosImg/<?php echo $filaPubli['url'] ?>" class="card-img-top" alt="..." style="height: 200px;">
                <div class="card-body" style="height: 260px;">
                    <h5 class="card-title"><?php echo $filaPubli['titulo'] ?></h5>
                    <p class="card-text"><?php echo $nombreAutor ?></p> <!-- Aquí se muestra el nombre -->
                    <a href="ver-articulo.php?id=<?php echo $filaPubli['idPubli']; ?>" class="btn btn-primary btn-dark">Ver</a>
                    <button data-id="<?php echo $filaPubli['idPubli'] ?>" class="btnDelete btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i  class="bi bi-trash3-fill"></i>
                    </button>
                    <button 
    data-titulo="<?php echo htmlspecialchars($filaPubli['titulo'], ENT_QUOTES, 'UTF-8'); ?>" 
    data-contenido='<?php echo htmlspecialchars($filaPubli['contenido'], ENT_QUOTES, 'UTF-8'); ?>'


   
    data-autor="<?php echo htmlspecialchars($nombreAutor, ENT_QUOTES, 'UTF-8'); ?>" 
    data-etiqueta="<?php echo htmlspecialchars($filaPubli['contenido'], ENT_QUOTES, 'UTF-8'); ?>" 
    data-id="<?php echo $filaPubli['idPubli']; ?>"
    data-tipo-id="<?php echo $filaPubli['idTipo']; ?>" 
    data-tipo-nombre="<?php echo htmlspecialchars($filaPubli['tipo'], ENT_QUOTES, 'UTF-8'); ?>" 
    class="btnEditar btn btn-warning btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editModal">
    <i class="bi bi-pencil-fill"></i>
</button>

                </div>
            </div>
        </div>
    <?php
        }
    ?>
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
                    <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
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
                                <input name="txtTitulo" required type="text" class="form-control" placeholder="Inserta el título">
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
    <textarea required type="" class="somme-textarea summernote" name="txtContenido" placeholder="Enter text ..." style="width: 100%; height: 500px;"></textarea>
    <div class="valid-feedback">
        Correcto
    </div>
    <div class="invalid-feedback">
        No válido
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
    <!-- MODAL -->

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
                        <button type="submit" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#confirmModal" >Eliminar</button>
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
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cambie de opinión</button>
                    <button type="submit" class="btn btn-primary btnEliminar "  data-bs-toggle="modal" data-bs-target=""id="eliminar1">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL confirm delete-->

     <!-- MODAL edit-->
    <div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen p-4">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class=" modal-title fs-5" id="exampleModalLabel" ><h3>Editar Artículo</h3></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../admin/php/update-articulo.php" method="post" class="needs-validation" novalidate id="form">
                    <div class="modal-body"style="max-height: 80vh; overflow-y: auto;">
                        <input type="hidden" name="id" id="txtIdEdit"/>
                        <div class="row px-2 py-2">
                        <div class="col-3">
    <label for="">Tipo de publicación</label>
    <select id="txtTipoEdit" name="txtTipo" class="form-control" required>
        <option value="" disabled>Seleccione el tipo</option>
        <?php
        // Consulta para obtener los tipos
        $sqlTipos = "SELECT idTipo, nombre FROM tipo";
        $resultado = mysqli_query($conexion, $sqlTipos);

        // Obtener el tipo actual de la publicación
        $tipoActual = $filaPubli['idTipo']; // Asumiendo que idTipo está en la consulta principal

        while ($fila = mysqli_fetch_assoc($resultado)) {
            // Marcar el tipo actual como seleccionado
            $selected = ($fila['idTipo'] == $tipoActual) ? "selected" : "";
            echo "<option value='" . $fila['idTipo'] . "' $selected>" . $fila['nombre'] . "</option>";
        }
        ?>
    </select>
    <div class="valid-feedback">Correcto</div>
    <div class="invalid-feedback">No válido</div>
</div>
<div class="col-6">
    <label for="">Titular</label>
    <input id="txtTituloEdit" name="txtTitulo" class="form-control" placeholder="Inserta el titular" pattern="[\w\sÀ-ÿ,.;!?-]+" 
        placeholder="Inserta el titular" >
    <div class="valid-feedback">
        Correcto
    </div>
    <div class="invalid-feedback">
        No válido
    </div>
</div>
                           
                            <div class="hero-unit" style="margin-top:10px">
		                        <h1 class="modal-title fs-5">Contenido</h1>
		                        <textarea id="txtContenidoEdit" name="txtContenido" required type="" class="somme-textarea summernote"  placeholder="Enter text ..." style="width: 100%; height: 200px"></textarea>
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>	 
                            <div class="col-3">
    <label for="">Autor</label>
    <select id="txtAutorEdit" name="txtAutor" class="form-control" required>
        <option value="" selected>Seleccione el autor</option>
        <?php
        $sqlAutores = "SELECT u.nombre FROM usuarios u INNER JOIN autores a ON u.idUsuario = a.idUsuario";
        $resultado = mysqli_query($conexion, $sqlAutores);
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
        }
        ?>
    </select>
    <div class="valid-feedback">Correcto</div>
    <div class="invalid-feedback">No válido</div>
</div>

                            
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

     

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="lib/js/jquery-1.7.2.min.js"></script>
<script src="lib/js/prettify.js"></script>
<script src="lib/js/bootstrap.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/articulos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".summernote").summernote();
        $('.dropdown-toggle').dropdown();
    });
</script>


    <?php
if (isset($_GET['status'])) {
    $message = "";
    if ($_GET['status'] == 1) {
        // insertado correctamente
        $message = "Artículo agregado correctamente";
    } else if ($_GET['status'] == 2) {
        // actualizado correctamente
        $message = "Artículo actualizado correctamente";
    } else if ($_GET['status'] == 3) {
        // eliminado correctamente
        $message = "Artículo eliminado correctamente";
    } else if ($_GET['status'] == 0) {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {   
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Favor de completar los datos correctamente",
                    confirmButtonText: "Aceptar"
                }).then(function () {
                    window.location.href = './articulos.php'; // Redirigir después de cerrar el modal
                });
            });
        </script>
        <?php
        exit; // Asegúrate de que no se ejecuten los scripts siguientes
    }
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: "<?php echo $message ?>",
                confirmButtonText: 'Aceptar'
            }).then(function () {
                window.location.href = './articulos.php'; // Redirigir después de cerrar el modal
            });
        });
    </script>
    <?php
}
?>

</body>
</html>