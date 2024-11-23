<?php
    require "conexion.php";
    mysqli_set_charset($conexion,'utf8');

    $new_user = $_POST['new_user'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];

    if($new_password == $new_password_confirm){
        $insert_user = "INSERT INTO usuarios(nombre,email,password) values(?,?,?)";
        $stm_insert = $conexion->prepare($insert_user);
        $stm_insert->bind_param("sss", $new_user, $new_email, $new_password);
        $stm_insert->execute();
        mysqli_close($conexion);
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
    <title> Agregar usuario </title>
</head>
<body>
    <?php 

        if ($new_password == $new_password_confirm) { ?>
    
            <h1> Usuario registrado correctamente </h1>
            <a href="index.html"> Acceder </a>
        <?php } else { ?>
            
            <h1> Error de validacion: </h1>
            <p> Las contraseñas ingresadas no coinciden </p>

        <?php } ?>
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