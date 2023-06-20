<?php
session_start();

if(!isset($_SESSION['id'])){
        header("Location: ../../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css" type="text/css">
    <link rel="stylesheet" href="../styles/form.css" type="text/css">
    <link rel="stylesheet" href="../styles/cabecera.css" type="text/css">
    <link rel="stylesheet" href="../styles/perfil.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
    <title>Perfil</title>
</head>
<body>
    <?php
    require_once '../config/parameters.php';
    require_once './cabecera.php';
    ?>
    <div class="perfil">
        
        <div class="contenido">
            
            <?php 
            require_once '../funciones/datos.php';
            $nom_us = $datos['nom_us'];
            $nombre = $datos['nombre'];
            $apellidos = $datos['apellidos'];
            $descripcion = $datos['descripcion'];
            $contrasena = $datos['pass'];
            ?>
            <div>
                <img src="../img/<?=$datos['foto']?>" alt="Foto de perfil" id="fotoPerfilUsuario">
            </div>
            <?php
        echo "      <div class='des'>
                        <div class='lista'>
                        <li class='datosUs'>
                        <h2>Usuario</h2>
                        <ul>$nom_us</ul>
                        <h2>Nombre</h2>
                        <ul>$nombre</ul>
                        <h2>Apellidos</h2>
                        <ul>$apellidos</ul>
                        </li>
                        </div>
                        <div class='cajas'>
                        <h2 name='contrasena'>Contraseña</h2>
                        <form action='../funciones/cambiarDatos.php?tipo=contrasena' method='POST' method='GET'>
                        <input type='password' name='contrasena' id='contrasena' placeholder='cambia tu contrasena' value='$contrasena'>
                        <button id='editarDes'>Editar</button>
                        </form>
                        <h2 class='descripcion'>Descripción</h2>
                        <form action='../funciones/cambiarDatos.php?tipo=descripcion' method='POST'>
                        <textarea name='descripcion' id='descripcion' cols='30' rows='7' maxlength='300' placeholder='Máximo 300 caracteres'>$descripcion</textarea>
                        <button id='editarDes'>Editar</button>
                        </form>                      
                        </div>
                    </div>"
            ?>
            <div class="accion">






            <div id="amigos">
                <div id="cabeceraAmigos">
                    <h2 id="tituloamigos">Amigos</h2>
                    <button type="button" class="btn btn-primary btn-lg" onClick='mostrar()'>
                        Buscar amigos
                    </button>
                </div>
                <div id="cuerpoAmigos">
                    <ul id="listaAmigos">
                        
                    </ul>
                </div>
            </div>

            <div id="peticiones">
                <div id="cabeceraPeticiones">
                    <h2 id="tituloPeticiones">Peticiones pendientes</h2>
                </div>
                <div id="cuerpoPeticiones">
                    <ul id="listaPeticiones">
                    </ul>
                </div>
            </div>

            

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <div class="buscar-a">
                        <input type="text" name="nombreAmigo" id="nombreAmigo" placeholder="Introduce el nombre de tu amigo..">
                        <button type="button" class="close" onClick='cerrar()' data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>                       
                    <div class="modal-body" id="amigosEncontrados">
                        <ul id="listaBuscarAmigos"></ul>
                    </div>
                </div>
                </div>
            </div>
            </div>







                    <form action="../funciones/cerrarSesion.php">
                        <button class="cerrarSesion" id="cerrarS">Cerrar sesión</button>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>

$( document ).ready(function() {
    cargarPeticiones();
    cargarAmigos();

});
    $("#nombreAmigo").keyup(function(){
        $("#listaBuscarAmigos").empty();
        id = <?php echo $_SESSION['id'] ?>;
        if($(this).val().length > 0){
            parametros = {
                "id" : id,
                "usuario" : $(this).val()
            }
            $.ajax({
                data: parametros,
                url: '../ajax/buscarUsuario.php',
                type: 'post',
                success: function(result){
                    result = JSON.parse(result);
                    if(result.length == 0){
                        $("#listaBuscarAmigos").append("<h1>No hay ningun usuario con ese nombre</h1>");
                    }else{
                        for(i=0;i<result.length;i++){
                            let elemento = $( "<li class='amigo list-unstyled'></li>" );
                            let elemento2 = $("<div class='imagen-usuario'><img src='../img/"+result[i]['foto']+"' class='imagen-perfil'></div>");
                            let elemento3 = $("<div class='nombre-usuario'>"+result[i]["nombre"]+"</div>");
                            let elemento4 = $("<button class='btn btn-primary' onClick='anadirAmigo("+result[i]["id"]+")' >Añadir</button>");
                            elemento.append(elemento2);
                            elemento.append(elemento3);
                            elemento.append(elemento4);
                            $("#listaBuscarAmigos").append(elemento);
                        }
                    }
                }
                });
        }
    });

    function cargarAmigos(){
        id = <?php echo $_SESSION['id']; ?>;

        $("#listaAmigos").empty();



        $.ajax({
            data: {"id":id},
            url: '../ajax/mostrarAmigos.php',
            method: 'post',
            success: function(result){
                console.log("Hola"+result)
                result = JSON.parse(result);
                if(result.length == 0){
                    $("#listaAmigos").append("<h4>No tienes amigos aun, añade uno</h4>");
                }else{
                    for(i=0;i<result.length;i++){
                        let elemento = $( "<li class='amigo list-unstyled'></li>" );
                        let elemento2 = $("<div class='imagen-usuario'><img src='https://bootdey.com/img/Content/avatar/avatar7.png' class='imagen-perfil'></div>");
                        let elemento3 = $("<div class='nombre-usuario'>"+result[i]["nombre"]+"</div>");
                        elemento.append(elemento2);
                        elemento.append(elemento3);
                        $("#listaAmigos").append(elemento);
                    }
                }
            }

        })
    }

    

    function anadirAmigo(id2){
        let id1 = <?php echo $_SESSION['id']."";?>;
        parametros = {
            "id_remitente" : id1,
            "id_receptor" : id2
        }
        $.ajax({
                data: parametros,
                url: '../ajax/enviarPeticion.php',
                type: 'post',
                success: function(result){
                    alert(result);
                }
        });
    }

    function cargarPeticiones(){
        $("#listaPeticiones").empty();
        let id = <?php echo $_SESSION['id']."";?>;
        parametros = {
            "id_receptor" : id
        }

        $.ajax({
            data: parametros,
            url: '../ajax/cargarPeticiones.php',
            type: 'post',
            success: function(result){
                result = JSON.parse(result);
                if(result.length == 0){
                    $("#listaPeticiones").append("<h4>Sin peticiones</h4>");
                }else{
                    for(i=0;i<result.length;i++){
                        let elemento = $( "<li class='peticion list-unstyled'></li>" );
                        let elemento2 = $("<div class='imagen-usuario'><img src='https://bootdey.com/img/Content/avatar/avatar7.png' class='imagen-perfil'></div>");
                        let elemento3 = $("<div class='nombre-usuario'>"+result[i]["nombre"]+"</div>");
                        let elemento4 = $("<div id='botonesPeticion'><button class='btn btn-success' onClick='aceptarPeticion("+result[i]['id_peticion']+","+result[i]['id_usuario']+")'>Aceptar</button><button class='btn btn-danger' onClick='rechazarPeticion("+result[i]['id_peticion']+")'>Rechazar</button></div>");
                        elemento.append(elemento2);
                        elemento.append(elemento3);
                        elemento.append(elemento4);
                        $("#listaPeticiones").append(elemento);
                    }
                }
                console.log(result)
            }
        });

    }

    function aceptarPeticion(id_peticion,id_remitente){
        let id_usuario = <?php echo $_SESSION['id'];?>;

        parametros = {
            'id_peticion' : id_peticion,
            "id_remitente" : id_remitente,
            "id_usuario" : id_usuario
        }

        $.ajax({
                data: parametros,
                url: '../ajax/aceptarPeticion.php',
                type: 'post',
                success: function(result){
                    alert(result);
                    cargarPeticiones();
                }
        });
    }


    function rechazarPeticion(id){
        $.ajax({
                data: {"id":id},
                url: '../ajax/rechazarPeticion.php',
                type: 'post',
                success: function(result){
                    alert(result);
                    cargarPeticiones();
                }
        });
    }

    function mostrar(){
        $(".modal-header").css("display","flex")
        $('#listaBuscarAmigos').css("display","flex");
                        }

    function cerrar(){
        $('.modal-header').css("display","none");
        $('#listaBuscarAmigos').css("display","none");
    }

    $('.modal-header').css("display","none");
    
</script>



