<?php
    session_start();
    include_once("../conexion/conexion.php");

    $consulta = "SELECT * FROM deporte";
    $resDep = $conn->query($consulta);

    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    };
    
    require_once '../config/parameters.php';
    require_once './cabecera.php';

    $sql = "SELECT * FROM evento";
    $res = $conn->query($sql);

    ?>

<!DOCTYPE html>
<html>
<head>
  <title>Usuarios</title>
  <link rel="stylesheet" href="../styles/index.css" type="text/css"></link>
    <link rel="stylesheet" href="../styles/cabecera.css">
    <link rel="stylesheet" href="../styles/usuarios.css">
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="containerr">
    <h1>Usuarios</h1>
    <?php

    while($row = mysqli_fetch_array($res)):
    
        $sql2 = "SELECT * FROM deporte WHERE id=".$row['deporte'];
        $imagen = $conn->query($sql2)->fetch_assoc()['imagen'];
    ?>

    <div class="list-item">
      <img class="list-item-image" src="../img/<?=$imagen?>" alt="Imagen de evento">
      <div class="list-item-info">
        <div class="list-item-name"><a href="mostrar-evento.php?id=<?=$row['id']?>"><?=$row['titulo']?></a></div>
        <button class="btn-delete" onclick="borrarEvento(<?=$row['id']?>)">Borrar</button>
      </div>
    </div>

    <?php endwhile;?>
  </div>
</body>
</html>
<script>
    function borrarEvento(bt){
        
        if(confirm("¿Seguro que quieres elminar este evento?")){
            $.ajax({
                        data: {"id_evento":bt},
                        url: '../ajax/borrarEvento.php',
                        type: 'post',
                        success: function(result){
                            if(result.ok){
                                alert(result);
                            }
                            location.reload();
                        }
                    })
        }
    }
</script>
