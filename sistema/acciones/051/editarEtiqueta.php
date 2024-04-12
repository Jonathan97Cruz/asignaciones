<?php

use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Date;

session_start();
if ($_SESSION['active'] != true) {
    session_destroy();
    header('location: ../../../index.php');
}
require_once '../../../conexion/conexion.php';
$idEtiqueta = $_POST['idEtiqueta'];
$consulta = mysqli_query($conexion, "SELECT * FROM fa_etiquetas INNER JOIN fa_usuarios ON id_usuario = asignado  WHERE id = $idEtiqueta ");
$resultado = mysqli_num_rows($consulta);
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
            <form id="etiquetaU">
                <div class="form-group row">
                    <h2 class="titulo2">Editar etiqueta</h2>
                    <hr />
                    <?php
                    if ($resultado > 0) {
                        while ($b = mysqli_fetch_array($consulta)) {
                            $id = $b['id'];
                            $cliente = $b['cliente'];
                            $norma = $b['norma'];
                            $asignado = $b['asignado'];
                            $nombre = $b['fa_nombre'];
                            $apellido = $b['fa_apellido'];
                            $estatus = $b['estatus'];
                            $denominacion = $b['denominacion'];
                            $marca = $b['marca'];
                            $modelo = $b['modelo'];
                            $tipo = $b['tipo'];
                            $precio = $b['precio'];
                            $revision = $b['revision'];
                            $observacion = $b['observacion'];
                            $tiempo = $b['tiempo'];
                            $tiempoOp = $b['fechaLibre'];
                            $fechaRecepcion = $b['fechaRecepcion'];
                            $consecutivo = $b['noSeguimiento'];
                            $fechaFinal = $b['fechaFinal'];
                            $asignado2 = $b['asignado2'];
                            $observaciones = $b['observaciones'];
                        }
                    }
                    $recepcion = new DateTime($fechaRecepcion);
                    $formatear = $recepcion->format('d-m-Y H:i:s');
                    $final = new DateTime($fechaFinal);
                    $formatearFinal = $final->format('d-m-Y');
                    $norma = mysqli_query($conexion, "SELECT * FROM fa_normas WHERE id = '$norma' ");
                    $normaRe = mysqli_num_rows($norma);
                    if ($normaRe > 0) {
                        while ($c = mysqli_fetch_array($norma)) {
                            $normaSe = $c['norma'];
                        }
                    }
                    ?>
                    <div class="col-3">
                        <label for="recepcion">Fecha de recepción</label>
                        <input type="text" name="recepcion" id="recepcion" value="<?php echo $formatear ?>" class="form-control" readonly>
                    </div>
                    <div class="col-3">
                        <label for="consecutivo">No Seguimiento</label>
                        <input type="text" name="consecutivo" id="consecutivo" class="form-control" value="<?php echo $consecutivo ?>" readonly>
                    </div>
                    <div class="col-3">
                        <label for="cliente">Cliente</label>
                        <input type="text" name="cliente" id="cliente" placeholder="Ingresa el cliente" required class="form-control" value="<?php echo $cliente ?>" readonly>
                    </div>
                    <div class="col-3">
                        <label for="norma">Norma</label>
                        <input type="text" name="norma" id="norma" placeholder="Ingresar la norma" required class="form-control" value="<?php echo $normaSe ?>" readonly>
                    </div>
                    <div class="col-4">
                        <label for="asignado">Asignado</label>
                        <select name="asignado" id="asignado" class="form-control" disabled>
                            <option value="<?php echo $asignado ?>"><?php echo $nombre . " " . $apellido ?></option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="asignado2">2do Asignado</label>
                        <select name="asignado2" id="asignado2" class="form-select">
                            <?php
                            $query = mysqli_query($conexion, "SELECT * FROM fa_usuarios WHERE fa_rol = 5 AND id_usuario = $asignado2 ORDER BY fa_nombre ASC");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($a = mysqli_fetch_array($query)) {
                            ?>
                                    <option value="<?php echo $a['id_usuario'] ?>"><?php echo $a['fa_nombre'] . " " . $a['fa_apellido']; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="">Selecciona un usuario</option>
                                <?php
                            }
                            $demas = mysqli_query($conexion, "SELECT * FROM fa_usuarios WHERE fa_rol = 5 ORDER BY fa_nombre ASC");
                            $resul = mysqli_num_rows($demas);
                            if ($resul > 0) {
                                while ($c = mysqli_fetch_array($demas)) {
                                ?>
                                    <option value="<?php echo $c['id_usuario'] ?>"><?php echo $c['fa_nombre'] . " " . $c['fa_apellido']; ?></option>
                            <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="col-4">
                        <label for="estatus">Estatus</label>
                        <select name="estatus" id="estatus" class="form-select">
                            <option value="<?php echo $estatus ?>"><?php echo $estatus ?></option>
                            <option value="En Revisión">En Revisión</option>
                            <option value="Check Segundo Insp">Check Segundo Insp</option>
                            <option value="Correcciones Cliente">Correcciones Cliente</option>
                            <option value="Check Tercer Insp">Check Tercer Insp</option>
                            <option value="Constancia en Aprobación">Constancia en Aprobación</option>
                            <option value="Facturar">Facturar</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <h2 class="titulo2">Información de la etiqueta</h2>
                    </div>
                    <div class="col-3">
                        <label for="denominacion">Denominación</label>
                        <input type="text" name="denominacion" id="denominacion" placeholder="Ingresa la denominación" class="form-control" value="<?php echo $denominacion ?>">
                    </div>
                    <div class="col-3">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" id="marca" placeholder="Ingresa la marca" class="form-control" value="<?php echo $marca ?>">
                    </div>
                    <div class="col-3">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" id="modelo" placeholder="Ingresa el modelo" class="form-control" value="<?php echo $modelo ?>">
                    </div>
                    <div class="col-3">
                        <label for="tipo">Tipo de servicio</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
                            <option value="Constancia">Constancia</option>
                            <option value="Dictamen">Dictamen</option>
                            <option value="Diseño">Diseño</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="precio">Costo</label>
                        <input type="number" name="precio" id="precio" step="0.01" class="form-control" value="<?php echo $precio ?>">
                    </div>
                    <div class="col-3">
                        <label for="revision">Revisión</label>
                        <select name="revision" id="revision" class="form-select">
                            <option value="<?php echo $revision ?>"><?php echo $revision ?></option>
                            <option value="1ra Revisión">1ra Revisión </option>
                            <option value="2da Revisión">2ra Revisión</option>
                            <option value="3ra Revisión">3ra Revisión</option>
                            <option value="4ta Revisión">4ta Revisión</option>
                            <option value="5ta Revisión">5ta Revisión</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="tiempo">Tiempo</label>
                        <select name="tiempo" id="tiempo" class="form-select">
                            <option value="<?php echo $tiempo ?>"><?php echo $tiempo . ' día(s)' ?></option>
                            <option value="1">1 Día</option>
                            <option value="2">2 Días</option>
                            <option value="3">3 Días</option>
                            <option value="4">4 Días</option>
                            <option value="5">5 Días</option>
                            <option value="0">Otro</option>
                        </select>
                    </div>
                    <div class="col-3" id="tiempoLibre">
                        <label for="fechaLibre">Tiempo opcional(+6 Días)</label>
                        <?php
                        if ($tiempoOp == 0) {
                        ?>
                            <input type="number" name="fechaLibre" id="fechaLibre" placeholder="Ingresa el tiempo." class="form-control">
                        <?php
                        } else {
                        ?>
                            <input type="number" name="fechaLibre" id="fechaLibre" placeholder="Ingresa el tiempo." class="form-control" value="<?php echo $tiempoOp ?>">
                        <?php
                        }
                        ?>

                    </div>
                    <div class="col-3">
                        <label for="observacion">Observaciones</label>
                        <textarea name="observacion" id="observacion" rows="1" class="form-control" placeholder="Ingresa tus observaciones"><?php echo $observacion ?></textarea>
                    </div>
                    <div class="col-3">
                        <label for="fechaFinal">Fecha Límite</label>
                        <?php
                        $hoy = Date('Y-m-d');
                        $cambiar = new DateTime($hoy);
                        $compara = $cambiar->format('d-m-Y');
                        $formatear1 = $recepcion->format('d-m-Y');
                        if ($compara >= $formatearFinal) {
                        ?>
                            <input type="text" name="fechaFinal" id="fechaFinal" class="form-control" value="<?php echo $formatearFinal ?>" readonly style="background: red; color:azure">
                        <?php
                        } elseif ($compara < $formatearFinal) {
                        ?>
                            <input type="text" name="fechaFinal" id="fechaFinal" class="form-control" value="<?= $formatearFinal ?>" readonly style="background: yellow; color:black ">
                        <?php
                        } elseif($compara == $formatear1) {
                        ?>
                            <input type="text" name="fechaFinal" id="fechaFinal" class="form-control" value="<?php echo $formatearFinal ?>" readonly style="background: green;">
                        <?php
                        }

                        ?>
                    </div>
                    <div class="col-6">
                        <label for="observaciones">Historial</label>
                        <textarea class="form-control" name="observaciones" id="observaciones" rows="1" readonly><?php echo $observaciones; ?></textarea>
                        <input type="hidden" name="idEtiqueta" value="<?php echo $idEtiqueta ?>">
                    </div>
                    <br />
                    <hr />
                    <section class="col-12" id="etiquetaNueva">

                    </section>
                    <div class="col-12" style="padding-top: 10px;">
                        <a href="index.php" class="btn btn-danger">Regresar</a>
                        <button type="submit" class="btn btn-success">Editar etiqueta</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="js/acciones.js"></script>
<script src="editarE.js"></script>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>