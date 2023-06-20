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

    $sql = "SELECT * FROM usuarios WHERE id<>".$_SESSION['id']." AND tipo<>2";
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

    while($row = mysqli_fetch_array($res)): ?>

    <div class="list-item">
      <img class="list-item-image" src="../img/<?=$row['foto']?>" alt="Imagen de perfil">
      <div class="list-item-info">
        <div class="list-item-name"><?=$row['nom_us']?></div>
        <button class="btn-delete" idUsuario="<?=$row['id']?>" onclick="borrarUsuario(<?=$row['id']?>)">Borrar</button>
      </div>
    </div>

    <?php endwhile;?>
  </div>
</body>
</html>
<script>
    function borrarUsuario(bt){
        
        if(confirm("¿Seguro que quieres elminar a este usuario?")){
            $.ajax({
                        data: {"idUsuario":bt},
                        url: '../ajax/borrarUsuario.php',
                        type: 'post',
                        success: function(result){
                            alert(result);
                            location.reload();
                        }
                    })
        }
    }
</script>
