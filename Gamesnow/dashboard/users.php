<?php
    include "../admin/php/conexion.php";
    $sql = "SELECT * FROM Usuarios 
                   WHERE idUsuario NOT IN (SELECT idUsuario FROM Autores)
                   ORDER BY idUsuario DESC";
    $res = $conexion -> query($sql) or die($conexion->error);
    $sql4 = "select * from Multimedia order by idMult DESC";
    $res4 = $conexion -> query($sql) or die($conexion->error);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/stylesBoot.css">
    <link rel="icon" href="../img/logo.ico">
</head>
<body class="row d-flex" style="height: 100%;">
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
            
            <!-- TITTLE SECTION -->
            <div class="d-flex justify-content-between">
                <h4>Usuarios</h4>
                <button class="btn btn-dark m-3" data-bs-toggle="modal" data-bs-target="#exampleModal"> 
                    <i class="bi bi-plus"></i> 
                    Agregar
                </button>
            </div>
            <!-- TITTLE SECTION -->

            <!-- DATA -->
             <div class="row p-4">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th scope="col">ID de Usuario</th>
                            <th scope="col">Nickname</th>
                            <th scope="col">Correo electrónico</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($fila = mysqli_fetch_array($res)){
                            ?>
                          <tr>
                            <th scope="row"><?php echo $fila['idUsuario'] ?></th>
                            <td><?php echo $fila['nombre'] ?></td>
                            <td><?php echo $fila['correo'] ?></td>
                            <td>
                                <button data-id="<?php echo $fila['idUsuario'] ?>" class="btnDelete btn btn-outline-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i data-id="<?php echo $fila['idUsuario'] ?>" class="bi bi-trash3-fill"></i>
                                </button>
                                <button
                                data-nombre="<?php echo $fila['nombre']; ?>" 
                                data-correo='<?php echo $fila['correo'];?>'
                                data-id="<?php echo $fila['idUsuario']; ?>"
                                class="btnEditar btn btn-outline-warning btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                            </td>
                            
                          </tr>
                          <?php
                            }
                          ?>
                          
                        </tbody>
                </table>
             </div>
            <!-- DATA -->
        </section>
     </main>
    <!-- END MAIN CONTENT --> 

    <!-- MODAL -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../admin/php/add-users.php"  method="post" class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <div class="row">   
                            <div class="col-4">
                                <label for="">Nickname</label>
                                <input name="txtNombre" required type="text" class="form-control" placeholder="Inserta el nickname">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="">Correo electrónico</label>
                                <input name="txtCorreo" required type="text" class="form-control" placeholder="Inserta el correo electrónico">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-12">
                                <label for="">Contraseña</label>
                                <input name="txtPassword" required type="password" class="form-control" placeholder="Inserta la contraseña">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Confirmar contraseña</label>
                                <input name="txtConfirmPassword" required type="password" class="form-control" placeholder="Confirma la contraseña">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger mt-4 d-none" id="divAlerta"  role="alert">
                            Favor de llenar los campos
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
    <!-- MODAL -->

     <!-- MODAL edit-->
    <div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../admin/php/update-usuario.php" method="post" class="needs-validation" novalidate id="form2">
                    <div class="modal-body">
                    <input type="hidden" name="id" id="txtIdEdit"/>
                        <div class="row">
                            <div class="col-4">
                                <label for="nickname">Nickname</label>
                                <input id="txtNombreEdit" name="txtNombre" required type="text" class="form-control" id="nickname" placeholder="Cambiar el nickname" >
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">No válido</div>
                            </div>
                            <div class="col-4">
                                <label for="email">Correo electrónico</label>
                                <input id="txtCorreoEdit" name="txtCorreo" required type="email" class="form-control" id="email" placeholder="Cambiar el correo electrónico">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">No válido</div>
                            </div>
                            
                        </div>
        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar cambios</button>
                        <div class="alert alert-danger mt-4 d-none" id="divAlerta"  role="alert">
                            Favor de llenar los campos
                        </div>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Desea eliminar este moderador?</h1>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">¿Esta seguro que desea eliminar este moderador?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cambie de opinión</button>
                    <button type="submit" class="btn btn-primary btnEliminar"  data-bs-toggle="modal" data-bs-target="" id="eliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL confirm delete-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script src="./js/usuarios.js"></script>
    <?php
if (isset($_GET['status'])) {
    $message = "";
    if ($_GET['status'] == 1) {
        // insertado correctamente
        $message = "Usuario agregado correctamente";
    } else if ($_GET['status'] == 2) {
        // actualizado correctamente
        $message = "Usuario actualizado correctamente";
    } else if ($_GET['status'] == 3) {
        // eliminado correctamente
        $message = "Usuario eliminado correctamente";
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
                    window.location.href = './users.php'; // Redirigir después de cerrar el modal
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
                window.location.href = './users.php'; // Redirigir después de cerrar el modal
            });
        });
    </script>
    <?php
}
?>

</body>
</html>
