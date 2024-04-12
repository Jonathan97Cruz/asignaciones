<?php

session_start();
if( $_SESSION['active'] != true ){
    session_destroy();
    header("location:../../index.php");
}
require_once '../../conexion/conexion.php';

$idAsignacion = $_POST['idAsignacion'];
$asignado = $_POST['asignado'];
$cliente = $_POST['cliente'];
$oficio = $_POST['oficio'];
$norma = $_POST['norma'];
$estatus = $_POST['estatus'];
$prioridad = $_POST['prioridad'];
$folios = $_POST['folios'];
$observaciones = $_POST['observaciones'];
$fecha = (empty($_POST['fechaAsignacion'])) ? NULL : $_POST['fechaAsignacion'];
$fechaEntrega = (empty($_POST['fechaEntrega'])) ? '0000-00-00' : $_POST['fechaEntrega'];
$transcurrido = ( empty($_POST['transcurrido']) ) ? 0 : $_POST['transcurrido'];//1
$asignador = ( empty($_POST['asignador']) ) ? NULL : $_POST['asignador'];
$fechaReasignacion = (empty($_POST['fechaReasignacion'])) ? '0000-00-00' : $_POST['fechaReasignacion'];
$transcurridoU = (empty($_POST['transcurridoU'])) ? 0 : $_POST['transcurridoU'];

if($prioridad == 'Normal'){    
    $fechaLimite =  date('Y-m-d',strtotime($fecha."+ 3 days"));
}elseif($prioridad == 'Urgente'){
    $fechaLimite = date('Y-m-d',strtotime($fecha."+ 1 days"));
}

if( $estatus == 'Finalizado'){
    $fechaI = $fechaEntrega;
}elseif( $estatus == 'Pendiente' ){
    $fechaI = $fechaEntrega;
    $fechaEntrega = '0000-00-00';

}//elseif( $fechaReasignacion != NULL && $estatus == 'Pendiente' ) {
   // $transcurrido = 0;
//}


$actualizar = mysqli_query($conexion, " UPDATE `fa_asignaciones` 
                                        SET `oficio`='$oficio',`cliente`='$cliente',`folios`='$folios',`norma`='$norma',
                                        `fechAsignacion`='$fecha',`inspector`='$asignado',`estatus`='$estatus',`observaciones`='$observaciones',
                                        `prioridad`='$prioridad',`fechaLimite`='$fechaLimite', `fechaEntrega`= '$fechaEntrega',
                                        `transcurrido`= '$transcurrido',`asignador`='$asignador',`transcurridoU`='$transcurridoU', `fechaReasignacion` = '$fechaReasignacion', `fechaIngreso` = '$fechaI'
                                        WHERE `fa_idAsignacion`='$idAsignacion' ");

if($actualizar == true){
    echo json_encode('Correcto');
}else{
    echo json_encode('error');
}

