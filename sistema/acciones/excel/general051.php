<?php
header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=Reporte_General_Etiquetas.xls');

include '../../../conexion/conexion.php';

$query = mysqli_query($conexion, "SELECT *
                    FROM fa_etiquetas
                    ORDER BY cliente ASC");
$result = mysqli_num_rows($query);
mysqli_error($conexion);
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<table border="1">
    <tr>
        <th>Fecha de Ingreso</th>
        <th>No. Seguimiento</th>
        <th>Asignado</th>
        <th>Cliente</th>
        <th>Norma</th>
        <th>Denominación</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Tipo de Servicio</th>
        <th>Revisión</th>
        <th>Costo</th>
        <th>Costo Documento</th>
        <th>Fecha Límite</th>
        <th>Estatus</th>
        <th>Observaciones</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($query)) {
        $norma = $row['norma'];
        $asignado = $row['asignado'];
        $user = mysqli_query($conexion, "SELECT fa_nombre, fa_apellido, id_usuario FROM fa_usuarios WHERE id_usuario = '$asignado' ");
        $userV = mysqli_num_rows($user);
        if ($userV > 0) {
            while ($b = mysqli_fetch_array($user)) {
                $super = mysqli_query($conexion, "SELECT norma, id FROM fa_normas WHERE id = '$norma' ");
                $superV = mysqli_num_rows($super);
                if ($superV > 0) {
                    while ($c = mysqli_fetch_array($super)) {
    ?>
                        <tr>
                            <td><?= $row['fechaRecepcion'] ?></td>
                            <td><?= $row['noSeguimiento'] ?></td>
                            <td><?= $b['fa_nombre'] . ' ' . $b['fa_apellido'] ?></td>
                            <td><?= $row['cliente'] ?></td>
                            <td><?= $c['norma'] ?></td>
                            <td><?= $row['denominacion'] ?></td>
                            <td><?= $row['marca'] ?></td>
                            <td><?= $row['modelo'] ?></td>
                            <td><?= $row['tipo'] ?></td>
                            <td><?= $row['revision'] ?></td>
                            <td><?= $row['precio'] ?></td>
                            <td><?= $row['costoDoc'] ?></td>
                            <td><?= $row['fechaFinal'] ?></td>
                            <td><?= $row['estatus'] ?></td>
                            <td><?= $row['observaciones'] ?></td>
                        </tr>
            <?php
                    }
                }
            }
        } else {
            ?>
            <tr>
                <td><?= $row['fechaRecepcion'] ?></td>
                <td><?= $row['noSeguimiento'] ?></td>
                <td><?= $b['fa_nombre'] . ' ' . $b['fa_apellido'] ?></td>
                <td><?= $row['cliente'] ?></td>
                <td><?= $c['norma'] ?></td>
                <td><?= $row['denominacion'] ?></td>
                <td><?= $row['marca'] ?></td>
                <td><?= $row['modelo'] ?></td>
                <td><?= $row['tipo'] ?></td>
                <td><?= $row['revision'] ?></td>
                <td><?= $row['precio'] ?></td>
                <td><?= $row['costoDoc'] ?></td>
                <td><?= $row['fechaFinal'] ?></td>
                <td><?= $row['estatus'] ?></td>
                <td><?= $row['observaciones'] ?></td>
            </tr>
    <?php
        }
    }

    ?>
</table>


</table>