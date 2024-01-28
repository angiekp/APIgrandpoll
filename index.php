<?php

include_once './bd/bd.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id_empleado'])){
        $query="SELECT * FROM empleado WHERE id_empleado=".$_GET['id_empleado'];
        $result=metodoGet($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM empleado";
        $result=metodoGet($query);
        echo json_encode($result->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();

}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombre_empleado = $_POST['nombre_empleado'];
    $apellido_empleado = $_POST['apellido_empleado'];
    $documento_empleado = $_POST['documento_empleado'];
    $telefono_empleado = $_POST['telefono_empleado'];
    

    $query = "INSERT INTO empleado(nombre_empleado, apellido_empleado, documento_empleado, telefono_empleado)
     VALUES ('$nombre_empleado', '$apellido_empleado', '$documento_empleado', '$telefono_empleado')";
    $queryAutoIncrement = "SELECT MAX(id_empleado) AS id_empleado FROM empleado";
    $result = metodoPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id_empleado=$_GET['id_empleado'];
    $nombre_empleado = $_POST['nombre_empleado'];
    $apellido_empleado = $_POST['apellido_empleado'];
    $documento_empleado = $_POST['documento_empleado'];
    $telefono_empleado = $_POST['telefono_empleado'];

    $query="UPDATE empleado SET nombre_empleado='$nombre_empleado', apellido_empleado='$apellido_empleado', 
    documento_empleado='$documento_empleado',
    telefono_empleado='$telefono_empleado' WHERE id_empleado='$id_empleado'";
    $result = metodoPut($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_POST['METHOD'] =='DELETE') {
    unset($_POST['METHOD']);
    $id_empleado = $_GET['id_empleado'];
    $query="delete from empleado where id_empleado='$id_empleado'";
    $result=metodoDelete($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

?>