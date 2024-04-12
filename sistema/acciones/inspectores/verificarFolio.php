<?php


include('../../../conexion/conexion.php');

$folio = $_POST['folios'];

$jsonData = array();
$select = ("SELECT folios FROM fa_asignaciones WHERE folios = '".$folio."' ");
$query = mysqli_query($conexion, $select);
$total = mysqli_num_rows($query);

if($total <= 0 ){
    $jsonData['success'] = 0;
    $jsonData['message'] = "";
}else{
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe el FOLIO <strong>('.$folio.')</strong> </p>';
}
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>