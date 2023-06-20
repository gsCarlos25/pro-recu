<?php

    include_once("../conexion/conexion.php");

    $id_evento = $_POST['id_evento'];

    $sql2 = "DELETE FROM usuario_apuntado WHERE id_evento = $id_evento";
    $res2 = $conn->query($sql2);
    $sql = "DELETE FROM `evento` WHERE `evento`.`id` = $id_evento";
    $res = $conn->query($sql);

    $array_result = [];

    if($res){
        $array_result['ok'] = "Ha ido bien";
    }else{
        $array_result['error'] = "Error al borrar los datos";
    }

    echo json_encode($array_result);
?>