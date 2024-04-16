<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../../index.php');
}
require_once '../../../conexion/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>051</title>
    <link rel="shortcut icon" href="../../../img/logo solo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="../css/estilos.css" rel="stylesheet" />
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container">
        <div class="row">
            <div class="form-group row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-bottom: 15px; padding-top:15px">
                    <form action="" method="post">
                        <h3 for="campo" class="etiqueta"><i class="fa-solid fa-magnifying-glass"></i> Busqueda </h3>
                        <input type="text" name="campo" id="campo" class="form-control" placeholder="Ingresa algún dato a buscar">
                    </form>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-bottom: 5px; padding-top:5px">
                    <a href="agregar051.php" class="btn btn-primary" style="margin-top: 8px; display: inline-block; width:100%"><i class="fa-solid fa-eye"></i> Agregar asignación</a>
                    <a href="verCompletadosU.php" class="btn btn-success" style="margin-top: 8px; display: inline-block; width:100%"><i class="fa-solid fa-eye"></i> Ver completados</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered tanble-hover">
                    <h2 class="titulo2">Listado 051</h2>
                    <thead class="table-primary pegajoso">
                        <th>No</th>
                        <th>No consecutivo</th>
                        <th><i class="fa-solid fa-handshake"></i> Cliente</th>
                        <th>Norma</th>
                        <th><i class="fa-sharp fa-solid fa-square-check"></i> Estatus</th>
                        <th><i class="fa-sharp fa-solid fa-square-check"></i> Asignado</th>
                        <th><i class="fa-sharp fa-solid fa-calendar"></i> Fecha Límite</th>
                        <th><i class="fa-solid fa-location-arrow"></i> Acciones</th>
                    </thead>
                    <tbody id="contenido">

                    </tbody>
                </table>
            </div>
        </div>


    </div>

</body>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/busqueda.js"></script>
</html>