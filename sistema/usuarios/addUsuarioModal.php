<div id="addUsuario" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addUser">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-search-plus"></i> Nuevo usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="edita" for="nombre"><i class="fa-solid fa-signature"></i> Nombre(s)</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="apellido"><i class="fa-solid fa-signature"></i> Apellido(s)</label>
                                <input type="text" class="form-control" name="apellido" placeholder="Ingresa los apellidos" required>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="usuario"><i class="fa-solid fa-user"></i> Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingresa el usuario" required>
                                <div id="respuesta"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="password"><i class="fa-solid fa-key"></i> Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="edita" for="rol"><i class="fa-solid fa-user-tie"></i> Rol</label>
                                <select name="rol" id="" class="form-select">
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
                    <button type="submit" class="btn btn-success" id="btnEnviar"><i class="fas fa-folder-plus"></i> Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#usuario').on('keyup', function(){
        var usuario = $('#usuario').val();
        var longitud = $('#usuario').val().length;
        if(longitud > 0){
            var dataString = 'usuario=' + usuario;

            $.ajax({
                url:'verificarUsuario.php',
                type:'POST',
                data: dataString,
                dataType:'JSON',
                success:function(datos){
                    if(datos.success == 1){
                        $('#respuesta').html(datos.message);
                        $('#btnEnviar').attr('disabled',true);
                    }else{
                        $('#respuesta').html(datos.message);
                        $('#btnEnviar').attr('disabled',false);
                    }
                }

            })
        }
    })
</script>