<?php

include_once("../conexion/conexion.php");

$id_peticion = $_POST['id_peticion'];
$id_usuario = $_POST['id_usuario'];
$id_remitente = $_POST['id_remitente'];

$sql = "DELETE FROM peticiones_amistad WHERE id=$id_peticion";

$sql2 = "INSERT INTO `amistad` (`id`, `usuario1_id`, `usuario2_id`, `fecha_amistad`) VALUES (NULL, '$id_usuario', '$id_remitente', current_timestamp());";

$res2 = $conn->query($sql2);

if(!$res2){
    echo "Ha ocurrido un error en el servidor, intentelo de nuevo mas tarde";
}else{
    echo "Se ha aceptado la peticion de amiistad";

    $res = $conn->query($sql);
}

?>