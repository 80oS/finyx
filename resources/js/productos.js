window.asignacionImpuesto = (urlProductos) => ({
    modo: "categoria",

    categoriaId: "",
    productoId: "",

    productos: [],
    cargando: false,

    cambiarModo(modo) {
        this.modo = modo;

        this.categoriaId = "";
        this.productoId = "";
        this.productos = [];
    },

    async cargarProductos() {
        this.productos = [];

        if (!this.categoriaId) return;

        this.cargando = true;

        try {
            const url = urlProductos.replace(
                "__ID__",
                encodeURIComponent(this.categoriaId),
            );

            const respuesta = await fetch(url, {
                headers: {
                    Accept: "application/json",
                },
            });

            if (!respuesta.ok) {
                throw new Error("No se pudieron cargar los productos");
            }

            this.productos = await respuesta.json();
        } catch (error) {
            console.error(error);
        } finally {
            this.cargando = false;
        }
    },
});
