<?php

include_once './bd/bd.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id_mantenimiento'])){
        $query="select * from mantenimiento where id_mantenimiento=".$_GET['id_mantenimiento'];
        $result=metodoGet($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from mantenimiento";
        $result=metodoGet($query);
        echo json_encode($result->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();

}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $modificado_por = $_POST['modificado_por'];
    $estado_mantenimiento = $_POST['estado_mantenimiento'];
    $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
    $hora_mantenimiento = $_POST['hora_mantenimiento'];
    $numero_galpones = $_POST['numero_galpones'];
    $control_plagas = $_POST['control_plagas'];
    $estado = $_POST['estado'];

    $query = "INSERT INTO mantenimiento (modificado_por, estado_mantenimiento, fecha_mantenimiento, hora_mantenimiento,
    numero_galpones, control_plagas, estado )
     VALUES ('$modificado_por', '$estado_mantenimiento', '$fecha_mantenimiento', '$hora_mantenimiento','$numero_galpones', 
    '$control_plagas', '$estado')";
    $queryAutoIncrement = "SELECT MAX(id_mantenimiento) AS id_mantenimiento FROM mantenimiento";
    $result = metodoPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id_mantenimiento=$_GET['id_mantenimiento'];
    $modificado_por = $_POST['modificado_por'];
    $estado_mantenimiento = $_POST['estado_mantenimiento'];
    $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
    $hora_mantenimiento = $_POST['hora_mantenimiento'];
    $numero_galpones = $_POST['numero_galpones'];
    $control_plagas = $_POST['control_plagas'];
    $estado = $_POST['estado'];

    $query="UPDATE mantenimiento SET modificado_por='$modificado_por',
     estado_mantenimiento='$estado_mantenimiento', 
    fecha_mantenimiento='$fecha_mantenimiento', hora_mantenimiento='$hora_mantenimiento',
    numero_galpones='$numero_galpones', control_plagas='$control_plagas',
    estado='$estado' WHERE id_mantenimiento='$id_mantenimiento'";
    $result = metodoPut($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_POST['METHOD'] =='DELETE') {
    unset($_POST['METHOD']);
    $id_mantenimiento = $_GET['id_mantenimiento'];
    $query="DELETE FROM mantenimiento WHERE id_mantenimiento='$id_mantenimiento'";
    $result=metodoDelete($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

?>