let formulario = document.getElementById("addNorm");
formulario.addEventListener("submit", function (e) {
  e.preventDefault();
  var datos = new FormData(formulario);

  fetch("insertarNorma.php", {
    method: "POST",
    body: datos,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data == "error") {
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: "Error al ingresar",
          confirmButtonText: "Error",
          showConfirmButton: true,
          timer: 2500,
        });
      } else {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Ingresado correctamente",
          confirmButtonText: "Aceptar",
          showConfirmButton: true,
          timer: 2500,
        });
      }
    });
});
