<?php

    session_start();

    if(isset($_SESSION['id'])){
            header("Location: ../../index.php");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/registro-login.css" type="text/css"/>
    <link rel="stylesheet" href="../styles/index.css" type="text/css"/>
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
    <title>Login</title>
    

    
</head>
<body>
    <div class="container">
        <h1>Bienvenido a MeetSport</h1>
        <form action="" method="post" class="form" id="formLogin">
            <div class="form-group" style="text-align: center;">
                <img src="../favicon/icono.ico" alt="logo" style="height:15vh; width:15vh;">
            </div>
            <div class="form-group">
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" id="logUs" name="usuario">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="logPass" name="password">
            </div>
            <div class="form-group">
                <input type="submit" value="Iniciar Sesión">
            </div>
            <a href="registro.php" >¿No tienes cuenta?Pulsa aqui para registrarte</a>
        </form>
    </div>


    <!--<div class="form" action>
        
        <form action="" method="post" class="form">
            <img src="../favicon/icono.ico" alt="logo" style="height:15vh; width:15vh;">
            <p class = "texto">Bienvenido a MeetSport</p>
            <input type="text" id="logUs" placeholder="Nombre de usuario...">
            <input type="password" id="logPass" placeholder="Contraseña...">
            <button type="button" id="botLog" class="submit">Iniciar sesión</button>
            <a href="registro.php" >¿No tienes cuenta?Pulsa aqui para registrarte</a>
        </form>
    </div>-->

    <script type="text/javascript">

        $(document).ready(function(){
            $("#formLogin").submit(function(e){
                e.preventDefault();
                var valido = true;
                var errores = [];

                var usuario = $("#logUs").val();
                var pass = $("#logPass").val();
                
                var cList = $('.erroresForm');
                cList.html("");
                cList.hide("slow");

                //Para validar el formulario antes de enviarlo
                if(usuario == ""){
                    alert("Debes rellenar el nombre de usuario");
                    valido = false;
                }

                if(pass == ""){
                    alert("Debes rellenar la contraseña");
                    valido = false;
                }

                if(valido == true){
                    var parametros  = {
                        "correo" : usuario,
                        "pass" : pass,
                    }
                    $.ajax({
                        data: parametros,
                        url: '../ajax/loginUsuario.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            result = JSON.parse(result);
                            if(result.ok){
                                    window.location.href = result.redirect;
                            }else if(result.error != ""){
                                alert(result.error);
                            }
                        }
                    })
                }else{
                    $.each(errores, function(i){
                        alert(errores[i]);
                    })
                }
            });
        });



    </script>


</body>
</html>