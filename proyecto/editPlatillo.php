<?php
    require "conexion.php";
    session_start();

    if (!isset($_SESSION['usuario'])) {
        // Si no está logeado, redirige a la página de login
        header("Location: login.php");
        exit();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nuevoNombre = $_POST['nombre_platillo'];
        $nuevoPrecio = $_POST['precio_platillo'];
        $nuevoDescripcion = $_POST['descripcion_platillo'];
        $nuevoCategoria = $_POST['categoria_platillo'];
        $nuevoDisponibilidad = $_POST['disponibilidad_platillo'];

        $update_reg = "UPDATE platillos SET nombre = ?, precio = ?, descripcion = ?, categoria = ?, disponible = ? WHERE id = ?";
        $stm_update = $conexion->prepare($update_reg);
        $stm_update->bind_param("sdssii", $nuevoNombre, $nuevoPrecio, $nuevoDescripcion, $nuevoCategoria, $nuevoDisponibilidad, $_GET['id'] );

        $stm_update->execute();
       
    }
    // Obtencion de datos
    $get_reg = "SELECT * FROM platillos WHERE id = ?";
    $stm_get = $conexion ->prepare($get_reg);
    $stm_get->bind_param('i',$_GET['id']);
    $stm_get->execute();
    $result_get = mysqli_fetch_assoc($stm_get->get_result()) ;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./materialize.min.css">
    <title >Editar Platillo </title>
</head>
<body>
        <div class="header">
            <h5>Usuario actual : <span> <?=  $_SESSION['usuario']?> </span>  </h5>
            <a href="logout.php">Cerrar Sesion</a>
        </div>
        <h2>Editar Registro</h2>
        <section class="container_edit">
            <div class="row">
                <form class="col s12"  method="POST">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">edit</i>
                            <input type="text" id="nombre_platillo" name="nombre_platillo" value="<?= $result_get['nombre'] ?> " required>
                            <label for="nombre_platillo"> Nombre del platillo </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">edit</i>
                            <textarea class="materialize-textarea" name="descripcion_platillo" id="descripcion_platillo" required></textarea>
                            <label for="descripcion_platillo"> Descripcion del platillo</label>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">attach_money</i>
                            <input value="<?= $result_get['precio'] ?>" type="number" step="0.01" id="precio_platillo" name="precio_platillo" required>
                            <label for="">Precio del platillo</label>
                        </div>
                    </div>
                        <label class="add_label" for="categoria_platillo"> Categoria del platillo</label>
                        <select class="browser-default" name="categoria_platillo" id="categoria_platillo " required>
                            <option value="" disabled selected >Selecciona una categoría</option>
                            <option value="Mexicana"> Mexicana </option>
                            <option value="Rapida"> Rapida </option>
                            <option value="Bebida"> Bebida </option>
                        </select>
                        
                        <label class="add_label" for="disponibilidad_platillo"> Disponibilidad del platillo</label>
                        <select class="browser-default  " name="disponibilidad_platillo" id="disponibilidad_platillo" required>
                            <option value="" disabled selected > Selecciona una disponibilidad </option>
                            <option value="TRUE"> Disponible </option>
                            <option value="FALSE"> No disponible </option>
                        </select>
                    <button class="btn" type="submit"> Actualizar Platillo </button>
                </form>  
                <div class="add_a">
                    <a href="index.php"> Ver Registros</a>  
                </div>  
            </div>
        </section>
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
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script type="text/javascript" src="Js/materialize.min.js"></script>
</body>
</html>