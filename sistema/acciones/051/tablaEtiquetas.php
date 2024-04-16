<?php
session_start();
if ($_SESSION['active'] !=  true) {
    session_destroy();
    header('location:../../../../index.php');
}
require '../../../conexion/conexion.php';

$columnas = [
    'fa_etiquetas.noSeguimiento', 'fa_etiquetas.cliente', 'fa_etiquetas.norma', 'fa_etiquetas.estatus', 'fa_etiquetas.asignado', 'fa_usuarios.id_usuario', 'fa_usuarios.fa_nombre', 'fa_usuarios.fa_apellido',
    'fa_etiquetas.id_etiquetas', 'fa_etiquetas.fechaRecepcion', 'fa_normas.id', 'fa_normas.norma', 'fa_etiquetas.fechaFinal'
];
$tabla = 'fa_etiquetas';
$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columnas);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columnas[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$sql = "SELECT " . implode(", ", $columnas) . "
FROM $tabla
INNER JOIN fa_usuarios ON fa_etiquetas.asignado = fa_usuarios.id_usuario
INNER JOIN fa_normas ON fa_etiquetas.norma = fa_normas.id
$where AND fa_etiquetas.estatus != 'Terminar Proceso' ORDER BY fa_etiquetas.fechaFinal DESC
";

$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;

$html = "";
if ($num_rows > 0) {
    $contador = 0;
    while ($row = $resultado->fetch_assoc()) {
        $contador += 1;
        $fechaFinal = $row['fechaFinal'];
        $fechaRecepcion = $row['fechaRecepcion'];

        $fecha = new DateTime($fechaFinal);
        $formateada = $fecha->format('d-m-Y');
        $hoy = date('Y-m-d');
        $html .= '<tr>
                    <td>' . $contador . '</td>
                    <td>' . $row['noSeguimiento'] . '</td>
                    <td>' . $row['cliente'] . '</td>
                    <td>' . $row['norma'] . '</td>
                    <td>' . $row['estatus'] . '</td>
                    <td>' . $row['fa_nombre'] . ' ' . $row['fa_apellido'] . '</td>';
        if ($fechaFinal == $hoy) {
            $html .= '<td style="background:red; color: black">' . $formateada . '</td>';
        } elseif ($hoy < $fechaFinal) {
            $html .= '<td style="background:yellow; color: black">' . $formateada . '</td>';
        } elseif ($fechaRecepcion == $hoy) {
            $html .= '<td style="background:green; color: black">' . $formateada . '</td>';
        } else {
            $html .= '<td style="background:gray; color: black">' . $formateada . '</td>';
        }
        $html .= '   <td>
                        <form action="editarEtiqueta.php" method="post">
                            <input type="hidden" name="idEtiqueta" value=' . $row['id_etiquetas'] . '>
                            <center><button type="submit" class="btn btn-info"><i class="fa-solid fa-hand-pointer"></i></button></center>
                        </form>
                    </td>
                </tr>';
    }
} else {
    $html .= '<tr>
        <td colspan="7">Sin resultados</td>
    </tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
