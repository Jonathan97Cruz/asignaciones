<?php
session_start();
if($_SESSION['active'] != true){
    session_destroy();
    header('location:../../index.php');
}
require_once('../../conexion/conexion.php');

$nombre = (empty($_POST['nombre'])) ? null : $_POST['nombre'];
$estatus = 1;

$query = mysqli_query($conexion,"SELECT * FROM fa_normas WHERE norma LIKE '%".$nombre."%' ");
if(mysqli_num_rows($query) > 0){
    echo json_encode('error');
}else{
    $sql = mysqli_query($conexion,"INSERT INTO fa_normas (norma, estatus) VALUES('$nombre', $estatus) ");
    if($sql == true){
        echo json_encode("Correcto");
    } else {
        echo json_encode("error");
    }
}

?>