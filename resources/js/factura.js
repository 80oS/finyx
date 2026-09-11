const buscador = document.getElementById("cliente_busqueda");
const opciones = document.querySelectorAll(".cliente-opcion");
const nuevoCliente = document.getElementById("nuevo_cliente");
const idCliente = document.getElementById("id_cliente");

buscador.addEventListener("input", function () {
    const texto = this.value.toLowerCase().trim();

    let encontrado = false;

    opciones.forEach((opcion) => {
        const contenido = opcion.textContent.toLowerCase();

        if (contenido.includes(texto) && texto !== "") {
            opcion.classList.remove("hidden");
            encontrado = true;
        } else {
            opcion.classList.add("hidden");
        }
    });

    if (texto !== "" && !encontrado) {
        nuevoCliente.classList.remove("hidden");
    } else {
        nuevoCliente.classList.add("hidden");
    }
});

opciones.forEach((opcion) => {
    opcion.addEventListener("click", function () {
        idCliente.value = this.dataset.id;

        buscador.value = this.dataset.nombre;

        nuevoCliente.classList.add("hidden");
    });
});

// busqueda de productos por codigo de barras


