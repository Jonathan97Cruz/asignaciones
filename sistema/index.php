<?php
session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location:/index.php');
}
require_once '../conexion/conexion.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones</title>
    <link rel="shortcut icon" href="../img/logo solo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../img/logo1.png" alt="Logo FS" width="150" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" href="#" aria-expanded="false"><i class="fa-solid fa-house-user"></i> Folios</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="importarFolios.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-file-invoice"></i> Ingreso de folios</a>
                            </li>
                            <li>
                                <a href="acciones/listaFolios.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-list-check"></i> Listado de folios</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a  href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-hand-pointer"></i> Asignaciones</a>
                        <ul class="dropdown-menu">
                            <li>
                                    <a href="acciones/inspectores/asignaciones.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-user-check"></i> Mis asignaciones</a>
                            </li>
                            <li>
                                <a href="index.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-file-invoice"></i> Ingreso de asignaciones</a>
                            </li>
                            <li>
                                <a href="acciones/listadoAsignaciones.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-list-check"></i> Listado de asignaciones</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page"><i class="fa-solid fa-users"></i> Inspectores</a>
                    </li>
                    <li class="nav-item">
                        <a href="../conexion/salir.php" class="nav-link active" aria-current="page"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i> Cerrar Sesión</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-5 my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <label style="color: white;">
                            <center><i class="fa-solid fa-user-tie"></i> Usuario</center><?php echo $_SESSION['fa_nombre'] . " " . $_SESSION['fa_apellido']; ?>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="col-12" style="padding: 10px;">
        <div class="card">
            <div class="card-header">
                <b><label><i class="fa-solid fa-file-import"></i> Importar datos de excel</label></b>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <input type="file" id="txt_archivo" class="form-control" accept=".xlsx, .xls">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success" style="width: 100%;" onclick="Cargar_Excel()"><i class="fa-solid fa-download"></i> Guardar excel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/088e094aa5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="funciones.js"></script>
</body>


</html>