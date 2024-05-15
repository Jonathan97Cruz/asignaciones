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
    <link rel="shortcut icon" href="../..//img/logo solo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet" />
</head>

<body>
    <?php
        include 'nav.php';
    ?>
    <div class="container">
        <div class="row align-items" style="padding-top: 10px;">
            <?php
            $id = $_POST['idAsignacion'];
            $consulta = mysqli_query($conexion, "SELECT * FROM fa_asignaciones WHERE fa_idAsignacion = '$id' ");
            $resultado = mysqli_num_rows($consulta);
            if ($resultado > 0) {
                while ($a = mysqli_fetch_array($consulta)) {
                    $asignador = $a["asignador"];
                    $inspector = $a['inspector'];
            ?>
                    <div class="col-12">
                        <form id="editar">
                            <div class="form-group row">
                                <?php
                                if ($_SESSION['fa_rol'] == 1 || $_SESSION['fa_rol'] == 2) {
                                ?>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-child"></i> Asignador</h5>
                                        <select class="form-select" name="asignador" id="">
                                            <?php
                                            $buscaAsig = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_rol, fa_estatus FROM fa_usuarios WHERE id_usuario = '$asignador' ORDER BY fa_nombre ASC");
                                            $buscaRes = mysqli_num_rows($buscaAsig);
                                            if ($buscaRes > 0) {
                                                while ($d = mysqli_fetch_array($buscaAsig)) {
                                            ?>
                                                    <option value="<?php echo $d['id_usuario'] ?>"><?php echo $d['fa_nombre'] . " " . $d['fa_apellido'] ?></option>
                                                <?php
                                                }
                                            }

                                            $asignador = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_rol, fa_estatus FROM fa_usuarios WHERE fa_rol = 2 ");
                                            $asignado = mysqli_num_rows($asignador);
                                            if ($asignado > 0) {
                                                while ($c = mysqli_fetch_array($asignador)) {
                                                ?>
                                                    <option value="<?php echo $c['id_usuario'] ?>"><?php echo $c['fa_nombre'] . " " . $c['fa_apellido'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="asignado "><i class="fas fa-child"></i> Asignado a</h5>
                                        <select class="form-select" name="asignado" id="">
                                            <?php
                                            $buscarAsignado = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_rol, fa_estatus FROM fa_usuarios WHERE id_usuario = '$inspector'");
                                            $buscarAsigRes = mysqli_num_rows($buscarAsignado);
                                            if ($buscarAsigRes > 0) {
                                                while ($e = mysqli_fetch_array($buscarAsignado)) {
                                            ?>
                                                    <option value="<?php echo $e['id_usuario'] ?>"><?php echo $e['fa_nombre'] . " " . $e['fa_apellido'] ?></option>
                                                <?php
                                                }
                                            }
                                            $inspector = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_user, fa_rol, fa_estatus FROM fa_usuarios WHERE fa_rol != 1 ORDER BY fa_nombre ASC");
                                            $resultadoI = mysqli_num_rows($inspector);
                                            if ($resultadoI > 0) {
                                                while ($b = mysqli_fetch_array($inspector)) {
                                                ?>
                                                    <option value="<?php echo $b['id_usuario'] ?>"><?php echo $b['fa_nombre'] . " " . $b['fa_apellido'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="cliente "><i class="fa-solid fa-handshake"></i> Cliente</h5>
                                        <input type="text" name="cliente" id="cliente" value="<?php echo $a['cliente'] ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="oficio "><i class="fa-solid fa-file-signature"></i> Oficio</h5>
                                        <input type="text" name="oficio" id="oficio" value="<?php echo $a['oficio'] ?>" class="form-control">
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="norma ">Norma</h5>
                                        <input type="text" name="norma" id="norma" value="<?php echo $a['norma'] ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="fechaRecepcion"><i class="fas fa-calendar-day"></i> Fecha recepción</h5>
                                        <input type="date" name="fechaRecepcion" value="<?php echo $a['fechaRecepcion'] ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="fechaAsignacion"><i class="fas fa-calendar-day"></i> Fecha asignación</h5>
                                        <?php
                                        if ($a['fechAsignacion'] != null && $a['fechAsignacion'] != '0000-00-00') {
                                        ?>
                                            <input type="date" name="fechaAsignacion" id="fechaAsignacion" class="form-control" value="<?php echo $a['fechAsignacion'] ?>">
                                        <?php
                                        } elseif ($a['fechAsignacion'] == null || $a['fechAsignacion'] == '0000-00-00') {
                                        ?>
                                            <input type="date" name="fechaAsignacion" id="fechaAsignacion" class="form-control" required>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-calendar-day"></i> Fecha límite</h5>
                                        <?php
                                        if ($a['fechaLimite'] == null) {
                                        ?>
                                            <input type="date" name="fechaLimite" id="" class="form-control" readonly>
                                        <?php
                                        } elseif ($a['fechaLimite'] != null) {
                                        ?>
                                            <input type="date" name="fechaLimite" id="" class="form-control" value="<?php echo $a['fechaLimite'] ?>" readonly>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fa-solid fa-hashtag"></i> Días transcurridos</h5><!--listo usuario-->
                                        <?php
                                        $hoy = date('Y-m-d');
                                        $fecha = $a['fechAsignacion'];
                                        $transcurrido = (strtotime($hoy) - strtotime($fecha)) / (60 * 60 * 24);
                                        if ($a['estatus'] == 'Finalizado') {
                                        ?>
                                            <input type="text" name="transcurrido" id="" value="<?php echo $a['transcurrido'] ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        } elseif ($a['estatus'] == 'Pendiente') {
                                        ?>
                                            <input type="text" name="transcurrido" value="<?php echo round($transcurrido) ?>" class="form-control" style="text-align: center;" readonly>
                                            <?php
                                        } elseif ($a['estatus'] == 'En proceso' || $a['estatus'] == 'En revisión') {
                                            if ($a['fechaEntrega'] != '0000-00-00' && $a['fechaEntrega'] != 'NULL') {
                                            ?>
                                                <input type="text" name="transcurrido" value="<?php echo $a['transcurrido'] ?>" class="form-control" style="text-align: center;" readonly>
                                            <?php
                                            } else {
                                            ?>
                                                <input type="text" name="transcurrido" value="<?php echo round($transcurrido) ?>" class="form-control" style="text-align: center;" readonly>
                                                
                                            <?php
                                            }
                                        } elseif ($fecha == null || $fecha == '0000-00-00') {
                                            ?>
                                            <input type="text" name="transcurrido" id="" value="<?php echo 0 ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        } // elseif ($a['transcurrido'] != 0) {
                                        ?>
                                        <!--<input type="text" name="transcurrido" value="<?php echo $a['transcurrido'] ?>" class="form-control" style="text-align: center;" readonly>-->
                                        <?php
                                        //} elseif($a['transcurrido'] == 0){
                                        ?>
                                        <!--  <input type="text" name="transcurrido" value="<?php echo round($transcurrido) ?>" class="form-control" style="text-align: center;" readonly>-->
                                        <?php
                                        //}
                                        ?>

                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-calendar-day"></i> Fecha entrega</h5>
                                        <?php
                                        if ($a['fechaEntrega'] != null && $a['fechaEntrega'] != '0000-00-00') {
                                        ?>
                                            <input type="date" name="fechaEntrega" id="" class="form-control" value="<?php echo $a['fechaEntrega'] ?>" readonly>
                                        <?php
                                        } else {
                                        ?>
                                            <input type="date" name="fechaEntrega" id="" class="form-control" readonly>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="estatus "><i class="fa-sharp fa-solid fa-square-check"></i> Estatus</h5>
                                        <?php
                                        if ($a['estatus'] == "Pendiente") {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: red; color:white">
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } elseif ($a['estatus'] == "Finalizado") {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: green; color:white">
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } elseif ($a['estatus'] == 'En proceso') {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: yellow; color:black">
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } elseif ($a['estatus'] == 'En revisión') {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: gray; color:white">
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } else {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select">
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fa-solid fa-hashtag"></i> Días Supervisor</h5>
                                        <?php
                                        if ($a['transcurridoU'] == 0) {
                                            $fechaS = $a['fechaEntrega'];
                                            if ($fechaS != null && $fechaS != '0000-00-00') {
                                                $transcurridoU = (strtotime($hoy) - strtotime($fechaS)) / (60 * 60 * 24);
                                            } else {
                                                $transcurridoU = 0;
                                            }

                                        ?>
                                            <input type="text" name="transcurridoU" id="" value="<?php echo $transcurridoU ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        } elseif ($a['transcurridoU'] != 0) {
                                        ?>
                                            <input type="text" name="transcurridoU" id="" value="<?php echo $a['transcurridoU'] ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="prioridad"><i class="fa-sharp fa-solid fa-square-check"></i> Prioridad</h5>
                                        <select name="prioridad" id="prioridad" class="form-select">
                                            <option value="<?php echo $a['prioridad'] ?>"><?php echo $a['prioridad'] ?></option>
                                            <option value="Normal">Normal</option>
                                            <option value="Urgente">Urgente</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-calendar-day"></i> Fecha Reasignación</h5>
                                        <?php
                                        if ($a['fechaReasignacion'] != null && $a['fechaReasignacion'] != '0000-00-00') {
                                        ?>
                                            <input type="date" name="fechaReasignacion" id="" class="form-control" value="<?php echo $a['fechaReasignacion'] ?>">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="date" name="fechaReasignacion" id="" class="form-control">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <h5 for="folios "><i class="fa-solid fa-file-signature"></i> Folios</h5>
                                        <textarea name="folios" id="folios" cols="30" rows="5" class="form-control"><?php echo $a['folios'] ?></textarea>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <h5 for="observaciones "><i class="fa-sharp fa-solid fa-arrows-to-eye"></i> Observaciones</h5>
                                        <textarea name="observaciones" id="observa" cols="30" rows="5" class="form-control"><?php echo $a['observaciones'] ?></textarea>
                                    </div>

                                <?php
                                } elseif ($_SESSION['idUsuario'] == 2) {
                                ?>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-child"></i> Asignador</h5>
                                        <select class="form-select" name="asignador" id="" disabled>
                                            <?php
                                            $buscaAsig = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_rol, fa_estatus FROM fa_usuarios WHERE id_usuario = '$asignador' ORDER BY fa_nombre ASC");
                                            $buscaRes = mysqli_num_rows($buscaAsig);
                                            if ($buscaRes > 0) {
                                                while ($d = mysqli_fetch_array($buscaAsig)) {
                                            ?>
                                                    <option value="<?php echo $d['id_usuario'] ?>"><?php echo $d['fa_nombre'] . " " . $d['fa_apellido'] ?></option>
                                                <?php
                                                }
                                            }

                                            $asignador = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_rol, fa_estatus FROM fa_usuarios WHERE fa_rol = 2 ");
                                            $asignado = mysqli_num_rows($asignador);
                                            if ($asignado > 0) {
                                                while ($c = mysqli_fetch_array($asignador)) {
                                                ?>
                                                    <option value="<?php echo $c['id_usuario'] ?>"><?php echo $c['fa_nombre'] . " " . $c['fa_apellido'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="asignado "><i class="fas fa-child"></i> Asignado a</h5>
                                        <select class="form-select" name="asignado" id="" disabled>
                                            <?php
                                            $buscarAsignado = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_rol, fa_estatus FROM fa_usuarios WHERE id_usuario = '$inspector'");
                                            $buscarAsigRes = mysqli_num_rows($buscarAsignado);
                                            if ($buscarAsigRes > 0) {
                                                while ($e = mysqli_fetch_array($buscarAsignado)) {
                                            ?>
                                                    <option value="<?php echo $e['id_usuario'] ?>"><?php echo $e['fa_nombre'] . " " . $e['fa_apellido'] ?></option>
                                                <?php
                                                }
                                            }
                                            $inspector = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_user, fa_rol, fa_estatus FROM fa_usuarios WHERE fa_rol = 3 OR fa_rol = 2 ORDER BY fa_nombre ASC");
                                            $resultadoI = mysqli_num_rows($inspector);
                                            if ($resultadoI > 0) {
                                                while ($b = mysqli_fetch_array($inspector)) {
                                                ?>
                                                    <option value="<?php echo $b['id_usuario'] ?>"><?php echo $b['fa_nombre'] . " " . $b['fa_apellido'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="cliente "><i class="fa-solid fa-handshake"></i> Cliente</h5>
                                        <input type="text" name="cliente" id="cliente" value="<?php echo $a['cliente'] ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="oficio"><i class="fa-solid fa-file-signature"></i> Oficio</h5>
                                        <input type="text" name="oficio" id="oficio" value="<?php echo $a['oficio'] ?>" class="form-control">
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="norma ">Norma</h5>
                                        <input type="text" name="norma" id="norma" value="<?php echo $a['norma'] ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="fechaRecepcion"><i class="fas fa-calendar-day"></i> Fecha recepción</h5>
                                        <input type="date" name="fechaRecepcion" value="<?php echo $a['fechaRecepcion'] ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="fechaAsignacion"><i class="fas fa-calendar-day"></i> Fecha asignación</h5>
                                        <?php
                                        if ($a['fechAsignacion'] != null) {
                                        ?>
                                            <input type="date" name="fechaAsignacion" id="fechaAsignacion" class="form-control" value="<?php echo $a['fechAsignacion'] ?>" readonly>
                                        <?php
                                        } elseif ($a['fechAsignacion'] == null) {
                                        ?>
                                            <input type="date" name="fechaAsignacion" id="fechaAsignacion" class="form-control" readonly>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-calendar-day"></i> Fecha Reasignación</h5>
                                        <?php
                                        if ($a['fechaReasignacion'] != null && $a['fechaReasignacion'] != '0000-00-00') {
                                        ?>
                                            <input type="date" name="fechaReasignacion" id="" class="form-control" value="<?php echo $a['fechaReasignacion'] ?>" readonly>
                                        <?php
                                        } else {
                                        ?>
                                            <input type="date" name="fechaReasignacion" id="" class="form-control" readonly>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-calendar-day"></i> Fecha límite</h5>
                                        <?php
                                        if ($a['fechaLimite'] == null) {
                                        ?>
                                            <input type="date" name="fechaLimite" id="" class="form-control" readonly>
                                        <?php
                                        } elseif ($a['fechaLimite'] != null) {
                                        ?>
                                            <input type="date" name="fechaLimite" id="" class="form-control" value="<?php echo $a['fechaLimite'] ?>" readonly>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fa-solid fa-hashtag"></i> Días transcurridos</h5><!--Listo admin-->
                                        <?php
                                        $hoy = date('Y-m-d');
                                        $fecha = $a['fechAsignacion'];
                                        $transcurrido = (strtotime($hoy) - strtotime($fecha)) / (60 * 60 * 24);
                                        if ($a['estatus'] == 'Finalizado') {
                                        ?>
                                            <input type="text" name="transcurrido" id="" value="<?php echo $a['transcurrido'] ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        } elseif ($a['estatus'] == 'Pendiente') {
                                        ?>
                                            <input type="text" name="transcurrido" value="<?php echo round($transcurrido) ?>" class="form-control" style="text-align: center;" readonly>
                                            <?php
                                        } elseif ($a['estatus'] == 'En proceso' || $a['estatus'] == 'En revisión') {
                                            if ($a['fechaEntrega'] != '0000-00-00' && $a['fechaEntrega'] != NULL) {
                                            ?>
                                                <input type="text" name="transcurrido" value="<?php echo $a['transcurrido'] ?>" class="form-control" style="text-align: center;" readonly>
                                            <?php
                                            } else {
                                            ?>
                                                <input type="text" name="transcurrido" value="<?php echo round($transcurrido) ?>" class="form-control" style="text-align: center;" readonly>
                                                
                                            <?php
                                            }
                                        } elseif ($fecha == null || $fecha == '0000-00-00') {
                                            ?>
                                            <input type="text" name="transcurrido" id="" value="<?php echo 0 ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        } // elseif ($a['transcurrido'] != 0) {
                                        ?>
                                        <!--<input type="text" name="transcurrido" value="<?php echo $a['transcurrido'] ?>" class="form-control" style="text-align: center;" readonly>-->
                                        <?php
                                        //} elseif($a['transcurrido'] == 0){
                                        ?>
                                        <!--  <input type="text" name="transcurrido" value="<?php echo round($transcurrido) ?>" class="form-control" style="text-align: center;" readonly>-->
                                        <?php
                                        //}
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fas fa-calendar-day"></i> Fecha entrega</h5>
                                        <?php
                                        if ($a['fechaEntrega'] != null && $a['fechaEntrega'] != '0000-00-00') {
                                        ?>
                                            <input type="date" name="fechaEntrega" id="" class="form-control" value="<?php echo $a['fechaEntrega'] ?>" readonly>
                                        <?php
                                        } else {
                                        ?>
                                            <input type="date" name="fechaEntrega" id="" class="form-control" readonly>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5><i class="fa-solid fa-hashtag"></i> Días Supervisor</h5>
                                        <?php
                                        if ($a['transcurridoU'] == 0) {
                                            $fechaS = $a['fechaEntrega'];
                                            if ($fechaS != null && $fechaS != '0000-00-00') {
                                                $transcurridoU = (strtotime($hoy) - strtotime($fechaS)) / (60 * 60 * 24);
                                            } else {
                                                $transcurridoU = 0;
                                            }

                                        ?>
                                            <input type="text" name="transcurridoU" id="" value="<?php echo $transcurridoU ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        } elseif ($a['transcurridoU'] != 0) {
                                        ?>
                                            <input type="text" name="transcurridoU" id="" value="<?php echo $a['transcurridoU'] ?>" class="form-control" style="text-align: center;" readonly>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="estatus "><i class="fa-sharp fa-solid fa-square-check"></i> Estatus</h5>
                                        <?php
                                        if ($a['estatus'] == "Pendiente") {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: red; color:white" disabled>
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } elseif ($a['estatus'] == "Finalizado") {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: green; color:white" disabled>
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } elseif ($a['estatus'] == 'En proceso') {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: yellow; color:black" disabled>
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } elseif ($a['estatus'] == 'En revisión') {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" style="background-color: gray; color:white" disabled>
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        } else {
                                        ?>
                                            <select name="estatus" id="estatus" class="form-select" disabled>
                                                <option value="<?php echo $a['estatus'] ?>"> <?php echo $a['estatus'] ?> </option>
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Finalizado">Finalizado</option>
                                            </select>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                        <h5 for="prioridad"><i class="fa-sharp fa-solid fa-square-check"></i> Prioridad</h5>
                                        <select name="prioridad" id="prioridad" class="form-select" disabled>
                                            <option value="<?php echo $a['prioridad'] ?>"><?php echo $a['prioridad'] ?></option>
                                            <option value="Normal">Normal</option>
                                            <option value="Urgente">Urgente</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <h5 for="folios ">Folios</h5>
                                        <textarea name="folios" id="folios" cols="30" rows="5" class="form-control"><?php echo $a['folios'] ?></textarea>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <h5 for="observaciones"><i class="fa-sharp fa-solid fa-arrows-to-eye"></i> Observaciones</h5>
                                        <textarea name="observaciones" id="observa" cols="30" rows="5" class="form-control"><?php echo $a['observaciones'] ?></textarea>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $a['fa_idAsignacion'] ?>">
                            <?php
                            if ($_SESSION['idUsuario'] == 2) {
                            ?>
                                <a href="listaFolios.php" class="btn btn-danger" style="padding: 10px; margin:5px;"><i class="fas fa-undo"></i> Regresar</a>
                            <?php
                            } elseif ($_SESSION['fa_rol'] == 1 || $_SESSION['fa_rol'] == 2) {
                            ?>
                                <a href="listadoAsignaciones.php" class="btn btn-danger" style="padding: 10px; margin:5px;"><i class="fas fa-undo"></i> Regresar</a>
                            <?php
                            }
                            ?>


                            <button type="submit" class="btn btn-warning" style="padding: 10px; margin:5px;"><i class="fas fa-check-circle"></i> Actualizar</button>
                        </form>
                    </div>

            <?php
                }
            }
            ?>
        </div>
    </div>



</body>
<script src="https://kit.fontawesome.com/7f41046fc7.js" crossorigin="anonymous"></script><!--Cuenta de sistemas2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="editar.js"></script>

</html>