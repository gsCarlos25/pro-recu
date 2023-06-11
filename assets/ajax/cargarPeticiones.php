<?php
    include_once("../conexion/conexion.php");

    $arrayRes = array();
    $usuario = $_POST['id_receptor'];

    $sql = "SELECT * FROM peticiones_amistad WHERE receptor_id=$usuario ORDER BY fecha_peticion desc";


    $res = $conn->query($sql);


    while($fila = $res->fetch_assoc()){
        $sql2 = "SELECT * FROM usuarios WHERE id=".$fila['remitente_id'];
        $res2 = $conn->query($sql2);

        $result = $res2->fetch_assoc();


        $arrayUsuario = [
            "id_peticion" => $fila['id'],
            "id_usuario" => $result['id'],
            "nombre" => $result['nom_us']
        ];

        $arrayRes[] = $arrayUsuario;
    }

    echo json_encode($arrayRes);



?>