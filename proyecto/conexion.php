<?php 
    $servername = "localhost:3306";  
    $username = "Genox";
    $password = "123456";
    $dbname = "proyecto";
    
    $conexion = new mysqli($servername, $username, $password, $dbname);
    
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    
?>