<?php

session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../../../../index.php');
}
require_once '../../conexion/conexion.php';

$oficio = (empty($_POST['oficio'])) ? NULL : $_POST['oficio']; //4
$cliente = (empty($_POST['cliente'])) ? NULL : $_POST['cliente']; //3
$folios = (empty($_POST['folios'])) ? NULL : $_POST['folios']; //10
$norma = (empty($_POST['norma'])) ? NULL : $_POST['norma']; //5
$fechAsignacion = (empty($_POST['fechAsignacion'])) ? NULL : $_POST['fechAsignacion']; //7
$usuario = (empty($_POST['usuario'])) ? NULL : $_POST['usuario']; //2
$estatus = (empty($_POST['estatus'])) ? NULL : $_POST['estatus']; //8
$observaciones = (empty($_POST['observaciones'])) ? NULL : $_POST['observaciones']; //11
$prioridad = (empty($_POST['prioridad'])) ? NULL : $_POST['prioridad']; //9
$fechaIngreso = (empty($_POST['fechaIngreso'])) ? NULL : $_POST['fechaIngreso']; //6


$hoy = date('Y-m-d');
if ($estatus == 'Pendiente' && $prioridad == 'Normal') {
    $fechaLimite = date('Y-m-d', strtotime($fechAsignacion . "+ 3 days"));
} elseif ($estatus == 'Pendiente' && $prioridad == 'Urgente') {
    $fechaLimite = date('Y-m-d', strtotime($fechAsignacion . "+ 1 days"));
}

$asignador = (empty($_POST['asignador'])) ? NULL : $_POST['asignador']; //1



$verifica = mysqli_query($conexion, "SELECT `folios` FROM `fa_asignaciones` WHERE `folios` LIKE '%$folios%' ");
if (mysqli_num_rows($verifica) > 0) {
    echo json_encode('error');
} else {
    $verificarCliente = mysqli_query($conexion, "SELECT * FROM fa_clientes WHERE cliente = '$cliente' ");
    if (mysqli_num_rows($verificarCliente) > 0) {
        while ($a = mysqli_fetch_array($verificarCliente)) {
            $idCliente = $a['id'];
        }
        $normas = implode(",", $norma);
        $sql = mysqli_query($conexion, "INSERT INTO  `fa_asignaciones`(`oficio`,`cliente`,`folios`,`norma`,`fechAsignacion`,`inspector`,`estatus`,`prioridad`,`fechaRecepcion`,`fechaIngreso`,`observaciones`,`fechaLimite`,`asignador`, `estatus_a`) 
            VALUES ('$oficio','$idCliente','$folios','$normas','$fechAsignacion','$usuario','$estatus','$prioridad','$hoy','$fechaIngreso','$observaciones','$fechaLimite','$asignador', 1)");
        if ($sql == true) {
            echo json_encode('Correcto');
        } else {
            echo json_encode('error');
        }
    } else {
        echo json_encode('error');
    }
}
