<?php

include_once '../conexion/conexion.php';
include_once '../config/parameters.php';

session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include_once './cabecera.php';

        $consulta = "SELECT nom_us FROM usuarios WHERE id=".$_SESSION['id'];
        $resnombre = $conn->query($consulta);
        $nombre = $resnombre->fetch_assoc()['nom_us'];
        


    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initianl-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cabecera.css" type="text/css"></link>
    <link rel="stylesheet" href="../styles/chat.css" type="text/css"></link>
    <link rel="stylesheet" href="../styles/index.css" type="text/css"></link>
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        var from = null, start = 0, url="../ajax/chat.php";
        $(document).ready(function(){

            cargarMensajes();

            $('form').submit(function(e){
                e.preventDefault();
                parametros = {
                    "mensaje" : $('#mensaje').val(),
                    "nombre" : '<?=$nombre?>',
                    "id_evento" : <?=$_GET['id']?>
                }
                $.post(url,parametros);
                $('#mensaje').val("");
                return false;
            })

            function cargarMensajes(){
                $.get(url+"?id="+<?=$_GET['id']?>+"&start="+start, function(result){
                    if(result.todos){
                        result.todos.forEach(item =>{
                            start = item.id;
                            $('#mensajes').append(renderMensaje(item));
                        })
                        $('#mensajes').animate({scrollTop: $('#mensajes')[0].scrollHeight});
                    }
                    cargarMensajes();
                })
            }



            function renderMensaje(item){
                let time = new Date(item.fecha)
                time = `${time.getHours()}:${time.getMinutes()}`
                return '<div class = "msg"><p>'+item.nombre+'</p>'+item.mensaje+'<span>'+time+'</span></div>';
            }
            

        })
    </script>
    <title>Chat</title>
</head>
<body>
    <div id="mensajes"></div>
        <form>
            <input type="text" name=""  class="mensaje" id="mensaje" autocomplete="off" autofocus placeholder="Escribe algo...">
            <input type="submit" class="mensaje">
        </form>
</body>
</html>