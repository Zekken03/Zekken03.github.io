<?php session_start();
    include "./conexion.php";
    //CACHAR DATOS
    $user = mysqli_real_escape_string($conexion, $_POST['txtUser']);
    $password = mysqli_real_escape_string($conexion, $_POST['txtPassword']);
    

    echo "Bienvenido: $user tu password es: $password";
    $sql = "SELECT * FROM Usuarios WHERE nombre = '$user' and password = '$password';";
    $res = $conexion -> query($sql) or die($conexion->error);
    if(mysqli_num_rows($res) > 0){
        echo "LOGIN CORRECTO";
        $fila = mysqli_fetch_row($res);//trae la primera fila
        $name = $fila[1];
        $email = $fila[2];
        $id = $fila[0];
        //$img = $fila[4];
        echo "Hola $name tu ID es: $id ";
        $_SESSION['user_data']=[
            'id'=>$id, 
            'nombre'=>$name,
            'correo'=>$email,
            //'img'=>$img CONSULTA PROFE
        ];
        header('Location: ../../dashboard/admin.php');
    }else{
        echo "DATOS NO VALIDOS";
        header("Location: ../../iniciar.php?error=1");//redireccionar
        echo "Consulta SQL: $sql <br>";
    }
?>
