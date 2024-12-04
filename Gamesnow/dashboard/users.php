<?php
    include "../admin/php/conexion.php";
    $sql = "select * from Usuarios order by idUsuario DESC";
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
    <link rel="stylesheet" href="../css/stylesBoot.css">
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
                                <button class="btn btn-outline-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                                <button class="btn btn-outline-warning btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editModal">
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
                <form action="" class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <div class="row">   
                            <div class="col-4">
                                <label for="">Nickname</label>
                                <input required type="text" class="form-control" placeholder="Inserta el nickname">
                                <div class="valid-feedback">
                                    Correcto
                                </div>
                                <div class="invalid-feedback">
                                    No válido
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="">Correo electrónico</label>
                                <input required type="text" class="form-control" placeholder="Inserta el correo electrónico" pattern="[A-Za-zÀ-ÿ\s]+">
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
                                <input required type="password" class="form-control" placeholder="Inserta la contraseña">
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
                                <input required type="password" class="form-control" placeholder="Confirma la contraseña">
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
                <form action="" class="needs-validation" novalidate id="form2">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="nickname">Nickname</label>
                                <input required type="text" class="form-control" id="nickname" placeholder="Cambiar el nickname" >
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">No válido</div>
                            </div>
                            <div class="col-4">
                                <label for="email">Correo electrónico</label>
                                <input required type="email" class="form-control" id="email" placeholder="Cambiar el correo electrónico">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">No válido</div>
                            </div>
                            <div class="col-4">
                                <label for="edad">Edad</label>
                                <input required min="18" type="number" class="form-control" id="edad" placeholder="Cambiar la edad">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">No válido</div>
                            </div>
                        </div>
            
                        <!-- Opción para cambiar la contraseña -->
                          <!-- Opción para cambiar la contraseña -->
            <div class="row">
                <div class="col-12">
                    <input type="checkbox" id="changePassword" class="form-check-input">
                    <label for="changePassword" class="form-check-label">Cambiar contraseña</label>
                </div>
            </div>

            <!-- Campos de contraseña que se activan si se marca el checkbox -->
            <div class="row" id="passwordFields" style="display: none;">
                <div class="col-12">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Inserta la nueva contraseña">
                    <div class="valid-feedback">Correcto</div>
                    <div class="invalid-feedback">No válido</div>
                </div>
            </div>

            <div class="row" id="confirmPasswordFields" style="display: none;">
                <div class="col-12">
                    <label for="confirmPassword">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirma la nueva contraseña">
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Desea eliminar este usuario?</h1>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">¿Esta seguro que desea eliminar este usuario?</h1>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/users.js"></script>
</body>
</html>
