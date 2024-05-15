<?php

session_start();
if($_SESSION['active'] !=  true){
    session_destroy();
    header('location:../../../../../index.php');
}
require '../../../conexion/conexion.php';
$usuario = $_SESSION['idUsuario'];

$columns = ['fa_idAsignacion', 'oficio', 'cliente', 'norma', 'fechAsignacion', 'inspector', 'estatus','id_usuario','fa_nombre','fa_apellido','estatus_a'];
$table = "fa_asignaciones";
$campo = isset($_POST['campo']) ? $conexion->real_escape_string( $_POST['campo'] ) : null ;
$where = '';

if($campo != null){
    $where = "WHERE (";

    $cont = count($columns);
    for($i = 0; $i < $cont; $i++){
        $where .= $columns[$i] . " LIKE '%" . $campo ."%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}


$sql = "SELECT " . implode(", ", $columns ) . "
FROM $table
INNER JOIN fa_usuarios ON inspector = id_usuario
$where 
AND estatus != 'Finalizado'
AND inspector = '$usuario'
AND estatus_a != 2
ORDER BY fechAsignacion ASC
" ;

$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;

$html = '';
if($num_rows > 0){
    while($row = $resultado->fetch_assoc()){
        $html .= '<tr>';
        $html .= '<td>'.$row['cliente'].'</td>';
        $html .= '<td>'.$row['oficio'].'</td>';
        $html .= '<td>'.$row['norma'].'</td>';
        $html .= '<td>'.$row['fechAsignacion'].'</td>';
        
        if($row['estatus']=='Finalizado'){
            $html .= '<td style="background-color:green; color:black; ">'.$row['estatus'].'</td>';
        }elseif($row['estatus'] == 'Pendiente' ){
            $html .= '<td style="background-color:red; color:black;">'.$row['estatus'].'</td>';
        }elseif($row['estatus'] == 'En proceso' ){
            $html .= '<td style="background-color:yellow; color:black;">'.$row['estatus'].'</td>';
        }elseif($row['estatus'] == 'En revisión' ){
            $html .= '<td style="background-color:gray; color:black;">'.$row['estatus'].'</td>';
        }elseif($row['estatus'] == 'Recepción' ){
            $html .= '<td>'.$row['estatus'].'</td>';
        }
        
        $html .= '<td style="text-align:center;">
                    <form action="editarAsigna.php" method="POST">
                        <input type="hidden" value='. $row['fa_idAsignacion'] .' name="idAsignacion">
                        <button type="submit" class="btn btn-info"><i class="fa-solid fa-hand-pointer"></i></button>
                    </form> 
                </td>';
        $html .= '</tr>';
    }
}else{
    $html .= '<tr>';
    $html .= '<td colspan="6">Sin resultados</td>';
    $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
