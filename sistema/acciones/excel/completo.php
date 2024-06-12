<?php
header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=Reporte_General.xls');

include '../../../conexion/conexion.php';

$query = mysqli_query($conexion, "SELECT *
                    FROM fa_asignaciones
                    WHERE estatus_a != 2
                    ORDER BY cliente ASC");
$result = mysqli_num_rows($query);
mysqli_error($conexion);
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<table border="1">
    <tr>
        <th>Asignador</th>
        <th>Oficio</th>
        <th>Cliente</th>
        <th>Folios</th>
        <th>Norma</th>
        <th>Fecha asignación</th>
        <th>Fecha limite</th>
        <th>Inspector</th>
        <th>Estatus</th>
        <th>Prioridad</th>
        <th>Observaciones</th>
        <th>Fecha recepción</th>
        <th>Transcurrido</th>
        <th>Fecha entrega</th>
        <th>Transcurrido supervisor</th>
        <th>Fecha reasignación</th>

    </tr>
    <?php
    while ($row = mysqli_fetch_array($query)) {
        $inspector = $row['inspector'];
        $asignador = $row['asignador'];
        $user = mysqli_query($conexion, "SELECT fa_nombre, fa_apellido, id_usuario FROM fa_usuarios WHERE id_usuario = '$inspector' ");
        $userV = mysqli_num_rows($user);
        if ($userV > 0) {
            while ($b = mysqli_fetch_array($user)) {
                $super = mysqli_query($conexion, "SELECT fa_nombre, fa_apellido, id_usuario FROM fa_usuarios WHERE id_usuario = '$asignador' ");
                $superV = mysqli_num_rows($super);
                if ($superV > 0) {
                    while ($c = mysqli_fetch_array($super)) {
    ?>
                        <tr>
                            <td><?= $c['fa_nombre'] . " " . $c['fa_apellido']; ?></td>
                            <td><?= $row['oficio']; ?></td>
                            <td><?= $row['cliente']; ?></td>
                            <td><?= $row['folios']; ?></td>
                            <?php
                            $extraerNorma = $row['norma'];
                            $arrayNorma = explode(',', $extraerNorma);
                            $stringNorma = implode(',', $arrayNorma);
                            $queryNorma = mysqli_query($conexion, 'SELECT id, norma FROM fa_normas WHERE id IN (' . $stringNorma . ')');
                            $array_name = [];
                            if (mysqli_num_rows($queryNorma) > 0) {
                                while ($a = mysqli_fetch_array($queryNorma)) {
                                    $array_name[] = $a["norma"];
                                }
                                $array_name_string = implode(", ", $array_name);
                            } else {
                                $array_name_string = NULL;
                            }

                            ?>
                            <td> <?php if ($array_name_string != NULL) {
                                        echo htmlspecialchars($array_name_string);
                                    } else {
                                        echo $extraerNorma;
                                    }
                                    ?>
                            </td>
                            <td><?= $row['fechAsignacion']; ?></td>
                            <td><?= $row['fechaLimite']; ?></td>
                            <td><?= $b['fa_nombre'] . " " . $b['fa_apellido']; ?></td><!--Inspector-->
                            <td><?= $row['estatus']; ?></td>
                            <td><?= $row['prioridad']; ?></td>
                            <td><?= $row['observaciones']; ?></td>
                            <td><?= $row['fechaRecepcion']; ?></td>
                            <td><?= $row['transcurrido']; ?></td>
                            <td><?php
                                if ($row['fechaEntrega'] != '0000-00-00' && $row['fechaEntrega'] != NULL) {
                                    echo $row['fechaEntrega'];
                                } else {
                                    echo $row['fechaIngreso'];
                                }

                                ?>
                            </td>
                            <td><?= $row['transcurridoU']; ?></td>
                            <td><?= $row['fechaReasignacion']; ?></td>
                        </tr>
            <?php
                    }
                }
            }
        } else {
            ?>
            <tr>
                <td><?= $row['asignador']; ?></td>
                <td><?= $row['oficio']; ?></td>
                <td><?= $row['cliente']; ?></td>
                <td><?= $row['folios']; ?></td>
                <td><?= $row['norma']; ?></td>
                <td><?= $row['fechAsignacion']; ?></td>
                <td><?= $row['fechaLimite']; ?></td>
                <td><?= $row['inspector']; ?></td><!--Inspector-->
                <td><?= $row['estatus']; ?></td>
                <td><?= $row['prioridad']; ?></td>
                <td><?= $row['observaciones']; ?></td>
                <td><?= $row['fechaRecepcion']; ?></td>
                <td><?= $row['transcurrido']; ?></td>
                <td><?= $row['fechaEntrega']; ?></td>
                <td><?= $row['transcurridoU']; ?></td>
                <td><?= $row['fechaReasignacion']; ?></td>
            </tr>
    <?php
        }
    }

    ?>
</table>


</table>