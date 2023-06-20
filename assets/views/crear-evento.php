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

    ?>


<!DOCTYPE html>
<html lang="en">
<head>   
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOWzafxQET0zutuevXzmbtgE4_amragNs&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css" type="text/css"></link>
    <link rel="stylesheet" href="../styles/cabecera.css">
    <link rel="stylesheet" href="../styles/crear-evento.css">
    <link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
    <title>Crear Evento</title>
</head>

<div class="containerr">
    <h1>Crear evento</h1>
    <form id="formEvento">
    <?php
        $fecha_actual = date('Y-m-d');
        $fecha_maxima = date("Y-m-d",strtotime($fecha_actual."+ 1 Year"));
    ?>
      <div class="form-group">
        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="titulo" maxlength="20">
      </div>
      <div class="form-group">
        <label for="n_personas">Numero de personas:</label>
        <input type="number" id="n_personas" name="n_personas" min="1" max="21">
      </div>
      <div class="form-group">
        <label for="deporte">Deporte:</label>
        <select id="deporte" name="deporte" required>
            <option value=0>Seleccione...</option>
            <?php while($row = mysqli_fetch_array($resDep)): ?>
            <option value=<?= $row['id'] ?>><?=$row['nombre']?></option>
            <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha"  min=<?php echo $fecha_actual?> max="<?php echo $fecha_maxima?>">
      </div>
      <div class="form-group">
        <label for="direccion">Direccion:</label>
        <input type="text" id="direccion" name="direccion">
      </div>
      <div class="form-group">
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id="descripcion" cols="30" rows="7" maxlength="300" placeholder="Descripcion del evento"></textarea>
      </div>
      
      <input type="submit" value="Crear" class>
    </form>
  </div>


    <script>
        $(document).ready(function(){
            $("#formEvento").submit(function(event){
                event.preventDefault();

                var valido = true;
                var errores = [];


                var autocomplete = new google.maps.places.Autocomplete((document.getElementById("direccion")));

                var deporte = $( "#deporte option:selected" ).val();
                var personas = $("#n_personas").val();
                var fecha = $.trim($("#fecha").val());
                var titulo = $.trim($("#titulo").val());
                var direccion = $.trim($("#direccion").val());
                var descripcion = $.trim($("#descripcion").val());

                if(deporte=="0" || fecha=="" || titulo=="" || direccion=="" || descripcion == "" || n_personas == ""){
                    alert("Debes rellenar todos los campos, son obligatorios");

                    valido = false;
                }

                if(valido == true){
                    var parametros  = {
                        "deporte" : deporte,
                        "personas" : personas,
                        "fecha" : fecha,
                        "titulo" : titulo,
                        "direccion" : direccion,
                        "descripcion" : descripcion
                    }
                    $.ajax({
                        data: parametros,
                        url: '../ajax/crearEvento.php',
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
                $(".msg_error").show("slow");

            })
        });
    </script>

</body>
</html>