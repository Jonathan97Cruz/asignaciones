<?php
session_start();

if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones IC</title>
    <link rel="shortcut icon" href="../../img/logo solo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../img/logo1.png" alt="Logo FS" width="150" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <?php
                    if ($_SESSION['fa_rol'] == 1 || $_SESSION['fa_rol'] == 2) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" href="#" aria-expanded="false"><i class="fa-solid fa-house-user"></i> Folios</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="../importarFolios.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-file-invoice"></i> Ingreso de folios</a>
                                </li>
                                <li>
                                    <a href="../acciones/listaFolios.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-list-check"></i> Listado de folios</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-hand-pointer"></i> Asignaciones</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="../acciones/inspectores/asignaciones.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-user-check"></i> Mis asignaciones</a>
                                </li>
                                <!--<li>
                                    <a href="../index.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-file-invoice"></i> Ingreso de asignaciones</a>
                                </li>-->
                                <li>
                                    <a href="../acciones/listadoAsignaciones.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-list-check"></i> Listado de asignaciones</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-hand-pointer"></i> Etiquetas</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="../acciones/051/index.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-user-check"></i> Revisión de etiquetas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-hand-pointer"></i> Otros</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="dropdown-item" aria-current="page"><i class="fa-solid fa-users"></i> Inspectores</a>
                            </li>
                            <li>
                                <a href="../normas/index.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-users"></i> Normas</a>
                            </li>
                            <li>
                                <a href="../clientes/index.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-users"></i> Clientes</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a href="../../conexion/salir.php" class="nav-link active" aria-current="page"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i> Cerrar Sesión</a>
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
    <div class="container">
        <div class="row">
            <div class="busqueda">
                <form action="" method="POST">
                    <h4 class="titulo" for="campo"><i class="fa-solid fa-magnifying-glass"></i>Busqueda</h4>
                    <input type="text" name="campo" id="campo" class="form-control" placeholder="Ingresa algun dato a buscar">
                </form>
                <button type="button" data-bs-target="#addUsuario" data-bs-toggle="modal" class="btn btn-success agregar"><i class="fas fa-plus-circle"></i> Agregar nuevo usuario</button>
                <?php
                if (isset($_SESSION['msg'])) {
                ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php
                    unset($_SESSION['msg']);
                }
                ?>

                <?php include 'addUsuarioModal.php' ?>
            </div>

            <div class="tabla table-responsive">
                <table class="table table-bordered table-hover">
                    <h2 class="titulo"><i class="fa-solid fa-users"></i> Usuarios</h2>
                    <thead>
                        <th class="table-primary th"><i class="fa-solid fa-signature"></i> Nombre</th>
                        <th class="table-primary th"><i class="fa-solid fa-user-tie"></i> Rol</th>
                        <th class="table-primary th"><i class="fa-solid fa-user"></i> Usuario</th>
                        <th class="table-primary th"><i class="fa-solid fa-gear"></i> Acciones</th>
                    </thead>
                    <tbody id="contenido">
                    </tbody>

                </table>
            </div>

            <script>
                getData();
                document.getElementById('campo').addEventListener("keyup", getData)

                function getData() {
                    let input = document.getElementById("campo").value;
                    let content = document.getElementById("contenido");
                    let url = "busquedaUsuario.php";
                    let formData = new FormData();
                    formData.append('campo', input);
                    fetch(url, {
                            method: "POST",
                            body: formData
                        }).then(response => response.json())
                        .then(data => {
                            content.innerHTML = data;
                        }).catch(function(error) {
                            console.log(error);
                        })
                }
            </script>
        </div>
    </div>

    <?php include 'editarUsuario.php'; ?>
    <?php include 'eliminarModal.php'; ?> 
    <script>
        let editarModal = document.getElementById('editaModal')
        let eliminaModal = document.getElementById('eliminarModal')

        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget //A que boton le estamos dando clic
            let id = button.getAttribute('data-bs-id')

            let inputId = editarModal.querySelector('.modal-body #idd')
            let inputNombre = editarModal.querySelector('.modal-body #nombre1')
            let inputApellido = editarModal.querySelector('.modal-body #apellido1')
            let inputUsuario = editarModal.querySelector('.modal-body #usuario1')
            let inputPassword = editarModal.querySelector('.modal-body #password1')
            let inputRol = editarModal.querySelector('.modal-body #roll')

            let url = "getUsuario.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    inputId.value = data.id_usuario
                    inputNombre.value = data.fa_nombre
                    inputApellido.value = data.fa_apellido
                    inputUsuario.value = data.fa_user
                    inputPassword.value = data.fa_password
                    inputRol.value = data.fa_rol

                }).catch(err => console.log(err))

        });

        eliminaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        });
    </script>
</body>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="agregarUsuario.js"></script>

</html>