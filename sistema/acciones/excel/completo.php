<?php
header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=Reporte_General.xls');

include '../../../conexion/conexion.php';

$query = mysqli_query($conexion, "SELECT *
                    FROM fa_asignaciones
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
        if($userV > 0){
            while($b = mysqli_fetch_array($user)){
                $super = mysqli_query($conexion, "SELECT fa_nombre, fa_apellido, id_usuario FROM fa_usuarios WHERE id_usuario = '$asignador' ");
                $superV = mysqli_num_rows($super);
                if($superV > 0){
                    while($c = mysqli_fetch_array($super)){
        ?>
                <tr>
                    <td><?php echo $c['fa_nombre']." ".$c['fa_apellido']; ?></td>
                    <td><?php echo $row['oficio']; ?></td>
                    <td><?php echo $row['cliente']; ?></td>
                    <td><?php echo $row['folios']; ?></td>
                    <td><?php echo $row['norma']; ?></td>
                    <td><?php echo $row['fechAsignacion']; ?></td>
                    <td><?php echo $row['fechaLimite']; ?></td>
                    <td><?php echo $b['fa_nombre']." ". $b['fa_apellido'] ; ?></td><!--Inspector-->
                    <td><?php echo $row['estatus']; ?></td>
                    <td><?php echo $row['prioridad']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['fechaRecepcion']; ?></td>
                    <td><?php echo $row['transcurrido']; ?></td>
                    <td><?php 
                        if($row['fechaEntrega'] != '0000-00-00' && $row['fechaEntrega'] != NULL){
                            echo $row['fechaEntrega'];     
                        }else{
                            echo $row['fechaIngreso']; 
                        }
                        
                        ?>
                    </td>
                    <td><?php echo $row['transcurridoU']; ?></td>
                    <td><?php echo $row['fechaReasignacion']; ?></td>
                </tr>
        <?php
                    }
                }
            }
        }else{
        ?>
                <tr>
                    <td><?php echo $row['asignador']; ?></td>
                    <td><?php echo $row['oficio']; ?></td>
                    <td><?php echo $row['cliente']; ?></td>
                    <td><?php echo $row['folios']; ?></td>
                    <td><?php echo $row['norma']; ?></td>
                    <td><?php echo $row['fechAsignacion']; ?></td>
                    <td><?php echo $row['fechaLimite']; ?></td>
                    <td><?php echo $row['inspector']; ?></td><!--Inspector-->
                    <td><?php echo $row['estatus']; ?></td>
                    <td><?php echo $row['prioridad']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['fechaRecepcion']; ?></td>
                    <td><?php echo $row['transcurrido']; ?></td>
                    <td><?php echo $row['fechaEntrega']; ?></td>
                    <td><?php echo $row['transcurridoU']; ?></td>
                    <td><?php echo $row['fechaReasignacion']; ?></td>
                </tr>
        <?php
        }
    }

    ?>
</table>


</table>