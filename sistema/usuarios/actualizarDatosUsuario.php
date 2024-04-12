<?php

session_start();
if($_SESSION['active']!= true){
    session_destroy();
    header('location: ../../index.php');
}

require_once '../../conexion/conexion.php';

$id = (empty($_POST['idd'])) ? null : $_POST['idd'];
$nombre = (empty($_POST['nombre1'])) ? null : $_POST['nombre1'];
$apellido = (empty($_POST['apellido1'])) ? null : $_POST['apellido1'];
$usuario = (empty($_POST['usuario1'])) ? null : $_POST['usuario1'];
$contra = (empty($_POST['password1'])) ? null : $_POST['password1'];
$rol = (empty($_POST['roll'])) ? null : $_POST['roll'];



$query = mysqli_query($conexion, "UPDATE `fa_usuarios` SET `fa_nombre`= '$nombre', `fa_apellido`='$apellido', `fa_user`='$usuario',`fa_password`='$contra',`fa_rol`=$rol WHERE `id_usuario` = $id ");
if($query){
    $_SESSION['msg'] = 'Actualizado correctamente';
    header('location:agregarUsuario.php');
}else{
    $_SESSION['msg'] = 'Error al actualizar';
    header('location:agregarUsuario.php');
}