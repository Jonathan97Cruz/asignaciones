<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../../index.php');
}
require_once '../../../conexion/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones</title>
    <link rel="shortcut icon" href="../../../img/logo solo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="../css/estilos.css" rel="stylesheet" />
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
                                $usuario = $_SESSION['idUsuario'];
                                $general = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE inspector = '$usuario' ; ");
                                $completados = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'Finalizado' AND inspector = '$usuario' ");
                                echo $resultado = mysqli_num_rows($completados) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card disenoP">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-regular fa-clock"></i> Pendientes</h5>
                            <p class="card-text">
                                <?php
                                $pendientes = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'Pendiente' AND inspector = '$usuario' ");
                                echo $resultadoP = mysqli_num_rows($pendientes) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card disenoE">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-stopwatch"></i> En proceso</h5>
                            <p class="card-text">
                                <?php
                                $proceso = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'En proceso' AND inspector = '$usuario' ");
                                echo $procesoE = mysqli_num_rows($proceso) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card disenoR">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-spinner"></i> En revisión</h5>
                            <p class="card-text">
                                <?php
                                $revision = mysqli_query($conexion, "SELECT estatus FROM fa_asignaciones WHERE estatus = 'En revisión' AND inspector = '$usuario' ");
                                echo $revisionE = mysqli_num_rows($revision) . ' de ' . $generales = mysqli_num_rows($general);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-top: 10px;">
                <div class="form-group row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-bottom: 15px;">
                        <form action="" method="post">
                            <h3 for="campo" class="etiqueta"><i class="fa-solid fa-magnifying-glass"></i> Busqueda </h3>
                            <input type="text" name="campo" id="campo" class="form-control" placeholder="Ingresa algún dato a buscar">
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-bottom: 15px;">
                        <button type="button" data-bs-target="#addAsignacionn" class="btn btn-success ancla" data-bs-toggle="modal"><i class="fas fa-plus-circle"></i> Nueva solicitud</button>
                        <a href="verCompletadosU.php" class="btn btn-secondary" style="margin-top: 8px; display: inline-block; width:100%"><i class="fa-solid fa-eye"></i> Ver completados</a>
                        <?php include "addAsignacionModal.php" ?>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <h2 class="titulo2"><i class="fa-solid fa-list-check"></i> Listado de Asignaciones</h2>
                        <thead>
                            <th class="pegajoso table-primary"><i class="fa-solid fa-handshake"></i> Cliente</th>
                            <th class="pegajoso table-primary"><i class="fa-solid fa-file-signature"></i> Oficio</th>
                            <th class="pegajoso table-primary">NOM</th>
                            <th class="pegajoso table-primary"><i class="fas fa-calendar-day"></i> Fecha asignación</th>
                            <th class="pegajoso table-primary"><i class="fa-sharp fa-solid fa-square-check"></i> Estatus</th>
                            <th class="pegajoso table-primary"><i class="fa-solid fa-location-arrow"></i> Acciones</th>
                        </thead>

                        <tbody id="content">

                        </tbody>
                    </table>
                </div>
                <script>
                    getData()
                    document.getElementById("campo").addEventListener("keyup", getData)

                    function getData() {
                        let input = document.getElementById("campo").value
                        let content = document.getElementById("content")
                        let url = "busquedaInspecor.php"
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
                    }
                </script>

            </div>
        </div>
    </div>

</body>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="agregar.js"></script>

</html>