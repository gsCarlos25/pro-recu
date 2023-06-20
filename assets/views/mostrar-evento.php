<?php

    include_once "../conexion/conexion.php";
    include_once '../config/parameters.php';

    session_start();

    if(!isset($_SESSION['id'])){
            header("Location: ../../index.php");
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header('Location:../../index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/index.css" type="text/css">
    <link rel="stylesheet" href="../styles/cabecera.css" type="text/css">
    <link rel="stylesheet" href="../styles/mostrar-evento.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
    <title>Evento</title>
</head>
<?php

    
    include_once './cabecera.php';

    


    //Coge la info del evento
    $sql = "SELECT * FROM evento WHERE id=$id";
    $res = $conn->query($sql);
    $evento = mysqli_fetch_assoc($res);
    if(!isset($evento)){
        header("location:".base_url."/index.php");
    }


    //Comprueba si el usuario está apuntado a menos de 3 eventos
    $sql2 = "SELECT * FROM usuario_apuntado WHERE id_usuario=".$_SESSION['id'];
    $res2 = $conn->query($sql2);
    $total = mysqli_num_rows($res2);


    //Comprueba si está apuntado a este evento
    $apuntado = false;
    $sql3 = "SELECT id_evento FROM usuario_apuntado WHERE id_usuario=".$_SESSION['id']." AND id_evento=".$id;
    $res3 = $conn->query($sql3);
    if(mysqli_num_rows($res3) >= 1){
        $apuntado = true;
    }

    

?>

<body>
    <?php 
    $titulo = $evento['titulo'];
    $direccion = $evento['direccion'];
    $descripcion = $evento['descripcion'];

    if($_SESSION['id'] != $evento['id_usuario']){
    ?>
        <div class='info-evento'>
            <h4>Título</h4>
            <?=$titulo?>
            
            <h4>Direccion</h4>
            <?=$direccion?>
            
            <h4>Queremos hacer: </h4>
            <?=$descripcion?>
            <br>
    <?php

    

    //Comprueba que el usuario no haya creado este evento, no este apuntado a 3 eventos y no esté apuntado a este evento
        if($total < 3 && $apuntado == false){
    ?>

    <button id="apuntar">¡Apuntate a este evento!</button><br>  <br> 

    <?php
        }else if($apuntado == true){
    ?>
    <button id="borrarUs" class="borrar">Borrarse de este evento</button><br><br>
    
    <a id='enlace-chat' href='./chat.php?id=<?=$id?>'>Enlace al chat</a>

    
    <?php
        }
    }else{

    ?>
            <!-- SI EL USUARIO HA SIDO EL CREADOR DEL EVENTO -->

            <div class='info-evento'>
                <h4>Título</h4>
                <input type='text' name='titulo' id='titulo' placeholder='cambia el título' value='<?=$titulo?>'>
                <br>
                <h4>Direccion</h4>
                <input type='text' name='direccion' id='direccion' placeholder='cambia la direccion' value='<?=$direccion?>'>
                <br>
                <h4>Queremos hacer: </h4>
                <textarea name='descripcion' id='descripcion' cols='30' rows='7' maxlength='300' placeholder='Máximo 300 caracteres'><?=$descripcion?></textarea><br>
            
                <button id="editar">Editar este evento</button><br>

                <button id="borrar" class="borrar">Borrar este evento</button>
                
                <a id='enlace-chat' href='./chat.php?id=<?=$id?>'>Enlace al chat</a>

    
    <?php

        }
    ?>
        
    </div>
    





</body>
</html>

<script>

        $(document).ready(function(){
            $("#apuntar").click(function(){
                var parametros = {
                    "id_usuario" : <?php echo $_SESSION['id'];?>,
                    "id_evento" : <?php echo $_GET['id'];?>
                }
                $.ajax({
                        data: parametros,
                        url: '../ajax/apuntarse.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            alert("Te has apuntado a este evento");

                        }
                    })
                window.location.reload();
            })

            $("#borrarUs").click(function(){
                var parametros = {
                    "id_usuario" : <?php echo $_SESSION['id'];?>,
                    "id_evento" : <?php echo $_GET['id'];?>
                }
                $.ajax({
                        data: parametros,
                        url: '../ajax/borrarse.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            alert("Te has borrado de este evento");
                            window.location.reload();
                        }
                    })
                
            })

            $("#borrar").click(function(){
                var parametros = {
                    "id_evento" : <?php echo $_GET['id'];?>
                }
                if(confirm("¿Seguro que quieres eliminar este evento?")){
                    $.ajax({
                        data: parametros,
                        url: '../ajax/borrarEvento.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            alert("Has borrado este evento");
                            window.location.href="../../index.php";
                        }
                    })
                }
                              
            })

            $("#editar").click(function(){
                var parametros = {
                    "id_evento" : <?php echo $_GET['id'];?>,
                    "titulo" : $('#titulo').val(),
                    "descripcion" : $('#descripcion').val(),
                    "direccion": $('#direccion').val()
                }
                $.ajax({
                        data: parametros,
                        url: '../ajax/editar.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            alert("Has editado este evento");
                            window.location.reload();
                        }
                    })
            })
        })

</script>