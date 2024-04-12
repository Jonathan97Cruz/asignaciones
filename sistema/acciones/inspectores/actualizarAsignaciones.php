<?php

session_start();
if( $_SESSION['active'] != true ){
    session_destroy();
    header("location:../../index.php");
}
require_once '../../../conexion/conexion.php';

$idAsignacion = $_POST['idAsignacion'];
$oficio = (empty($_POST['oficio'])) ? NULL : $_POST['oficio'];
$fecha = (empty($_POST['fechaEntrega'])) ? NULL : $_POST['fechaEntrega'];
$transcurridoU = ( empty($_POST['transcurridoU']) ) ? 0 : $_POST['transcurridoU'];
$estatus = (empty($_POST['estatus']))? NULL : $_POST['estatus'];
$folios = (empty($_POST['folios'])) ? NULL : $_POST['folios'];
$observaciones = (empty($_POST['observaciones'])) ? NULL : $_POST['observaciones'];

if($fecha != NULL && $estatus == 'En revisión'){
    $transcurrido = ( empty($_POST['transcurrido']) ) ? 0 : $_POST['transcurrido'];//1
    $transcurridoU;
}elseif($estatus == 'En proceso'){
    $transcurrido = ( empty($_POST['transcurrido']) ) ? 0 : $_POST['transcurrido'];//1
    $transcurrido;
}

$actualizar = mysqli_query($conexion, " UPDATE `fa_asignaciones` 
                                        SET `oficio`='$oficio',`folios`='$folios',`transcurridoU`='$transcurridoU',
                                        `estatus`='$estatus',`observaciones`='$observaciones',
                                        `transcurrido`= '$transcurrido',`fechaEntrega`='$fecha'
                                        WHERE `fa_idAsignacion`='$idAsignacion' ");

if($actualizar == true){
    echo json_encode('Correcto');
}else{
    echo json_encode('error');
}

