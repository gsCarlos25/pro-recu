<?php

include_once '../conexion/conexion.php';
require_once '../config/parameters.php';
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

$consulta = "SELECT * FROM deporte";
$resDep = $conn->query($consulta);

?>

    

    


<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="../styles/index.css" type="text/css"></link>
    <link rel="stylesheet" href="../styles/cabecera.css" type="text/css"></link>
    <link rel="stylesheet" href="../styles/buscar.css" type="text/css"></link>
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />

    <title>Document</title>
</head>
<body>
    <?php
        
        include_once "./cabecera.php";
    ?>
    <h1>Busca eventos filtrador por el deporte</h1>
    <form id="form-buscar" method="post" action="../funciones/buscarEvento.php">
        <div>
            <select name="deporte" id="deporte">
                <option value=0>Selecciona un deporte</option>
                <?php while($row = mysqli_fetch_array($resDep)): ?>
                <option value=<?= $row['id'] ?>><?=$row['nombre']?></option>
                <?php endwhile; ?>
            </select>
        </div>
            <input type="submit" class="submit" value="Buscar">
    </form>
    
</body>
</html>
