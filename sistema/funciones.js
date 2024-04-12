document.getElementById("txt_archivo").addEventListener("change", () => {
    var fileName = document.getElementById("txt_archivo").value; //capturo el archivo
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile == "xlsx" || extFile == "xls") {

    } else {
        Swal.fire("Mensaje de advertencia", "Solo se acpetan archivos con extensión .xlsx o .xls", "warning");
        document.getElementById("txt_archivo").value = "";
    }
});

function Cargar_Excel() {
    let archivo = document.getElementById('txt_archivo').value;
    if (archivo.length == 0) {
        return Swal.fire("Mensaje de advertencia", "Seleccione un archivo con extensión .xlsx o .xls", "warning");
    }
    let formData = new FormData();
    let excel = $("#txt_archivo")[0].files[0];
    formData.append('excel', excel);
    $.ajax({
        url: 'agregar.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(resp) {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Asignaciones Agregados Correctamente",
                confirmButtonText: "Aceptar",
                showConfirmButton: true,
                timer: 2500
            });
            //console.log('agregado');
        }
    });
    return false;
}


function Cargar_Folios(){
    let archivo = document.getElementById('txt_archivo').value;
    if(archivo.length == 0){
        return Swal.fire("Mensaje de advertencia", "Seleccione un archivo con extensión .xlsx o .xls", "warning");
    }
    let formData = new FormData();
    let excel = $("#txt_archivo")[0].files[0];
    formData.append('excel',excel);
    event.preventDefault();
    $.ajax({
        url: 'agregarFolios.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(resp){
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Folios Agregados Correctamente",
                confirmButtonText: "Aceptar",
                showConfirmButton: true,
                timer: 2500
            });
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error al procesar la solicitud',
                text: 'Ocurrió un error al intentar agregar los folios.',
                confirmButtonText: "Aceptar"
            });
        }
    });
    return false;
}



//setInterval(function(){
  //  location.href = location.href
//},1000*60);