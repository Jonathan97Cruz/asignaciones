const boton = document.querySelector("#otraEtiqueta");
const input = document.querySelector("#etiquetaNueva");

boton.addEventListener("click", () => {
  const addInput = document.createElement("div");
  addInput.className = "row";

  addInput.innerHTML = `
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
            <label for="seguimiento">No. Seguimiento</label>
            <input type="text" name="seguimiento[]" id="seguimiento" placeholder="Ingresa el numero de seguimiento" class="form-control">
        </div>
        <div class="col-3">
            <label for="denominacion">Denominación</label>
            <input type="text" name="denominacion[]" id="denominacion" placeholder="Ingresa la denominación" class="form-control" required>
        </div>
        <div class="col-3">
            <label for="marca">Marca</label>
            <input type="text" name="marca[]" id="marca" placeholder="Ingresa la marca" class="form-control" required>
        </div>
        <div class="col-3">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo[]" id="modelo" placeholder="Ingresa el modelo" class="form-control">
        </div>
        <div class="col-3">
            <label for="tipo">Tipo de servicio</label>
            <select name="tipo[]" id="tipo" class="form-select">
                <option value="Constancia">Constancia</option>
                <option value="Dictamen">Dictamen</option>
                <option value="Diseño">Diseño</option>
            </select>
        </div>
        <div class="col-3">
            <label for="precio">Costo</label>
            <input type="number" name="precio[]" id="precio" step="0.01" class="form-control" placeholder="0.0">
        </div>
        <div class="col-3">
            <label for="revision">Revisión</label>
            <select name="revision[]" id="revision" class="form-select">
                <option value="1ra Revisión">1ra Revisión </option>
                <option value="2da Revisión">2ra Revisión</option>
                <option value="3ra Revisión">3ra Revisión</option>
                <option value="4ta Revisión">4ta Revisión</option>
                <option value="5ta Revisión">5ta Revisión</option>
            </select>
        </div>
        <div class="col-3">
            <label for="tiempo">Tiempo</label>
                <select name="tiempo[]" id="tiempo" class="form-select">
                    <option value="1">1 Día</option>
                    <option value="2">2 Días</option>
                    <option value="3">3 Días</option>
                    <option value="4">4 Días</option>
                    <option value="5">5 Días</option>
                    <option value="0">Otro</option>
                </select>
        </div>
        <div class="col-3" id="tiempoLibre">
            <label for="fechaLibre">Tiempo opcional(+6 Días)</label>
            <input type="number" name="fechaLibre[]" id="fechaLibre" placeholder="Ingresa el tiempo." class="form-control">
        </div>
        <div class="col-3">
            <label for="observacion">Observaciones</label>
            <textarea name="observacion[]" id="observacion" rows="1" class="form-control" placeholder="Ingresa tus observaciones"></textarea>
        </div><br>
        <hr/>
    `;
  input.appendChild(addInput);
});

//function mostrarDiv(){
//  const opcion = document.getElementById('tiempo').value;
//const agregar = document.querySelector('#tiempoLibre');
//if(opcion === 'otro'){
//  const crear = document.createElement('div');

//crear.innerHTML =
`
            <label for="fechaLibre">Tiempo opcional</label>
            <input type="text" name="fechaLibre" id="fechaLibre" placeholder="Ingresa el tiempo." class="form-control">
        `;
//agregar.appendChild(crear)
//}
//}
//var selectElement = document.getElementById('tiempo');
//selectElement.addEventListener('change', mostrarDiv);
