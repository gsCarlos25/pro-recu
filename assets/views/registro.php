<?php

    session_start();

    if(isset($_SESSION['id'])){
            header("Location: ../../index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/registro-login.css" type="text/css"/>
    <link rel="stylesheet" href="../styles/index.css" type="text/css"/>
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
    <title>Registrarse</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="container">
        <h1>Formulario de Registro</h1>
        <form action="" method="post" class="form" id="formularioRegistro"  enctype="multipart/form-data">
        <div class="form-group" style="text-align: center;">
            <input type="file" id="imageUpload" name="imageUpload" accept=".jpg, .jpeg, .png" value="../img/img_avatar.png" style="display: none;">
            <img id="previewImage" src="../img/img_avatar.png" alt="Preview Image">
        </div>
        <div class="form-group">
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" id="regUs" name="usuario" >
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="regNom" name="nombre" >
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos:</label>
            <input type="text" id="regAp" name="apellido" >
        </div>
        <div class="form-group">
            <label for="correo">Correo electrónico:</label>
            <input type="text" id="regCor" name="correo" >
        </div>
        <div class="form-group">
            <label for="pass">Contraseña:</label>
            <input type="password" id="regPass" name="pass" >
        </div>
        <div class="form-group">
            <label for="repPass">Repetir contraseña:</label>
            <input type="password" id="regRepPass" >
        </div>
        <div class="form-group">
            <label for="desc">Descripción:</label>
            <textarea id="regDesc" name="desc" placeholder="Preséntate tu mismo..."></textarea>
        </div>
        <div class="form-group">
            <input type="submit" id="botReg" class="submit" value="Crear cuenta">
        </div>
        <a href="login.php">¿Ya tienes cuenta?Pulsa aqui para iniciar sesion</a>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#previewImage').click(function() {
                $('#imageUpload').click();
            });

            $('#imageUpload').change(function() {
                $("#imageUpload").hide();
                $("#previewImage").show();
                var file = this.files[0];

                // Validar el tipo de archivo
                var fileType = file["type"];
                var validImageTypes = ["image/jpeg", "image/jpg", "image/png"];
                if ($.inArray(fileType, validImageTypes) < 0) {
                alert("Solo se permiten archivos de imagen JPG, JPEG o PNG.");
                return;
                }

                // Previsualizar la imagen
                var reader = new FileReader();
                reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            });



            $("#formularioRegistro").submit(function(e){
                e.preventDefault();
                var valido = true;
                var errores = [];
                var cList = $('.erroresForm');
                cList.html("");



                //Recoger datos
                var usuario = $.trim($("#regUs").val());
                var pass = $.trim($("#regPass").val());
                var repPass = $.trim($("#regRepPass").val());
                var nombre = $.trim($("#regNom").val());
                var apell = $.trim($("#regAp").val());
                var correo = $.trim($("#regCor").val());
                var descripcion = $.trim($("#regDesc").val());

                var formData = new FormData($(this)[0]);


                //Validar formulario
                if(usuario=="" || pass=="" || repPass=="" || nombre=="" || apell=="" || correo==""){
                    alert("Debes rellenar todos los campos obligatorios");

                    valido = false;
                }else{
                    let regexLetra = /^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/; //Comprueba que tenga solo letras o espacios
                    let regexPas = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/; //Comprueba que la contraseña tenga numero, letra minusucla y mayuscula
                    let regexUs = /^[a-z0-9_-]{3,16}$/;//Coprueba que tenga tenga numeros o letras 
                    let regexCor = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/; //Compurbea que este bien escrito el correo

                    if(usuario.length > 20){
                        alert("El nombre de usuario debe contener como máximo 20 caracteres");
                        valido = false;
                    }else if(!regexUs.test(usuario)){
                        alert("El nombre de usuario solo puede contener numeros,letras, _ o -");
                        valido = false;
                    }

                    if(pass.length < 8 || pass.length > 15){
                        alert("La contraseña debe contener como mínimo 8 caracteres y 15 como máximo");
                        valido = false;
                    }else if(!regexPas.test(pass)){
                        alert("La contraseña debe tener 1 minúscula, 1 mayúscula y un número");
                        valido = false;
                    }
                    
                    if(pass != repPass){
                        alert("Las contraseñas no coinciden");
                        valido = false;
                    }

                    if(nombre.length > 25){
                        alert("El nombre no puede contener más de 25 caracteres");
                        valido = false;
                    }else if(!regexLetra.test(nombre)){
                        alert("El nombre solo puede contener letras");
                        valido = false;
                    }

                    if(apell.length > 25){
                        alert("Lo apellidos no pueden contener más de 25 caracteres");
                        valido = false;
                    }else if(!regexLetra.test(apell)){
                        alert("Los apellidos solo pueden contener letras");
                        valido = false;
                    }

                    if(correo.length > 50){
                        alert("El correo no puede contener mas de 50 caracteres");
                        valido = false;
                    }else if(!regexCor.test(correo)){
                        alert("El correo no es válido");
                        valido = false;
                    }


                }

                if(valido){
                    $.ajax({
                        data: formData,
                        contentType: false, 
                        processData: false,
                        url: '../ajax/registroUsuario.php',
                        type: 'post',
                        success: function(result){
                            console.log(result);
                            result = JSON.parse(result);
                            if(result.ok){
                                alert("Registro completado")
                                window.location.href = result.redirect;
                            }
                            else if(result.error != ""){
                                alert(result.error);
                            }
                        }
                    })
                }
            })
        });
    </script>
</body>
</html>