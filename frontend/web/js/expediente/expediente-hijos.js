class HijosForm {
    constructor(opts) {
        this.$tieneHijos = $(opts.tieneHijos);
        this.$campoCantidad = $(opts.campoCantidad);
        this.$cantidad = $(opts.cantidad);
        this.$contenedor = $(opts.contenedor);
        this.$lista = $(opts.lista);
        this.$btnAgregar = $(opts.btnAgregar);
        this.$btnSumar = $(opts.btnSumar);
        this.$btnRestar = $(opts.btnRestar);
        this.max = opts.max ?? 10;
        this.min = opts.min ?? 1;

        this.init();
    }

    init() {
        this.$tieneHijos.on("change", () => this.toggle());
        this.$btnAgregar.on("click", () => this.addItem());
        this.$lista.on("click", ".btn-eliminar-hijo", e => this.removeItem(e));
        this.$cantidad.on("input", () => this.syncCantidad());

        if (this.$btnSumar?.length) {
            this.$btnSumar.on("click", () => this.adjustCantidad(1));
        }
        if (this.$btnRestar?.length) {
            this.$btnRestar.on("click", () => this.adjustCantidad(-1));
        }

        this.toggle();
    }

    adjustCantidad(delta) {
        if (this.$campoCantidad.hasClass("d-none")) return;
        const current = parseInt(this.$cantidad.val(), 10) || this.min;
        const next = Math.min(this.max, Math.max(this.min, current + delta));
        this.$cantidad.val(next);
        this.syncCantidad();
    }

    toggle() {
        const tiene = this.$tieneHijos.val() === "1";
        this.$campoCantidad.toggleClass("d-none", !tiene);
        this.$contenedor.toggleClass("d-none", !tiene);

        this.$cantidad.prop("required", tiene);
        this.$cantidad.prop("disabled", !tiene);

        if (tiene) {
            const count = this.$lista.children().length || this.min;
            if (!this.$cantidad.val()) this.$cantidad.val(count);
            if (this.$lista.children().length === 0) {
                this.addItem();
            }
            this.syncCantidad();
        } else {
            this.$cantidad.val("");
            this.$lista.empty();
        }

        this.toggleButtons();
    }

    toggleButtons() {
        const count = parseInt(this.$cantidad.val(), 10) || 0;
        const hidden = this.$campoCantidad.hasClass("d-none");
        if (this.$btnRestar?.length) {
            this.$btnRestar.prop("disabled", hidden || count <= this.min);
        }
        if (this.$btnSumar?.length) {
            this.$btnSumar.prop("disabled", hidden || count >= this.max);
        }
    }

    buildItem(index, data = {}) {
        const $card = $(`
            <div class="col-12 hijo-item">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-info-subtle text-info hijo-index">Hijo #${index + 1}</span>
                            <button type="button" class="btn btn-outline-danger btn-sm btn-eliminar-hijo">
                                <i class="fas fa-trash"></i> Quitar
                            </button>
                        </div>
                        <input type="hidden" class="hijo-id-field">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">Nombre(s)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input class="form-control" data-field="nombre" required pattern=".*\\S.*" placeholder="Nombre(s)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">Apellido paterno</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <input class="form-control" data-field="apellido_paterno" required pattern=".*\\S.*" placeholder="Apellido paterno">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">Apellido materno</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <input class="form-control" data-field="apellido_materno" required pattern=".*\\S.*" placeholder="Apellido materno">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">Fecha de nacimiento</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" data-field="fecha_nacimiento" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
        this.setItemValues($card, index, data);
        return $card;
    }

    setItemValues($item, index, data) {
        $item.find(".hijo-index").text(`Hijo #${index + 1}`);

        const $id = $item.find(".hijo-id-field");
        if (data.id) {
            $id.attr("name", `EdadesHijos[${index}][id]`).val(data.id);
        } else {
            $id.removeAttr("name").val("");
        }

        $item.find("[data-field]").each((_, input) => {
            const field = input.dataset.field;
            $(input)
                .attr("name", `EdadesHijos[${index}][${field}]`)
                .val(data[field] ?? "");
        });
    }

    syncCantidad() {
        let cant = parseInt(this.$cantidad.val(), 10);
        if (isNaN(cant) || cant < this.min) cant = this.min;
        cant = Math.min(cant, this.max);
        this.$cantidad.val(cant);

        while (this.$lista.children().length < cant) this.addItem();
        while (this.$lista.children().length > cant) this.$lista.children().last().remove();

        this.reindex();
        this.toggleButtons();
    }

    addItem(data = {}) {
        const index = this.$lista.children().length;
        const $item = this.buildItem(index, data);
        this.$lista.append($item);
        this.$cantidad.val(this.$lista.children().length);
        this.toggleButtons();
    }

    removeItem(e) {
        $(e.currentTarget).closest(".hijo-item").remove();
        if (this.$tieneHijos.val() === "1" && this.$lista.children().length === 0) {
            this.addItem();
        }
        this.$cantidad.val(this.$lista.children().length || "");
        this.reindex();
        this.toggleButtons();
    }

    reindex() {
        this.$lista.children().each((i, el) => {
            const $el = $(el);
            this.setItemValues($el, i, {
                id: $el.find(".hijo-id-field").val(),
                nombre: $el.find('[data-field="nombre"]').val(),
                apellido_paterno: $el.find('[data-field="apellido_paterno"]').val(),
                apellido_materno: $el.find('[data-field="apellido_materno"]').val(),
                fecha_nacimiento: $el.find('[data-field="fecha_nacimiento"]').val(),
            });
        });
    }

    validate() {
        if (this.$tieneHijos.val() !== "1") return true;

        let ok = true;
        this.$lista.children().each((_, el) => {
            $(el).find("[data-field]").each((__, input) => {
                const val = input.value.trim();
                if (!val) {
                    ok = false;
                    input.focus();
                    return false;
                }
            });
            if (!ok) return false;
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
        btnSumar: "#btn-sumar-hijo",
        btnRestar: "#btn-restar-hijo",
        max: 10,
        min: 1,
    });

    if (formEl) {
        formEl.addEventListener("submit", e => {
            if (!hijos.validate()) {
                e.preventDefault();
            }
        });
    }
});
