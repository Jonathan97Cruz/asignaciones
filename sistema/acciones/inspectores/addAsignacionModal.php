<div id="addAsignacionn" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addAsignacionN">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: blue;"><i class="fas fa-search-plus" style="color: blue"></i> Nueva Solicitud</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <center><strong><label style="color: blue"><i class="fa-solid fa-file-signature"></i> Folios</label></strong></center>
                                <input class="form-control" name="folios" id="folios" placeholder="Ingresa los folios" required></input>
                                <div id="respuesta"></div>
                            </div>
                            <div class="col-md-6">
                                <center><strong><label style="color: blue"><i class="fas fa-child"></i> Asignador </label></strong></center>
                                <?php
                                $asignador = mysqli_query($conexion, "SELECT id_usuario, fa_nombre, fa_apellido, fa_rol, fa_estatus
                                                            FROM fa_usuarios
                                                            WHERE fa_estatus = 1
                                                            AND fa_rol = 2
                                                            ORDER BY fa_nombre ASC");
                                $asigna = mysqli_num_rows($asignador);
                                ?>
                                <select name="asignador" id="" class="form-select">
                                    <?php
                                    if ($asigna > 0) {
                                        while ($a = mysqli_fetch_array($asignador)) {
                                    ?>
                                            <option value="<?php echo $a['id_usuario'] ?>"><?php echo $a['fa_nombre'] . " " . $a['fa_apellido'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <center><strong><label style="color: blue"><i class="fas fa-child"></i> Asignado a </label></strong></center>
                                <select name="usuario" id="usuario" class="form-control">
                                    <option value="<?php echo $_SESSION['idUsuario'] ?>"><?php echo $_SESSION['fa_nombre'] . " " . $_SESSION['fa_apellido'] ?></option>
                                </select>
                            </div>
                            <div class="col-md-6"><!--Autocomplete de clientes-->

                                <center><strong><label style="color: blue"><i class="fa-solid fa-handshake"></i> Cliente</label></strong></center>
                                <input type="text" name="cliente" id="cliente" class="form-control" required autocomplete="off" placeholder="Ingresa el cliente">
                                <ul id="lista" style="list-style-type: none; width: 250px; height: auto; position: absolute; z-index: 5; padding: 5px;"></ul>

                            </div>
                            <div class="col-md-6">
                                <center><strong><label style="color: blue"><i class="fa-solid fa-file-signature"></i> Oficio</label></strong></center>
                                <input type="text" name="oficio" class="form-control" required placeholder="Ingresa el oficio">
                            </div>
                            <div class="col-md-12">
                                <center><strong><label style="color: blue">Norma</label></strong></center>
                                <select name="norma[]" id="" multiple class="form-select" size="2" required>
                                    <?php
                                    $query = mysqli_query($conexion, "SELECT * FROM fa_normas WHERE estatus != 2 ");
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($a = mysqli_fetch_array($query)) {
                                    ?>
                                            <option value="<?= $a['id'] ?>"><?= $a['norma'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <center><strong><label style="color: blue"><i class="fas fa-calendar-day"></i> Fecha Ingreso</label></strong></center>
                                <input type="date" name="fechaIngreso" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <center><strong><label style="color: blue"><i class="fas fa-calendar-day"></i> Fecha Asignación</label></strong></center>
                                <input type="date" name="fechAsignacion" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <center><strong><label style="color: blue"><i class="fa-sharp fa-solid fa-square-check"></i> Estatus</label></strong></center>
                                <select name="estatus" id="" class="form-select">
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Finalizado">Finalizado</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <center><strong><label style="color: blue"><i class="fa-sharp fa-solid fa-square-check"></i> Prioridad</label></strong></center>
                                <select name="prioridad" id="" class="form-select">
                                    <option value="Normal">Normal</option>
                                    <option value="Urgente">Urgente</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <center><strong><label style="color: blue"><i class="fa-sharp fa-solid fa-arrows-to-eye"></i> Observaciones</label></strong></center>
                                <textarea class="form-control" name="observaciones" id="" cols="30" rows="2" placeholder="Ingresa tus observaciones"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success" id="btnEnviar"><i class="fas fa-folder-plus"></i> Agregar</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/peticiones.js"></script>
<script src="../../../js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#folios").on("keyup", function() {
        var folios = $("#folios").val();
        var longitud = $("#folios").val().length;

        if (longitud >= 0) {
            var dataString = 'folios=' + folios;

            $.ajax({
                url: "verificarFolio.php",
                type: "POST",
                data: dataString,
                dataType: "JSON",

                success: function(datos) {
                    if (datos.success == 1) {
                        $("#respuesta").html(datos.message);
                        $("input#cedula").attr('disabled', false);
                        $("#btnEnviar").attr('disabled', true);
                    } else {
                        $("#respuesta").html(datos.message);
                        $("#btnEnviar").attr('disabled', false);
                    }
                }
            })
        }
    })
</script>