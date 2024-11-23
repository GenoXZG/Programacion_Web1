<?php
    require "conexion.php";
    session_start();
    // Verifica si el usuario está logeado
    if (!isset($_SESSION['usuario'])) {
        // Si no está logeado, redirige a la página de login
        header("Location: login.php");
        exit();
    }

    $deleteUsuario = "DELETE FROM usuarios WHERE id = ?";
    $stm_deleteUsuario = $conexion->prepare($deleteUsuario);
    $stm_deleteUsuario->bind_param('i',$_GET['id']);
    $stm_deleteUsuario->execute();

   
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
    <title>Eliminar Usuario</title>
</head>
<body>
    <div class="container_delete">
        <h1> El registro se elimino con exito </h1>
        <div class="add_a">
            <a  href="usuarios.php"> Ver usuarios </a>
        </div>
        
    </div>
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
                GENOX Copyright © 2024 - All rights reserved 
            </div>
        </div>
        </footer>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script type="text/javascript" src="Js/materialize.min.js"></script>
</body>
</html>