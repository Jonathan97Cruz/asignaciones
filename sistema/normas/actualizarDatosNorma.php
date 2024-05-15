<?php

session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../index.php');
}

require_once '../../conexion/conexion.php';

$id = (empty($_POST['idd'])) ? null : $_POST['idd'];
$nombre = (empty($_POST['nombre1'])) ? null : $_POST['nombre1'];
$sql = mysqli_query($conexion, "SELECT * FROM fa_normas WHERE norma LIKE '%$nombre%' ");
if (mysqli_num_rows($sql) > 0) {
    $_SESSION['msg'] = 'Error al actualizar';
    header('location:index.php');
} else {
    $query = mysqli_query($conexion, "UPDATE `fa_normas` SET `norma`= '$nombre' WHERE `id` = $id ");
    if ($query) {
        $_SESSION['msg'] = 'Actualizado correctamente';
        header('location:index.php');
    } else {
        $_SESSION['msg'] = 'Error al actualizar';
        header('location:index.php');
    }
}
