<?php
    require "conexion.php";
    mysqli_set_charset($conexion,'utf8');

    session_start();
    // Verifica si el usuario está logeado
    if (!isset($_SESSION['usuario'])) {
        // Si no está logeado, redirige a la página de login
        header("Location: login.php");
        exit();
    }

    $get_usuarios = "SELECT * FROM usuarios";
    $result_getUser = $conexion->query($get_usuarios);
     

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./materialize.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Usuarios</title>
</head>
<body>

    <div class="header">
        <h5>Usuario actual : <span> <?=  $_SESSION['usuario']?> </span>  </h5>
        <a href="logout.php">Cerrar Sesion</a>
    </div>
     
     <table class="tabla centered" border = '2' >
            <tr>
                <th> ID </th>
                <th> Nombre </th>
                <th> Email </th>
                <th> Contraseña </th>
            </tr>
            <?php
                    while( $usuario = mysqli_fetch_assoc($result_getUser)){ ?>
                    <tr>
                        <td> <?= $usuario['id'] ?> </td>
                        <td> <?= $usuario['nombre'] ?> </td>
                        <td> <?= $usuario['email'] ?> </td>
                        <td> <?= $usuario['password'] ?> </td>
                        <td><a onclick="recargar_delay(1100);ejecutarAccion(event, 'deleteUsuario.php?id=<?=$usuario['id']?>')" href="#"><i class="material-icons delete btn-floating pulse ">delete</i></a></td>
                    </tr>    
                <?php } ?>   
        </table>
        <div class="opciones">
            <a href="index.php"> Ver registros </a>
        </div>
    <footer>
        <div class="footer">
            <div class="rowf">
                <a href="https://github.com/GenoXZG"><i class="fa fa-github"></i></a>
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
    <script type="text/javascript" src="Js/materialize.min.js"></script>
    <script>
            function recargar_delay(delay) {
            
            setTimeout(() => {
                location.reload();
            }, delay); // `delay` es el tiempo en milisegundos
        }
        function ejecutarAccion(event, url) {
        // Prevenir la redirección predeterminada del enlace
        event.preventDefault();
            
        // Enviar la solicitud al archivo PHP sin redirección
        fetch(url)
            .then(response => {
                if (response.ok) {
                    M.toast({html: 'Usuario eliminado con exito', displayLength: 1000}); 
                } else {
                    M.toast({html: 'Error al eliminar el usuario', displayLength: 1000});
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error al intentar eliminar el usuario.");
            });
        }   
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>