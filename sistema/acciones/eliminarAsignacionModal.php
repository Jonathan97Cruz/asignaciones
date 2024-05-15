<div id="eliminarAsignacionModal" class="modal fade" tabindex="-1" aria-labelledby="eliminarAsignacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: red;"><i class="fas fa-search-plus"></i> Eliminar asignación</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="color: red; font-weight:bold;font-size:20px"><i class="fa-solid fa-circle-radiation"></i> ¿Deseas eliminar la asignación?</p>
            </div>
            <div class="modal-footer">
                <form action="eliminarAsignacion.php" method="POST">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cerrar</button>    
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar</button>
                </form>
            </div> 
        </div>
    </div>
</div>