class HijosForm {
    constructor(options) {
        this.$tieneHijos = $(options.tieneHijos);
        this.$campoCantidad = $(options.campoCantidad);
        this.$cantidad = $(options.cantidad);
        this.$contenedor = $(options.contenedor);
        this.$lista = $(options.lista);
        this.$btnAgregar = $(options.btnAgregar);

        this.init();
    }

    init() {
        this.$tieneHijos.on("change", () => this.toggle());
        this.$btnAgregar.on("click", () => this.addItem());
        this.$lista.on("click", ".btn-eliminar-hijo", e => this.removeItem(e));
        this.$cantidad.on("input", () => this.syncCantidad());

        this.toggle();
    }

    toggle() {
        const tiene = this.$tieneHijos.val() === "1";

        this.$campoCantidad.toggleClass("d-none", !tiene);
        this.$contenedor.toggleClass("d-none", !tiene);

        if (!tiene) {
            this.$lista.empty();
            this.$cantidad.val("");
        }
    }

    newItem(index, data = {}) {
        return `
        <div class="row g-3 border p-2 mb-2 hijo-item">
            ${data.id ? `<input type="hidden" name="EdadesHijos[${index}][id]" value="${data.id}">` : ""}

            <div class="col-md-3">
                <input class="form-control" name="EdadesHijos[${index}][nombre]" value="${data.nombre ?? ""}" placeholder="Nombre" required>
            </div>

            <div class="col-md-3">
                <input class="form-control" name="EdadesHijos[${index}][apellido_paterno]" value="${data.apellido_paterno ?? ""}" placeholder="Apellido paterno" required>
            </div>

            <div class="col-md-3">
                <input class="form-control" name="EdadesHijos[${index}][apellido_materno]" value="${data.apellido_materno ?? ""}" placeholder="Apellido materno" required>
            </div>

            <div class="col-md-2">
                <input type="date" class="form-control" name="EdadesHijos[${index}][fecha_nacimiento]" value="${data.fecha_nacimiento ?? ""}" required>
            </div>

            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm btn-eliminar-hijo">✖</button>
            </div>
        </div>
        `;
    }

    syncCantidad() {
        let cant = parseInt(this.$cantidad.val());
        if (isNaN(cant) || cant < 1) {
            this.$lista.empty();
            return;
        }

        while (this.$lista.children().length < cant)
            this.addItem();

        while (this.$lista.children().length > cant)
            this.$lista.children().last().remove();
    }

    addItem(data = {}) {
        const index = this.$lista.children().length;
        this.$lista.append(this.newItem(index, data));
        this.$cantidad.val(this.$lista.children().length);
    }

    removeItem(e) {
        $(e.currentTarget).closest(".hijo-item").remove();
        this.$cantidad.val(this.$lista.children().length);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new HijosForm({
        tieneHijos: "#aluminfohijos-tiene_hijos",
        campoCantidad: "#campo-cantidad-hijos",
        cantidad: "#aluminfohijos-cantidad_hijos",
        contenedor: "#contenedor-hijos",
        lista: "#lista-hijos",
        btnAgregar: "#btn-agregar-hijo",
    });
});
