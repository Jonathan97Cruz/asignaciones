let formulario = document.getElementById("etiquetaU");
formulario.addEventListener("submit", function(e) {
  e.preventDefault();
  var datos = new FormData(formulario);

  fetch("actualizarEtiqueta.php", {
    method: "POST",
    body: datos
  })
    .then(res => res.json())
    .then(data => {
      if (data != "error") {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Actualizado correctamente",
          confirmButtonText: "Aceptar",
          showConfirmButton: true,
          timer: 3500,
        });
      } else {
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Debe haber algún cambio o verifica que este todo correcto.",
          confirmButtonText: "Aceptar",
          showConfirmButton: true,
          timer: 4000,
        });
      }
    });
});