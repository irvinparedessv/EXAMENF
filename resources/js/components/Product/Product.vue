<template>
  <div>
    <div class="container">
      <template v-if="!loading">
        <div class="row" v-if="!isaudi">
          <h1>Productos</h1>
          <!-- Form -->
          <div class="col-md-4 d-none">
            <input class="form-control" type="text" v-model="product.id" />
          </div>
          <div class="col-md-4 pt-3">
            <label>Nombre</label>
            <input class="form-control" type="text" v-model="product.nombre" />
          </div>
           <div class="col-md-4 pt-3">
            <label>Descripcion</label>
            <input class="form-control" type="text" v-model="product.direccion" />
          </div>
           <div class="col-md-4 pt-3">
            <label>Precio Unitario</label>
            <input class="form-control" type="number" v-model="product.precio_unitario" />
          </div>
           <div class="col-md-4 pt-3">
            <label>Existencia</label>
            <input class="form-control" type="number" v-model="product.existencia" />
          </div>
           <div class="col-md-4 pt-3">
            <label>Garantia/Meses </label>
            <input class="form-control" type="number" v-model="product.garantia" />
          </div>
          <div class="col-md-12 pt-3">
            <a href="#" class="btn btn-success" @click="save()">
              <i class="fa fa-save"></i> {{ textButton }}</a
            >
          </div>
        </div>
<div class="row">
          <!-- Table -->
          <product-table
            :data="products"
            :isaudi="isaudi"
            :headers="headers"
            @delete="deleteP($event)"
            @edit="edit($event)"
          />
        </div>
      </template>
      <template v-else>
        <alert />
      </template>
    </div>
  </div>
</template>

<script>
import ui from "../../libs/ui";
import Swal from "sweetalert2";

export default {
  data: () => {
    return {
      product: {
        nombre: "",
      },
      products: [],
      grades: [],
      headers: ["#", "Nombre","Precio","Descripcion","Garantia","Acciones"],
      textButton: "Guardar",
      loading: false,
    };
  },

  mounted() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.loading = true;

      let res = await axios.get("api/product");
      this.products = res.data.products;
      this.isaudi=res.data.isaudi;
      this.loading = false;
    },

    async save() {
      let res;
      switch (this.textButton) {
        case "Guardar":
          res = await axios.post("api/product", this.product).catch((e) => {
            ui.alert("Registro no pudo ser guardado correctamente.", "error");
          });

          if (res.data.message == "success") {
            this.products = res.data.products;
            ui.alert("Registro creado correctamente.");
          }
          break;
        case "Modificar":
          res = await axios
            .put(`api/product/${this.product.id}`, this.product)
            .catch((e) => {
              ui.alert(
                "Registro no pudo ser actualizado correctamente.",
                "error"
              );
            });

          if (res.data.message == "success") {
            ui.alert("Registro modificado correctamente.");
          }
          break;
      }
      this.initialize();
      this.cleanInputs();
    },

    edit(id) {
      this.product = this.products.find((product) => product.id == id);
      this.textButton = "Modificar";
    },

    async deleteP(id) {
      Swal.fire({
        title: "¿Estás seguro de eliminar este registro?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Confimar",
      }).then(async (result) => {
        if (result.isConfirmed) {
          const res = await axios.delete(`api/product/${id}`).catch((e) => {
            ui.alert("Registro no pudo ser eliminado correctamente.", "error");
          });

          if (res.data.message == "success") {
            ui.alert("Registro eliminado correctamente.");
            this.initialize();
            this.cleanInputs();
          }
        }
      });
    },

    cleanInputs() {
      this.product = {
        nombre: "",
        direccion: "",
        precio_unitario: "0.00",
      };
      this.textButton = "Guardar";
    },
  },
};
</script>

<style>
</style>
