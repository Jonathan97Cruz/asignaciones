<?php

session_start();
if($_SESSION['active']!= true){
    session_destroy();
    header('location: ../../index.php');
}

require_once '../../conexion/conexion.php';

$nombre = (empty($_POST['nombre'])) ? null : $_POST['nombre'];
$apellido = (empty($_POST['apellido'])) ? null : $_POST['apellido'];
$usuario = (empty($_POST['usuario'])) ? null : $_POST['usuario'];
$contra = (empty($_POST['password'])) ? null : $_POST['password'];
$rol = (empty($_POST['rol'])) ? null : $_POST['rol'];
$fecha = date('Y-m-d');
$estatus = 1;


$query = mysqli_query($conexion, "INSERT INTO fa_usuarios(`fa_nombre`,`fa_apellido`,`fa_user`,`fa_password`,`fa_rol`,`fa_estatus`,`fa_fechAlta`)
                                    VALUES ('$nombre','$apellido','$usuario','$contra','$rol','$estatus','$fecha') ");
if($query){
    echo json_encode('Correcto');
}else{
    echo json_encode('error');
}