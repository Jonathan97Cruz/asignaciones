<?php

session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../index.php');
}
require_once '../../conexion/conexion.php';
$usuarioN = $_SESSION['fa_nombre'];
$usuarioP = $_SESSION['fa_apellido'];
$fecha = Date('Y-m-d');
$fechaF = new DateTime($fecha);
$fechaFo = $fechaF->format('d-m-Y');

$id = (empty($_POST['id'])) ? null : $_POST['id'];
if ($id == null) {
    header('location:listadoAsignaciones.php');
} else {
    $sql = mysqli_query($conexion, "SELECT observaciones FROM fa_asignaciones WHERE fa_idAsignacion = $id ");
    if(mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
        $observacion = $row['observaciones'];
        $historial = "$observacion \nElimino: $usuarioN $usuarioP $fechaFo";
    } else {
        $historial = "Elimino: $usuarioN $usuarioP $fechaFo";
    }

    $query = mysqli_query($conexion, "UPDATE `fa_asignaciones` SET observaciones = '$historial', estatus_a = 2  WHERE fa_idAsignacion = $id ");
    if ($query) {
        $_SESSION['msg'] = 'Eliminado correctamente';
        header('location:listadoAsignaciones.php');
    } else {
        $_SESSION['msg'] = 'No se pudo eliminar';

    }
}
