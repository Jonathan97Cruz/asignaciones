<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../index.php');
}
require '../../conexion/conexion.php';

$columnas = ['id_usuario', 'fa_nombre', 'fa_apellido', 'fa_user', 'fa_rol', 'fa_estatus'];
$tabla = 'fa_usuarios';
$busqueda = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;
$where = '';

if ($busqueda != null) {
    $where = 'WHERE (';
    $contador = count($columnas);
    for ($i = 0; $i < $contador; $i++) {
        $where .= $columnas[$i] . " LIKE '%" . $busqueda . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ')';
}

$sql = "SELECT " . implode(", ", $columnas) . "
        FROM $tabla 
        $where ORDER BY fa_nombre ASC ";

$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr class="tr">';
        if ($row['fa_rol'] == 2) {
            $html .= '<td>' . $row['fa_nombre'] . ' ' . $row['fa_apellido'] . '</td>';
            $html .= '<td>Administrador</td>';
            $html .= '<td>' . $row['fa_user'] . '</td>';
            $html .= '<td>
                            <a href="#" class="btn btn-warning boton" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id=' . $row['id_usuario'] . '><i class="fa-solid fa-pencil"></i> Editar</a>
                            <a href="#" id="btnEnvia" class="btn btn-danger botonE" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-id=' . $row['id_usuario'] . '><i class="fa-solid fa-user-slash"></i> Eliminar</a>
                      </td>';
        } elseif ($row['fa_rol'] == 3) {
            $html .= '<td>' . $row['fa_nombre'] . ' ' . $row['fa_apellido'] . '</td>';
            $html .= '<td>Inspector</td>';
            $html .= '<td>' . $row['fa_user'] . '</td>';
            $html .= '<td>
                            <a href="#" class="btn btn-warning boton" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id=' . $row['id_usuario'] . '><i class="fa-solid fa-pencil"></i> Editar</a>
                            <a href="#" id="btnEnvia" class="btn btn-danger botonE" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-id=' . $row['id_usuario'] . '><i class="fa-solid fa-user-slash"></i> Eliminar</a>
                      </td>';
        } elseif ($row['fa_rol'] == 4) {
            $html .= '<td>' . $row['fa_nombre'] . ' ' . $row['fa_apellido'] . '</td>';
            $html .= '<td>Folios</td>';
            $html .= '<td>' . $row['fa_user'] . '</td>';
            $html .= '<td>
                            <a href="#" class="btn btn-warning boton" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id=' . $row['id_usuario'] . '><i class="fa-solid fa-pencil"></i> Editar</a>
                            <a href="#" id="btnEnvia" class="btn btn-danger botonE" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-id=' . $row['id_usuario'] . '><i class="fa-solid fa-user-slash"></i> Eliminar</a>
                      </td>';
        }
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="4">Sin resultados</td></tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
