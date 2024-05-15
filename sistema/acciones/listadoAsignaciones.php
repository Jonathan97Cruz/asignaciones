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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php
    include 'nav.php';
    ?>
    <div class="container">
        <div class="row" style="padding-top: 10px;">
            <div class="form-group row">
                <div class="col-sm-3">
                    <div class="card disenoC">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-check-circle"></i> Completados</h5>
                            <p class="card-text">
                                <?php
                                $general = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus_a != 2 ; ");
                                $completados = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'Finalizado' ");
                                echo $resultado = mysqli_num_rows($completados) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                            <center><a href="excel/completados.php" class="btn btn-info ancla"><i class="fa-solid fa-file-excel"></i> Generar excel</a></center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card disenoP">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-regular fa-clock"></i> Pendientes</h5>
                            <p class="card-text">
                                <?php
                                $pendientes = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'Pendiente' ");
                                echo $resultadoP = mysqli_num_rows($pendientes) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                            <center><a href="excel/pendientes.php" class="btn btn-info ancla"><i class="fa-solid fa-file-excel"></i> Generar excel</a></center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card disenoE">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-stopwatch"></i> En proceso</h5>
                            <p class="card-text">
                                <?php
                                $proceso = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'En proceso' ");
                                echo $procesoE = mysqli_num_rows($proceso) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                            <center><a href="excel/proceso.php" class="btn btn-info ancla"><i class="fa-solid fa-file-excel"></i> Generar excel</a></center>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card disenoR">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-spinner"></i> En revisión</h5>
                            <p class="card-text">
                                <?php
                                $revision = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'En revisión' ");
                                echo $revisionE = mysqli_num_rows($revision) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                            <center><a href="excel/revision.php" class="btn btn-info ancla"><i class="fa-solid fa-file-excel"></i> Generar excel</a></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-top: 10px;">
                <div class="form-group row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-bottom: 15px;">
                        <center><a style="margin-bottom: 10px;" href="excel/completo.php" class="btn btn-info ancla"><i class="fa-solid fa-file-excel"></i> Reporte General</a></center>
                        <a href="verCompletados.php" class="btn btn-secondary" style="display: inline-block; width:49%"><i class="fa-solid fa-eye"></i> Ver completados</a>
                        <button type="button" data-bs-target="#addAsignacionn" class="btn btn-success" style="display: inline-block; width:49%" data-bs-toggle="modal"><i class="fas fa-plus-circle"></i> Nueva solicitud</button>
                        <?php include "addAsignacionModal.php" ?>

                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-bottom: 15px;">
                        <form action="" method="post">
                            <h3 for="campo" class="etiqueta"><i class="fa-solid fa-magnifying-glass"></i> Busqueda </h3>
                            <input type="text" name="campo" id="campo" class="form-control" placeholder="Ingresa algún dato a buscar">
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <h2 class="titulo2"><i class="fa-solid fa-list-check"></i> Listado de Asignaciones</h2>
                        <thead>
                            <th class="pegajoso table-primary"><i class="fa-solid fa-handshake"></i> Cliente</th>
                            <th class="pegajoso table-primary"><i class="fa-solid fa-file-signature"></i> Oficio</th>
                            <th class="pegajoso table-primary"><i class="fa-solid fa-file-signature"></i> Folios</th>
                            <th class="pegajoso table-primary"><i class="fas fa-calendar-day"></i> Fecha asignación</th>
                            <th class="pegajoso table-primary"><i class="fas fa-child"></i> Asignado</th>
                            <th class="pegajoso table-primary"><i class="fa-sharp fa-solid fa-square-check"></i> Estatus</th>
                            <th class="pegajoso table-primary"><i class="fa-solid fa-location-arrow"></i> Acciones</th>
                        </thead>

                        <tbody id="content">

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
    <?php include 'eliminarAsignacionModal.php'; ?>
    <script>
        getData()
        document.getElementById("campo").addEventListener("keyup", getData)

        function getData() {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")
            let url = "busquedaEstatus.php"
            let formData = new FormData()
            formData.append('campo', input)
            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data
                })
                .catch(function(error) {
                    console.log(error)
                })
        };

        let elimina = document.getElementById('eliminarAsignacionModal');
        elimina.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            elimina.querySelector('.modal-footer #id').value = id
            console.log(id);
        });
    </script>
</body>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="agregar.js"></script>

</html>