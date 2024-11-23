<?php

    require "conexion.php";

    
    session_start();
    // Verifica si el usuario está logeado
    if (!isset($_SESSION['usuario'])) {
        // Si no está logeado, redirige a la página de login
        header("Location: login.php");
        exit();
    }
    
    $id = $_GET['id']; 
    $delete_platillo = "DELETE FROM platillos WHERE id = ?";
    $stm_delete = $conexion->prepare($delete_platillo);
    $stm_delete->bind_param('i',$id);
    $stm_delete->execute();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./materialize.min.css">
    <title> Eliminar Registro </title>
</head>
<body>
        <div class="header">
            <h5>Usuario actual : <span> <?=  $_SESSION['usuario']?> </span>  </h5>
            <a href="logout.php">Cerrar Sesion</a>
        </div>
    <div class="container_delete">
        <h1> El registro se elimino con exito </h1>
        <div class="add_a">
            <a  href="index.php"> Ver registros </a>
        </div>
        
    </div>
    
</body>
</html>