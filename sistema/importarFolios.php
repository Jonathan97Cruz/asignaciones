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
</head>

<body>
    <?php
    include 'nav.php';
    ?>
    <div class="col-12" style="padding: 10px;">
        <div class="card">
            <div class="card-header">
                <b><label><i class="fa-solid fa-file-import"></i> Importar folios de excel</label></b>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <input type="file" id="txt_archivo" class="form-control" accept=".xlsx, .xls">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success" style="width: 100%;" onclick="Cargar_Folios()"><i class="fa-solid fa-download"></i> Guardar excel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://kit.fontawesome.com/088e094aa5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="funciones.js"></script>
</body>

</html>