<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamesNow</title>
    
    <link rel="stylesheet" href="./css/stylesRegistro.css">
    <link rel="stylesheet" href="./css/mediaqueryRegistro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="./img/logo.ico">
</head>
<body>
    <div class="background-image"></div>
    <div class="games">
        <div class="logo">
            <a href="./index.php">
                <img src="./img/logo.webp" alt="GamesNow Logo">
            </a>
        </div>

    </div>
    <div class="barra">
        <a href="iniciar.php"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <div class="container">
        <div class="form-container">
            <h2>CREAR CUENTA</h2>
            <p>Únete a la comunidad para estar al tanto de las noticias del <br>mundo gamer</p>
            <form action="./admin/php/add-user1.php"  method="post" class="needs-validation" novalidate id="form">
                <label for="username">Nombre de usuario:</label>
                <div class="register">
                    <input type="text" id="username" name="txtNombre" required class="usuario">       
                </div>

                <div class="row">
            <div class="col-12">
                <label for="txtPassword">Contraseña</label>
                <small id="passwordHelp" class="form-text text-muted">
            Favor de usar mayúsculas, minúsculas y números.
        </small>
                <input required type="password" name="txtPassword" id="password" class="form-control" placeholder="Inserta la contraseña" maxlength="10">
                <i class="fa-solid fa-eye toggle-password user-icon" id="eye-icon" onclick="togglePasswordVisibility('password', 'eye-icon-password')"></i>
                <small id="passwordHelp" class="form-text text-muted">
            Mínimo de 8 caracteres y máximo 10 caracteres.
        </small>
        <div id="password-strength" class="valid-feedback" style="display: none; color: green;">Contraseña segura</div>
        <div id="password-warning" class="invalid-feedback" style="display: none; color: red;">Contraseña insegura</div>
            </div>
        </div>

    

                <label for="confirm-password">Confirmar contraseña:</label>
                <div class="register">
                    <input type="password" id="confirm-password"required class="usuario" name="confirm-password" maxlength="10">
                    <i class="fa-solid fa-eye toggle-password user-icon" id="eye-icon1" onclick="togglePasswordVisibility('confirm-password', 'eye-icon-confirm')"></i>
                  
                </div>

                <label for="email">Correo electrónico:</label>
                <div class="register">
                    <input type="email" id="email" name="txtCorreo" required class="usuario">
                   
                </div>
                

                <label class="checkbox-container">
                    <input type="checkbox" name="terms" required>
                    He leído y acepto la &nbsp; <a href="#"> política de privacidad</a>
                </label>

                <button type="submit" id="btnGuardar">Regístrate en GamesNow</button>
            </form>

            <div class="social-login">
                
                <p>Regístrate con:</p>
                <div class="brands">
                    <a href="https://www.google.com" target="_blank" class="google" aria-label="Iniciar sesión en Google">
                        <i class="fa-brands fa-google brand-icon"></i>
                    </a>
                    <a href="https://www.facebook.com" target="_blank" class="fb" aria-label="Iniciar sesión en Facebook">
                        <i class="fa-brands fa-facebook brand-icon1"></i>
                    </a>
                    <a href="https://www.reddit.com" target="_blank" class="reddit" aria-label="Iniciar sesión en Reddit">
                        <i class="fa-brands fa-reddit-alien brand-icon2"></i>
                    </a>
                    <a href="https://www.x.com" target="_blank" class="x" aria-label="Iniciar sesión en X">
                        <i class="fa-brands fa-x-twitter brand-icon3"></i>
                    </a>
                </div>
                
            </div>

            <p class="footer-text">¿Ya tienes una cuenta? <a href="iniciar.php">Inicia sesión</a></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="./index.php" style="text-align: center;">  ¿Cambiaste de opinión?</a>
        </div>
    </div>
  
    <script src="./js/usuarios1.js"></script>
    <?php
if (isset($_GET['status'])) {
    $message = "";
    $icon = "info"; // Default icon
    
    if ($_GET['status'] == 1) {
        // Insertado correctamente
        $message = "Tu usuario fue creado";
        $icon = "success";
    } else if ($_GET['status'] == 0) {
        // Error al insertar
        $message = "Hubo un error al crear tu usuario";
        $icon = "error";
    }
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mostrar el mensaje con SweetAlert
            Swal.fire({
                icon: '<?php echo $icon; ?>',
                title: "<?php echo $message; ?>",
                confirmButtonText: 'Aceptar'
            }).then(() => {
                // Eliminar el parámetro 'status' de la URL
                const url = new URL(window.location.href);
                url.searchParams.delete('status');
                window.history.replaceState({}, document.title, url);
            });
        });
    </script>
    <?php
}
?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const form = document.getElementById('form');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');

    form.addEventListener('submit', (e) => {
        if (password.value !== confirmPassword.value) {
            e.preventDefault(); // Evita que el formulario se envíe
            
            // Muestra el error con SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden. Por favor, verifica e inténtalo de nuevo.',
                confirmButtonText: 'Aceptar'
            });
        }
    });
</script>

<script>
    document.getElementById("password").addEventListener("input", function () {
        const passwordField = this;
        const maxLength = 10;
        const currentLength = passwordField.value.length;

        // Mostrar alerta si se excede el límite
        if (currentLength > maxLength) {
            alert("La contraseña no puede tener más de " + maxLength + " caracteres.");
            passwordField.value = passwordField.value.slice(0, maxLength); // Recorta el texto excedente
        }

        // Verificación de seguridad de la contraseña
        const password = passwordField.value;
        const strengthIndicator = document.getElementById("password-strength");
        const warningIndicator = document.getElementById("password-warning");

        // Verifica si la contraseña tiene al menos 8 caracteres y contiene letras mayúsculas, minúsculas y números
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const isValidLength = password.length >= 8;

        // Determinar si la contraseña es segura
        if (isValidLength && hasUpperCase && hasLowerCase && hasNumbers) {
            strengthIndicator.style.display = 'block'; // Mostrar mensaje de seguridad
            warningIndicator.style.display = 'none'; // Ocultar mensaje de inseguridad
            strengthIndicator.textContent = 'Contraseña segura';
            strengthIndicator.classList.remove("invalid-feedback");
            strengthIndicator.classList.add("valid-feedback");
        } else {
            strengthIndicator.style.display = 'none'; // Ocultar mensaje de seguridad
            warningIndicator.style.display = 'block'; // Mostrar mensaje de inseguridad
            warningIndicator.textContent = 'Contraseña insegura';
            warningIndicator.classList.remove("valid-feedback");
            warningIndicator.classList.add("invalid-feedback");
        }
    });
</script>
<script>
    function togglePasswordVisibility(fieldId, iconId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(iconId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>