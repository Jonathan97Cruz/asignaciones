<div id="editarNorma" class="modal fade" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="actualizarDatosNorma.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-search-plus"></i> Editar norma</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <input type="hidden" id="idd" name="idd">
                            <div class="col-md-12">
                                <label class="edita" for="nombre"><i class="fa-solid fa-signature"></i> Nombre de la norma</label>
                                <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="Ingresa el nombre" required>
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