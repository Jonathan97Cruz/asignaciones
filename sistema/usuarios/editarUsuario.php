<div id="editaModal" class="modal fade" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="actualizarDatosUsuario.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-search-plus"></i> Editar usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <input type="hidden" id="idd" name="idd">
                            <div class="col-md-6">
                                <label class="edita" for="nombre"><i class="fa-solid fa-signature"></i> Nombre(s)</label>
                                <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="Ingresa el nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="apellido"><i class="fa-solid fa-signature"></i> Apellido(s)</label>
                                <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="Ingresa los apellidos" required>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="usuario"><i class="fa-solid fa-user"></i> Usuario</label>
                                <input type="text" class="form-control" name="usuario1" id="usuario1" placeholder="Ingresa el usuario" required>
                                <div id="respuesta"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="password"><i class="fa-solid fa-key"></i> Contraseña</label>
                                <input type="password" class="form-control" id="password1" name="password1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="rol"><i class="fa-solid fa-user-tie"></i> Rol</label>
                                <select name="roll" id="roll" class="form-select">
                                    <option value="3">Inspector</option>
                                    <option value="4">Folios</option>
                                    <option value="2">Administrador</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnEditar"><i class="fas fa-folder-plus"></i> Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../../js/jquery-2.2.4.min.js" type="text/javascript"></script>

