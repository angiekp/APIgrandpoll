<?php

include_once './bd/bd.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id_galpon'])){
        $query="SELECT * FROM galpon WHERE id_galpon=".$_GET['id_galpon'];
        $result=metodoGet($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM galpon";
        $result=metodoGet($query);
        echo json_encode($result->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();

}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $cod_mantenimiento = $_POST['cod_mantenimiento'];
    $temperatura_galpon = $_POST['temperatura_galpon'];
    $cantidad_pollos = $_POST['cantidad_pollos'];
    $aseo = $_POST['aseo'];
    $control_plagas = $_POST['control_plagas'];
    $estado = $_POST['estado'];

    $query = "INSERT INTO galpon (cod_mantenimiento, temperatura_galpon, cantidad_pollos, aseo, 
    control_plagas, estado )
     VALUES ('$cod_mantenimiento', '$temperatura_galpon', '$cantidad_pollos', '$aseo', 
    '$control_plagas', '$estado')";
    $queryAutoIncrement = "SELECT MAX(id_galpon) AS id_galpon FROM galpon";
    $result = metodoPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id_galpon=$_GET['id_galpon'];
    $cod_mantenimiento = $_POST['cod_mantenimiento'];
    $temperatura_galpon = $_POST['temperatura_galpon'];
    $cantidad_pollos = $_POST['cantidad_pollos'];
    $aseo = $_POST['aseo'];
    $control_plagas = $_POST['control_plagas'];
    $estado = $_POST['estado'];

    $query="UPDATE galpon SET cod_mantenimiento='$cod_mantenimiento', temperatura_galpon='$temperatura_galpon', 
    cantidad_pollos='$cantidad_pollos', aseo='$aseo',control_plagas='$control_plagas',
    estado='$estado' WHERE id_galpon='$id_galpon'";
    $result = metodoPut($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_POST['METHOD'] =='DELETE') {
    unset($_POST['METHOD']);
    $id_galpon = $_GET['id_galpon'];
    $query="DELETE FROM galpon WHERE id_galpon='$id_galpon'";
    $result=metodoDelete($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

?>