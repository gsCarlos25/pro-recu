<?php

include_once("../conexion/conexion.php");

    $id = $_POST['id'];

    $sql = "DELETE FROM peticiones_amistad WHERE id=$id";

    $res = $conn->query($sql);

    if(!$res){
        echo "Ocurrió un error en el servidor, intentelo de nuevo mas tarde";
    }else{
        echo "Petición rechazada";
    }


?>