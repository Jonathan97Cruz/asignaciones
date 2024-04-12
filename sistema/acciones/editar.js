
    let formulario = document.getElementById('editar');
    formulario.addEventListener('submit', function(e){
        e.preventDefault();//Evita que se ejecuta por default en el navegador
        var datos = new FormData(formulario);

        fetch('actualizarAsignacion.php', {
            method: 'POST',
            body: datos
        })
        .then(res => res.json())
        .then(data => {
            if(data === 'error'){
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Error al actualizar",
                    confirmButtonText: "Error",
                    showConfirmButton: true,
                    timer: 2500
                });
            }else{
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Actualizado correctamente",
                    confirmButtonText: "Aceptar",
                    showConfirmButton: true,
                    timer: 2500
                });
            }
        });
    });

