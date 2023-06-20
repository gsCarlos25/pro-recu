<?php

include_once("../conexion/conexion.php");

    $id = $_POST['idUsuario'];

    $sql = "UPDATE usuarios SET tipo=2 WHERE id=".$id;
    $res = $conn->query($sql);

    if(!$res){
        echo "Ha ocurrido un error";
    }else{
        echo "Eliminado correctamente";
    }

?>