class HijosForm {
    constructor(opts) {
        this.$tieneHijos = $(opts.tieneHijos);
        this.$campoCantidad = $(opts.campoCantidad);
        this.$cantidad = $(opts.cantidad);
        this.$contenedor = $(opts.contenedor);
        this.$lista = $(opts.lista);
        this.$btnAgregar = $(opts.btnAgregar);

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

        // Solo validar cuando sí tiene hijos
        this.$cantidad.prop("required", tiene);
        this.$cantidad.prop("disabled", !tiene);
        if (tiene) {
            this.$cantidad.attr({ min: 1, max: 10 });
            if (!this.$cantidad.val()) this.$cantidad.val(1);

            // Si seleccionó que sí tiene, garantiza al menos un hijo visible
            if (this.$lista.children().length === 0) {
                this.addItem();
            }
            this.$cantidad.val(this.$lista.children().length);
        } else {
            // Oculto y deshabilitado: no participa en la validación HTML5
            this.$cantidad.removeAttr("min").removeAttr("max");
            this.$cantidad.val("");
            this.$lista.empty();
        }
    }


    buildItem(index, data = {}) {
        const row = $(`
        <tr class="hijo-item align-middle">
            <td>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input class="form-control" required pattern=".*\\S.*" placeholder="Nombre">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    <input class="form-control" required pattern=".*\\S.*" placeholder="Apellido paterno">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    <input class="form-control" required pattern=".*\\S.*" placeholder="Apellido materno">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    <input type="date" class="form-control" required>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm btn-eliminar-hijo">✖</button>
            </td>
        </tr>
    `);
        if (data.id) row.prepend('<input type="hidden">');
        this.setItemValues(row, index, data);
        return row;
    }



    setItemValues($row, index, data) {
        const inputs = $row.find("input");
        let offset = 0;
        if (data.id) {
            inputs.eq(0).attr("name", `EdadesHijos[${index}][id]`).val(data.id);
            offset = 1;
        }
        const fields = ["nombre", "apellido_paterno", "apellido_materno", "fecha_nacimiento"];
        fields.forEach((f, i) => {
            inputs.eq(offset + i).attr("name", `EdadesHijos[${index}][${f}]`).val(data[f] ?? "");
        });
    }


    syncCantidad() {
        const max = 10; // opcional: limita cantidad
        let cant = parseInt(this.$cantidad.val(), 10);

        if (isNaN(cant) || cant < 1) {
            cant = 1; // si dijo que tiene hijos, mínimo 1
        }

        cant = Math.min(cant, max);
        this.$cantidad.val(cant);

        while (this.$lista.children().length < cant) this.addItem();
        while (this.$lista.children().length > cant) this.$lista.children().last().remove();

        this.reindex();
    }

    addItem(data = {}) {
        const index = this.$lista.children().length;
        this.$lista.append(this.buildItem(index, data));
        this.$cantidad.val(this.$lista.children().length);
    }

    removeItem(e) {
        $(e.currentTarget).closest(".hijo-item").remove();
        this.reindex();

        if (this.$tieneHijos.val() === "1" && this.$lista.children().length === 0) {
            // No permitir 0 hijos cuando marcó que sí tiene
            this.addItem();
        }

        this.$cantidad.val(this.$lista.children().length);
    }

    reindex() {
        this.$lista.children().each((i, el) => {
            const $el = $(el);
            this.setItemValues($el, i, {
                id: $el.find('input[name$="[id]"]').val(),
                nombre: $el.find('input[name$="[nombre]"]').val(),
                apellido_paterno: $el.find('input[name$="[apellido_paterno]"]').val(),
                apellido_materno: $el.find('input[name$="[apellido_materno]"]').val(),
                fecha_nacimiento: $el.find('input[name$="[fecha_nacimiento]"]').val(),
            });
        });
    }

    validate() {
        let ok = true;
        this.$lista.children().each((_, el) => {
            $(el).find("input").each((__, input) => {
                const val = input.value.trim();
                if (!val) {
                    ok = false;
                    input.focus();
                    return false; // break interno
                }
            });
            if (!ok) return false; // break externo
        });
        return ok;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const formEl = document.querySelector("form");
    const hijos = new HijosForm({
        tieneHijos: "#aluminfohijos-tiene_hijos",
        campoCantidad: "#campo-cantidad-hijos",
        cantidad: "#aluminfohijos-cantidad_hijos",
        contenedor: "#contenedor-hijos",
        lista: "#lista-hijos",
        btnAgregar: "#btn-agregar-hijo",
    });

    if (formEl) {
        formEl.addEventListener("submit", e => {
            if (!hijos.validate()) {
                e.preventDefault();
            }
        });
    }
});
