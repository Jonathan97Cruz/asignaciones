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
    <link rel="stylesheet" href="../usuarios/css/estilos.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="busqueda">
                <form action="" method="POST">
                    <h4 class="titulo" for="campo"><i class="fa-solid fa-magnifying-glass"></i>Busqueda</h4>
                    <input type="text" name="campo" id="campo" class="form-control" placeholder="Ingresa algun dato a buscar">
                </form>
                <button type="button" data-bs-target="#addNorma" data-bs-toggle="modal" class="btn btn-success agregar"><i class="fas fa-plus-circle"></i> Agregar nueva norma</button>
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

                <?php include 'addNormaModal.php' ?>
            </div>

            <div class="tabla table-responsive">
                <table class="table table-bordered table-hover">
                    <h2 class="titulo"><i class="fa-solid fa-users"></i> Normas</h2>
                    <thead>
                        <th class="table-primary th"><i class="fa-solid fa-signature"></i> ID</th>
                        <th class="table-primary th"><i class="fa-solid fa-signature"></i> Norma</th>
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
                    let url = "busquedaNorma.php";
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

    <?php
    include 'editarNorma.php';
    include 'eliminarModal.php'; 
    ?>
    <script>
        let editarModal = document.getElementById('editarNorma')
        let eliminaModal = document.getElementById('eliminarNormaModal')

        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget //A que boton le estamos dando clic
            let id = button.getAttribute('data-bs-id')

            let inputId = editarModal.querySelector('.modal-body #idd')
            let inputNombre = editarModal.querySelector('.modal-body #nombre1')

            let url = "getNorma.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {

                    inputId.value = data.id
                    inputNombre.value = data.norma

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
<script src="agregarNorma.js"></script>

</html>