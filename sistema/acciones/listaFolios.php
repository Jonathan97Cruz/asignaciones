<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('Location: ../../index.php');
}
require_once '../../conexion/conexion.php';


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones</title>
    <link href="../../img/logo solo.jpg" rel="shortcut icon" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php
    include 'nav.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="table-responsive col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-top: 10px;">
                <table class="table table-bordered table-hover">
                    <h2 style="text-align: center;border: 2px solid blue; background-color: #81D4FA;   "><i class="fa-solid fa-list-check"></i> Folios Ingresados</h2>
                    <thead>
                        <th class="pegajoso table-primary"><i class="fa-solid fa-hashtag"></i> No. Folio</th>
                        <th class="pegajoso table-primary"><i class="fa-solid fa-handshake"></i> Cliente</th>
                        <th class="pegajoso table-primary">NOM</th>
                        <th class="pegajoso table-primary"><i class="fa-sharp fa-solid fa-square-check"></i> Estatus</th>
                        <th class="pegajoso table-primary"><i class="fas fa-calendar-day"></i> Fecha recepción</th>
                        <?php
                        if ($_SESSION['fa_rol'] == 1 || $_SESSION['fa_rol'] == 2) {
                        ?>
                            <th class="table-primary"><i class="fa-solid fa-location-arrow"></i> Acción</th>
                        <?php
                        }
                        ?>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = mysqli_query($conexion, "SELECT * FROM fa_asignaciones WHERE estatus_a != 2 ORDER BY cliente ASC");
                        $resultado = mysqli_num_rows($consulta);
                        if ($resultado > 0) {
                            while ($a = mysqli_fetch_array($consulta)) {
                        ?>
                                <tr class="">
                                    <?php
                                    if ($a['estatus'] == 'Recepción') {
                                    ?>
                                        <td><?php echo $a['folios']; ?></td>
                                        <td class=""><?php echo $a['cliente']; ?></td>
                                        <td class=""><?php echo $a['norma']; ?></td>
                                        <td class=""><?php echo $a['estatus']; ?></td>
                                        <td class=""><?php echo $a['fechaRecepcion']; ?></td>
                                        <?php
                                        if ($_SESSION['fa_rol'] == 1 || $_SESSION['fa_rol'] == 2) {
                                        ?>
                                            <td>
                                                <form action="editarAsignacion.php" method="POST">
                                                    <input type="hidden" value="<?php echo $a['fa_idAsignacion'] ?> " name="idAsignacion">
                                                    <center><button type="submit" class="btn btn-info"><i class="fa-solid fa-hand-pointer"></i></button></center>
                                                </form>
                                                <center><a href="" id="btnEnvia" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarAsignacionModal" data-bs-id="<?= $a['fa_idAsignacion'] ?>"><i class="fa-solid fa-user-slash"></i></a></center>
                                            </td>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'eliminarAsignacionModal.php'; ?>
    <script>
        let eliminarFolio = document.getElementById('eliminarAsignacionModal');
        eliminarFolio.addEventListener('shown.bs.modal', event => {
            let boton = event.relatedTarget;
            let id = boton.getAttribute('data-bs-id');
            eliminarFolio.querySelector('.modal-footer #id').value = id;
        });
    </script>

</body>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>