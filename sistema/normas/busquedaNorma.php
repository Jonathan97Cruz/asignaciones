<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location:../../index.php');
}
require '../../conexion/conexion.php';

$columnas = ['id', 'norma', 'estatus'];
$tabla = 'fa_normas';
$busqueda = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;
$where = '';

if ($busqueda != null) {
    $where = 'WHERE (';
    $contador = count($columnas);
    for ($i = 0; $i < $contador; $i++) {
        $where .= $columnas[$i] . " LIKE '%" . $busqueda . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$sql = "SELECT " . implode(", ", $columnas) . "
        FROM $tabla
        $where
        ORDER BY norma ASC
        ";
$resultado = $conexion->query($sql);
$html = '';
$contadorColumnas = 0;
if($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $contadorColumnas += 1;
        $html .= '<tr class="tr">';
        $html .= '<td>'.$contadorColumnas .'</td>
                    <td>'.$row['norma'].'</td>
                  <td>
                    <a class="btn btn-warning boton" data-bs-toggle="modal" data-bs-target="#editarNorma" data-bs-id='.$row['id'].'><i class="fa-solid fa-pencil"></i> Editar</a>
                    <a class="btn btn-danger botonE" data-bs-toggle="modal" data-bs-target="#eliminarNormaModal" data-bs-id='.$row['id'].'><i class="fa-solid fa-user-slash"></i> Eliminar</a>
                  </td>  ';
        $html .= '</tr>';
    }
}else{
    $html .= '<tr><td colspan="2">Sin Resultados</td></tr>';
}
echo json_encode($html,JSON_UNESCAPED_UNICODE);
