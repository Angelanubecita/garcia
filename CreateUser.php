<?php
session_start();

// Verifica si se ha enviado el formulario y si es una solicitud POST
if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    include('conexion/config.php');
    $email = trim($_REQUEST['email']);
    $password = trim($_REQUEST['password']);
    $name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
    
   

    $PasswordHash = password_hash($password, PASSWORD_BCRYPT);

    $SqlVerificandoEmail = "SELECT email FROM users WHERE email COLLATE utf8mb4_bin='$email'";
    $jqueryEmail = mysqli_query($con, $SqlVerificandoEmail);
    if (mysqli_num_rows($jqueryEmail) > 0) {
        // El email ya está registrado
        echo "El correo electrónico ya está registrado";
    } else {
        $queryInsertUser = "INSERT INTO users(email,password, name, rol) VALUES ('$email','$PasswordHash','$name', 'usuario')";
        $resultInsertUser = mysqli_query($con, $queryInsertUser);
        header("location: index.php");
    }
    
}
?>
