<?php

session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../index.php');
}

require_once '../../conexion/conexion.php';

$id = (empty($_POST['id'])) ? null : $_POST['id'];

$query = mysqli_query($conexion, "DELETE FROM fa_normas WHERE `id` = $id ");
if ($query) {
    $_SESSION['msg'] = 'Eliminado correctamente';
    header('location:index.php');
} else {
    $_SESSION['msg'] = 'No se pudo eliminar';
    header('location:index.php');
}
