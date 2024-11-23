<?php 
    session_start();
    require "conexion.php";
    mysqli_set_charset($conexion,'utf8');

    // Verifica si el usuario está logeado
    if (!isset($_SESSION['usuario'])) {
    // Si no está logeado, redirige a la página de login
    header("Location: login.php");
    exit();
    }

    $select = "SELECT * FROM platillos";
    $res_select = $conexion->query($select);

    $count = mysqli_num_rows($res_select); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="./materialize.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="header">
            <h5>Usuario actual : <span> <?=  $_SESSION['usuario']?> </span>  </h5>
            <a href="logout.php">Cerrar Sesion</a>
        </div>
        <h2> Registro de los platillos </h2>
        <div class="container_tabla">
            <table class="centered tabla"  border = '2' >
                <tr>
                    <th> ID </th>
                    <th> Nombre </th>
                    <th> Descripcion </th>
                    <th> Precio </th>
                    <th> Categoria </th>
                    <th> Disponibilidad </th>

                </tr>
                <?php
                    if ($count > 0){ 
                        while( $row = mysqli_fetch_assoc($res_select)){ ?>
                        <tr>
                            <td> <?= $row['id'] ?> </td>
                            <td> <?= $row['nombre'] ?> </td>
                            <td> <?= $row['descripcion'] ?> </td>
                            <td> <?= $row['precio'] ?> </td>
                            <td> <?= $row['categoria'] ?> </td>
                            <td> <?= $row['disponible'] ?> </td>
                            <td><a  href="editPlatillo.php?id=<?=$row['id']?>"><i class="material-icons btn-floating pulse edit">edit</i></a></td>
                            <td><a onclick="recargar_delay(1100);ejecutarAccion(event, 'deletePlatillo.php?id=<?= $row['id'] ?>')" href="#"> <i class="material-icons btn-floating pulse delete ">delete</i></a></td>
                        </tr>    
                    <?php }     
                    }
                ?> 
            </table>
        </div>
        <div class="opciones">
            <a href="register/addPlatillo.html">Agregar Platillo</a>
            <a href="usuarios.php">Gestionar Usuarios</a>
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
        

    </main>
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
                    M.toast({html: 'Registro eliminado con exito', displayLength: 1000}); 
                } else {
                    M.toast({html: 'Error al eliminar el registro', displayLength: 1000});
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error al intentar eliminar el registro.");
            });
        }   
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>