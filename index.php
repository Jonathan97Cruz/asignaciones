<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones Inspeccion</title>
    <link rel="shortcut icon" href="img/logo solo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html{
            height: 100%;
        }
        body{
            background: linear-gradient(#00BCD4,#673AB7);
        }
    </style>
</head>
<body>
    <div class="container w-500 mt-5 rounded ">
        <div class="row align-items-stretch">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 rounded">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/2090887.jpg" class="img-fluid w-100 rounded" alt="Certificado_1" style="height: 580px;">
                        </div>
                        <div class="carousel-item">
                            <img src="img/2108006.jpg" class="img-fluid w-100 rounded" alt="Certificado_2" style="height: 580px;">
                        </div>
                        <div class="carousel-item">
                            <img src="img/task.jpg" class="img-fluid w-100 rounded" alt="Certificado_3" style="height: 580px;">
                        </div>
                        <div class="carousel-item">
                            <img src="img/hand_drawn_man_showing_checklist_illustration.jpg" class="img-fluid w-100 rounded" alt="Certificado_3" style="height: 580px;">
                        </div>
                        <div class="carousel-item">
                            <img src="img/list_icon_1.jpg" class="img-fluid w-100 rounded" alt="Certificado_3" style="height: 580px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 rounded">
                <img src="img/logo1.png" class="img-fluid" alt="LOGO FS">
                <center><b><h3>Bienvenido / Bienvenida</h3></b></center>
                <center><b><h3>"Asignaciones IC"</h3></b></center>
                <form action="conexion/login.php" method="POST">
                    <b><h5 for=""><i class="fas fa-child"></i> Usuario</h5></b>
                    <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Ingresa tu usuario" >
                    <b><h5><i class="fa-solid fa-key"></i> Contraseña</h5></b>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Ingresa tu contraseña" ><br>
                    <button class="btn btn-success" style="width: 100%;" id="ingresar" type="submit"><i class="fa-solid fa-person-walking-arrow-right"></i> Ingresar</button>
                </form>
                <p style="text-align: right; font-weight: bold; margin-top: 5px; ">V.1.0.0</p>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script>