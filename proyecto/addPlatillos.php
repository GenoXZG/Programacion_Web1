<?php
    session_start();
    require "conexion.php";
    mysqli_set_charset($conexion,'utf8');

    if (!isset($_SESSION['usuario'])) {
        // Si no está logeado, redirige a la página de login
        header("Location: login.php");
        exit();
    }

    $nombre_platillo = $_POST['nombre_platillo'];
    $descripcion_platillo = $_POST['descripcion_platillo'] ;
    $precio_platillo = $_POST['precio_platillo'] ;
    $categoria_platillo = $_POST['categoria_platillo'] ;
    $disponibilidad_platillo = $_POST['disponibilidad_platillo'];

    $insert_platillo = "INSERT INTO platillos(nombre,descripcion,precio,categoria,disponible) values(?,?,?,?,?)";

    $stm_insert = $conexion->prepare($insert_platillo);
    $stm_insert->bind_param("ssdsi",$nombre_platillo,$descripcion_platillo,$precio_platillo,$categoria_platillo,$disponibilidad_platillo);
    $stm_insert->execute();
    $result_insert = $stm_insert->get_result();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Platillo</title>
    </head>
    <body>

        <h1>Bienvenido: <?=  $_SESSION['usuario']?> </h1>

        <h1> El platillo se agrego con exito </h1>
        <a href="index.php"> Ver Registros</a>
    </body>
</html>

