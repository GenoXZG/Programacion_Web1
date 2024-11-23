<?php 
    require "conexion.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores del formulario
        $username = $_POST['username'];
        $password_form = $_POST['password'];
    }
    // Consulta con los datos del login
    $stm_get_User = "SELECT * FROM usuarios WHERE nombre = ?";
    $get_user = $conexion->prepare($stm_get_User);
    $get_user->bind_param('s', $username);
    
    $get_user->execute();
    $result = $get_user->get_result();
    $usuario = $result->fetch_assoc();
    $password_usuario = $usuario['password'];
  
    if ($password_form == $password_usuario){
        session_start();
        $_SESSION['usuario'] = $username;
        $_SESSION['password'] = $password_form;
        header("Location: index.php"); 
        exit();
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./materialize.min.css">
    <title>Error de Conexion</title>
</head>
<body>
    <div class="container_delete">
        <h1> Acceso no autorizado </h1>
        <div class="add_a">
            <a  href="index.html"> Pagina de inicio </a>
        </div>
        
    </div>
    <footer>
        <div class="footer">
            <div class="rowf">
                <a href="#"><i class="fa fa-github"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>

            <div class="rowf">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Career</a></li>
                </ul>
            </div>

            <div class="rowf">
                GENOX Copyright © 2021 - All rights reserved 
            </div>
        </div>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>



