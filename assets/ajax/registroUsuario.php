<?php

    include_once("../conexion/conexion.php");
    session_start();

    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    if(isset($_POST['desc'])){
        $descripcion = $_POST['desc'];
    }else{
        $descripcion = "";
    }

    $array_result = [];
    $existe = false;

    //Buscamos el usuario tanto por correo 
    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";

    $sql2 = "SELECT * FROM usuarios WHERE nom_us='$usuario'";

    $resCor = mysqli_query($conn, $sql);
    $resUsuario = mysqli_query($conn, $sql2);

    if(mysqli_num_rows($resUsuario) > 0){
        //Existe el correo
        $array_devolver['error']="Este nombre de usuario ya esta en uso";
        $existe = true;
    }else if(mysqli_num_rows($resCor) > 0){
            $array_devolver['error'] = "Este correo ya está en uso";
            $existe = true;
    }
    
    if($existe==false){
        //No existe

        if (isset($_FILES['imageUpload'])) {
            $tmpFilePath = $_FILES['imageUpload']['tmp_name'];
            $fileName = $_FILES['imageUpload']['name'];
            $fileType = $_FILES['imageUpload']['type'];
        
        
            $ext = explode('.', basename($fileName));
            $nuevoNombre = date("YmdHis");
            $nombreFoto = $nuevoNombre .".". array_pop($ext);
        
        
            $validImageTypes = ["image/jpeg", "image/jpg", "image/png"];
            if (!in_array($fileType, $validImageTypes)) {
              echo "Error: Solo se permiten archivos de imagen JPG, JPEG o PNG.";
              return;
            }
          
            // Directorio de destino para guardar la imagen
            $destino = "../img/";
          
            // Mover el archivo a la ubicación deseada
            $destinationPath = $destino . $nombreFoto;
            if (!move_uploaded_file($tmpFilePath, $destinationPath)) {
              echo "Error al subir el archivo.";
              return;
            }else{
                //echo "Imagen subida";
            }
          
            // Aquí puedes realizar otras operaciones con el archivo subido
          }else{
            $nombreFoto = "img_avatar.png";
          }

        $sql = "INSERT INTO usuarios VALUES(NULL, '$correo', '$pass', '$usuario', '$nombre', '$apellido','$descripcion','$nombreFoto', '0')";

        
        if($conn->query($sql) == TRUE){
            $array_devolver['ok'] = true;
            $array_devolver['redirect']= './login.php'; 
            
            $sql = "SELECT id FROM usuarios WHERE correo='$correo'";
            $res = mysqli_query($conn, $sql);
        }else{
            $array_devolver['error'] ="Ocurrió un error al insertar los datos";
        }
    }

    echo json_encode($array_devolver);

?>