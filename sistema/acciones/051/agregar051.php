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
            <form action="agregar/insertarEtiqueta.php" method="post">
                <div class="form-group row">
                    <h2 class="titulo2">Agregar etiqueta</h2>
                    <hr />
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="cliente">Cliente</label>
                        <input type="text" name="cliente" id="cliente" placeholder="Ingresa el cliente" required class="form-control">
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="norma">Norma</label>
                        <select name="norma" id="norma" class="form-select">
                            <?php
                            $norma = mysqli_query($conexion, "SELECT * FROM fa_normas WHERE estatus = 1");
                            $resultado = mysqli_num_rows($norma);
                            if ($norma > 0) {
                                while ($b = mysqli_fetch_array($norma)) {
                            ?>
                                    <option value="<?php echo $b['id']; ?>"><?php echo $b['norma'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="asignado">Asignado</label>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM fa_usuarios WHERE fa_rol = 5 ORDER BY fa_nombre ASC");
                        $result = mysqli_num_rows($query);
                        ?>
                        <select name="asignado" id="asignado" class="form-select">
                            <?php
                            if ($result > 0) {
                                while ($a = mysqli_fetch_array($query)) {
                            ?>
                                    <option value="<?php echo $a['id_usuario'] ?>"><?php echo $a['fa_nombre'] . " " . $a['fa_apellido']; ?></option>
                            <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="estatus">Estatus</label>
                        <select name="estatus" id="estatus" class="form-select">
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Revisión">En Revisión</option>
                            <option value="Check Segundo Insp">Check Segundo Insp</option>
                            <option value="Correcciones Cliente">Correcciones Cliente</option>
                            <option value="Check Tercer Insp">Check Tercer Insp</option>
                            <option value="Constancia en Aprobación">Constancia en Aprobación</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <h2 class="titulo2">Información de la etiqueta</h2>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="seguimiento">No. Seguimiento</label>
                        <input type="text" name="seguimiento[]" id="seguimiento" placeholder="Ingresa el numero de seguimiento" class="form-control">
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="denominacion">Denominación</label>
                        <input type="text" name="denominacion[]" id="denominacion" placeholder="Ingresa la denominación" class="form-control" required>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca[]" id="marca" placeholder="Ingresa la marca" class="form-control" required>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo[]" id="modelo" placeholder="Ingresa el modelo" class="form-control">
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="tipo">Tipo de servicio</label>
                        <select name="tipo[]" id="tipo" class="form-select">
                            <option value="En Revisión">En Revisión</option>
                            <option value="Constancia">Constancia</option>
                            <option value="Dictamen">Dictamen</option>
                            <option value="Diseño">Diseño</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="precio">Costo</label>
                        <input type="number" name="precio[]" id="precio" step="0.01" class="form-control" placeholder="0.0">
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="precioDocumento">Costo del documento</label>
                        <input type="number" name="precioDocumento[]" id="precioDocumento" step="0.01" class="form-control" placeholder="0.0">
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="revision">Revisión</label>
                        <select name="revision[]" id="revision" class="form-select">
                            <option value="1ra Revisión">1ra Revisión </option>
                            <option value="2da Revisión">2da Revisión</option>
                            <option value="3ra Revisión">3ra Revisión</option>
                            <option value="4ta Revisión">4ta Revisión</option>
                            <option value="5ta Revisión">5ta Revisión</option>
                            <option value="6ta Revisión">6ta Revisión</option>
                            <option value="7ma Revisión">7ma Revisión</option>
                            <option value="8va Revisión">8va Revisión</option>
                            <option value="9na Revisión">9na Revisión</option>
                            <option value="10ma Revisión">10ma Revisión</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="tiempo">Tiempo</label>
                        <select name="tiempo[]" id="tiempo" class="form-select">
                            <option value="1">1 Día</option>
                            <option value="2">2 Días</option>
                            <option value="3">3 Días</option>
                            <option value="4">4 Días</option>
                            <option value="5">5 Días</option>
                            <option value="0">Otro</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3" id="tiempoLibre">
                        <label for="fechaLibre">Tiempo opcional (+6 Días)</label>
                        <input type="number" name="fechaLibre[]" id="fechaLibre" placeholder="Ingresa el tiempo." class="form-control">
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <label for="observacion">Observaciones</label>
                        <textarea name="observacion[]" id="observacion" rows="1" class="form-control" placeholder="Ingresa tus observaciones"></textarea>
                    </div>
                    <br />
                    <hr />
                    <section class="col-12" id="etiquetaNueva">

                    </section>
                    <div class="col-12" style="padding-top: 10px;">
                        <a href="index.php" class="btn btn-danger">Regresar</a>
                        <button type="button" class="btn btn-info" id="otraEtiqueta">Agregar otra etiqueta</button>
                        <button type="submit" class="btn btn-success">Agregar etiqueta</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="js/acciones.js"></script>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>