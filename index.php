<?php

include_once('./assets/conexion/conexion.php');
require_once('./assets/config/parameters.php');
session_start();

if(!isset($_SESSION['id'])){
    header("Location: assets/views/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/index.js"></script>
    <link rel="stylesheet" href="assets/styles/cabecera.css" type="text/css">
    <link rel="stylesheet" href="assets/styles/evento.css" type="text/css">
    <link rel="stylesheet" href="assets/styles/index.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="assets/favicon/icono.ico" />

</head>
<body>
    <?php
    require_once('./assets/views/cabecera.php');
    ?>

    <!-----------------Cabecera-------------------->

    

    <?php
            $sql = "SELECT * FROM evento where id_usuario=".$_SESSION['id'];
            $resultado = $conn->query($sql);
            
    ?>

<div class="padres">
<h1>Tus eventos</h1>
            <div id="padreEventos">
                
            <?php
            if(mysqli_num_rows($resultado) > 0){
                while($fila = $resultado->fetch_assoc()){
                    $sql2 = "SELECT * FROM deporte WHERE id=".$fila['deporte'];
                    $imagen = $conn->query($sql2)->fetch_assoc()['imagen'];
            ?>
                    <div class="evento">
                    <img src="assets/img/<?=$imagen?>">
                    <div class="infoEvento">
                    <a href="./assets/views/mostrar-evento.php?id=<?=$fila['id']?>"><p class="nomEv"><?=$fila['titulo']?></p></a>
                    <p><?=$fila['fecha']?></p>
                    </div>
                    </div>
                <?php
                }
            }else{
            ?>
                <h2>No has creado ningún evento<a href="assets/views/crear-evento.php"> pulsa aquí para crear uno nuevo</a></h2>
            <?php

            }
                ?>
            </div>
        </div>
            <hr>
        
        <div class="padres">
        <h1>Eventos apuntado</h1>
            <div id="padreEventos2">
                
            <?php

            $sqlApuntado = "SELECT * FROM usuario_apuntado WHERE id_usuario=".$_SESSION['id'];
            $resultado2 = $conn->query($sqlApuntado);

            if(mysqli_num_rows($resultado2) > 0){
                while($fila = $resultado2->fetch_assoc()){

                    $sqlEventoApuntado = "SELECT * FROM evento WHERE id=".$fila['id_evento'];
                    $resApuntado = $conn->query($sqlEventoApuntado);

                    while($fila2 = $resApuntado->fetch_assoc()){
                        $sql2 = "SELECT * FROM deporte WHERE id=".$fila2['deporte'];
                        $imagen = $conn->query($sql2)->fetch_assoc()['imagen'];
                        ?>
                    <div class="evento">
                        <img src="assets/img/<?=$imagen?>">
                        <div class="infoEvento">
                        <a href="./assets/views/mostrar-evento.php?id=<?=$fila2['id']?>"><p class="nomEv"><?=$fila2['titulo']?></p></a>
                        <p><?=$fila2['fecha']?></p>
                        </div>
                    </div>
                <?php
                    }
                }
            }else{
            ?>
                <h2>No estás apuntado a ninún evento <a href="assets/views/buscar-evento.php"> pulsa aquí para buscar uno</a></h2>
            <?php

            }
                ?>
            </div>
        </div>
    

</body>
</html>