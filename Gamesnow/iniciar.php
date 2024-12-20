<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamesNow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/stylesInicio.css">
    <link rel="stylesheet" href="./css/mediaqueryInicio.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" as="style" onload="this.rel='stylesheet'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
        
    </noscript>   
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    
    <link rel="icon" href="./img/logo.ico">
</head>
<body>
    <div class="background-image"></div>
    <div class="barra">
        <a href="index.html"><i class="fa-solid fa-arrow-left"></i></a>
        
    </div>
    <div class="container">
        
        <div class="login">
            <h2>INICIAR SESIÓN</h2>
            <form action="./admin/php/login.php" method="post">
            <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php'; ?>">
    <div class="register">
        <input type="text" name="txtUser" placeholder="Nombre de usuario" required class="usuario">
        <i class="fa-regular fa-user user-icon"></i>
    </div>
    <div class="register" >
        <input style="background-color:white;" type="password" name="txtPassword" id="password" placeholder="Contraseña" required class="usuario">
        <i class="fa-solid fa-eye toggle-password user-icon" id="eye-icon" onclick="togglePasswordVisibility()"></i>
    </div>
    <button type="submit">Ingresar</button>
</form>

            
            <div class="o">
                <div class="barra1"></div> O <div class="barra2"></div>
            </div>
            <div class="social">
                <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&ved=2ahUKEwjLtKLk5oiJAxVmJ0QIHePbGnUQFnoECBcQAQ&url=https%3A%2F%2Faccounts.google.com%2F&usg=AOvVaw33vbO0yD5ue-bN0tdaehNC&opi=89978449" target="_blank" class="google" alt="Iniciar Google"><i class="fa-brands fa-google brand-icon"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iniciar sesión con Google</i></a>
                <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjNh-D05oiJAxXnJUQIHX_yFucQFnoECAgQAQ&url=https%3A%2F%2Fes-la.facebook.com%2Flogin%2Fdevice-based%2Fregular%2Flogin%2F&usg=AOvVaw0lJpkavDe_tmvEx5NB2NC1&opi=89978449" target="_blank" class="facebook" alt="Iniciar Facebook"><i class="fa-brands fa-facebook brand-icon1"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iniciar sesión con Facebook</i></a>
                <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjEq_b65oiJAxUWEUQIHdSXMlQQFnoECAkQAQ&url=https%3A%2F%2Fwww.reddit.com%2Flogin%2F&usg=AOvVaw2wPUCTymtCyGo_b3x6ANL_&opi=89978449" target="_blank" class="reddit" alt="Iniciar Reddit"><i class="fa-brands fa-reddit-alien brand-icon2"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iniciar sesión con Reddit</i></a>
                <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiBjPSA54iJAxU0l-4BHbiQPGAQFnoECAoQAQ&url=https%3A%2F%2Ftwitter.com%2Flogin&usg=AOvVaw3swNPrVfKaBGiX8TGfSpkN&opi=89978449" target="_blank" class="twitter" alt="Iniciar X"><i class="fa-brands fa-x-twitter brand-icon3"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iniciar sesión con X</i></a>
            </div>
            <div class="links">
                <a href="#">¿Olvidaste tu contraseña?</a>
                <p>¿Aún no tienes una cuenta? <a href="registro.php"> <span>Regístrate gratis</span></a></p>
                <a href="./index.php">¿Cambiaste de opinión?</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Mostrar la alerta solo si está el parámetro 'error'
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error')) {
        Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "DATOS NO VÁLIDOS",
        }).then(() => {
            // Eliminar el parámetro 'error' de la URL
            const newUrl = window.location.href.split('?')[0];
            history.replaceState(null, '', newUrl);
        });
    }
</script>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

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
<script>
    // Captura la URL de la página anterior
    document.getElementById("redirect-url").value = document.referrer;
</script>

</body>
</html>