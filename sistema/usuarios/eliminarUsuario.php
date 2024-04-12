<?php

session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../index.php');
}

require_once '../../conexion/conexion.php';

$id = (empty($_POST['id'])) ? null : $_POST['id'];

$select = "SELECT inspector, fa_nombre, fa_apellido FROM fa_asignaciones INNER JOIN fa_usuarios ON inspector = id_usuario  WHERE id_usuario = '" . $id . "' ";
$query1 = mysqli_query($conexion, $select);
$total = mysqli_num_rows($query1);

if ($total > 0) {
    $_SESSION['msg'] = '<p style="color:red; font-weight:bold">Reasigna los documentos del usuario para poder eliminarlo.</p>';
    header('location:agregarUsuario.php');
} else {
    $query = mysqli_query($conexion, "DELETE FROM fa_usuarios WHERE `id_usuario` = $id ");
    if ($query) {
        $_SESSION['msg'] = 'Eliminado correctamente';
        header('location:agregarUsuario.php');
    } else {
        $_SESSION['msg'] = 'No se pudo eliminar';
        header('location:agregarUsuario.php');
    }
}
