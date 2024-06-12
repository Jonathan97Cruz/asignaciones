document.getElementById("cliente").addEventListener("keyup", getClientes);

function getClientes() {
  let inputC = document.getElementById("cliente").value;
  let lista = document.getElementById("lista");
  if (inputC.length > 0) {
    let url = "../getClientes.php";
    let formData = new FormData();

    formData.append("cliente", inputC);

    fetch(url, {
      method: "POST",
      body: formData,
      mode: "cors",
    })
      .then((response) => response.json())
      .then((data) => {
        lista.style.display = "block";
        lista.innerHTML = data;
      })
      .catch((err) => console.log(err));
  } else {
    lista.style.display = "none";
  }
}

function mostrar(cliente) {
  document.getElementById("cliente").value = cliente;
  lista.style.display = "none";
}