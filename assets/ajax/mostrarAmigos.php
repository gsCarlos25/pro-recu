<?php

include_once("../conexion/conexion.php");

$arrayRes = array();
$id = $_POST['id'];

$sql = "SELECT * FROM amistad WHERE usuario1_id=$id OR usuario2_id=$id";

$res = $conn->query($sql);

while($fila = $res->fetch_assoc()){
    
    if($fila['usuario1_id'] == $id){
        $sql2 = "SELECT * FROM usuarios WHERE id=".$fila['usuario2_id'];
    }else{
        $sql2 = "SELECT * FROM usuarios WHERE id=".$fila['usuario1_id'];
    }

    $res2 = $conn->query($sql2);
    $result = $res2->fetch_assoc();

    $arrayUsuario = [
        "id" => $result['id'],
        "nombre" => $result['nom_us']
    ];

    $arrayRes[] = $arrayUsuario;
}

echo json_encode($arrayRes);

?>