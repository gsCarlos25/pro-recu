<?php
    include_once("../conexion/conexion.php");

    $arrayRes = array();
    $usuario = $_POST['usuario'];
    $id = $_POST['id'];

    $sql = "SELECT * FROM usuarios WHERE nom_us like '".$usuario."%' AND id<>$id";

    $res = $conn->query($sql);

    while($fila = $res->fetch_assoc()){
        $arrayUsuario = [
            "id" => $fila['id'],
            "nombre" => $fila['nom_us'],
            'foto' => $fila['foto']
        ];

        $arrayRes[] = $arrayUsuario;
    }

    echo json_encode($arrayRes);



?>