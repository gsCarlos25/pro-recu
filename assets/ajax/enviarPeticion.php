<?php
    include_once("../conexion/conexion.php");

    $arrayRes = array();
    $id1 = $_POST['id_remitente'];
    $id2 = $_POST['id_receptor'];

    $sql = "INSERT INTO `peticiones_amistad` (`id`, `remitente_id`, `receptor_id`, `fecha_peticion`) VALUES (NULL, '$id1', '$id2', current_timestamp())";

    $res = $conn->query($sql);

    if(!$res){
        echo "Error al enviar la peticion";
    }else{
        echo "Peticion enviada correctamente";
    }



?>