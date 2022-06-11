<template>
  <div>
    <div class="container">
      <template v-if="!loading">
        <div class="row">
          <h1>registro</h1>
          <!-- Form -->
          <div class="col-md-4 d-none">
            <input class="form-control" type="text" v-model="vendedor.id" />
          </div>
          
               <div class="col-md-12 pt-3">
            <label>Correo</label>
            <input
              class="form-control"
              type="text"
              v-model="vendedor.email"
            />
               <div class="col-md-12 pt-3">
            <label>Nombre</label>
            <input
              class="form-control"
              type="text"
              v-model="vendedor.name"
            />
          </div>
              <div class="col-md-12 pt-3">
            <label>Contrasema</label>
            <input
              class="form-control"
              type="password"
              v-model="vendedor.password"
            />
          </div>
          <div class="col-md-12 pt-3">
            <label>DUI</label>
            <input
              class="form-control"
              type="text"
              v-model="vendedor.dui"
              v-mask="'########-#'"
            />
          </div>
          <div class="col-md-12 pt-3">
            <label>NIT</label>
            <input
              class="form-control"
              type="text"
              v-model="vendedor.nit"
              v-mask="'####-######-###-#'"
            />
          </div>
          <div class="col-md-12 pt-3">
            <label>Dirección</label>
            <textarea
              cols="12"
              rows="2"
              class="form-control"
              v-model="vendedor.direccion"
            />
          </div>
          <div class="col-md-12 pt-3">
            <a href="#" class="btn btn-success" @click="save()">
              <i class="fa fa-save"></i> {{ textButton }}</a
            >
          </div>

          
        </div>
        </div>
      </template>
      <template v-else>
        <alert />
      </template>
    </div>
  </div>
</template>

<script>
import ui from "../libs/ui";
import PaginationLaravel from "laravel-vue-pagination";
import Swal from "sweetalert2";

export default {
  components: { PaginationLaravel },
  data: () => {
    return {
      vendedor: {
        dui: "",
        nit: "",
        direccion:"",
        email:""
      },
      vendedors: [],
      grades: [],
     
      textButton: "Guardar",
      loading: false,
      pagination: {},
    };
  },

  mounted() {

  },

  methods: {



    async save() {
      let res;
      switch (this.textButton) {
        case "Guardar":
          res = await axios.post("api/user", this.vendedor).catch((e) => {
            ui.alert("Registro no pudo ser guardado correctamente.", "error");
          });

          if (res.data.message == "success") {
            this.vendedors = res.data.Vendedors;
            ui.alert("Registro creado correctamente.");

          }
          break;
        case "Modificar":
          res = await axios
            .put(`api/vendedor/${this.vendedor.id}`, this.vendedor)
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
   
      this.cleanInputs();
    },

    edit(id) {
      this.vendedor = this.vendedors.find((vendedor) => vendedor.id == id);
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
          const res = await axios.delete(`api/vendedor/${id}`).catch((e) => {
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
      this.vendedor = {};
      this.textButton = "Guardar";
    },

    async getResults(page = 1) {
      const res = await axios.get(this.pagination.path + "?page=" + page);
      this.vendedors = res.data.Vendedors.data;
      this.pagination = res.data.Vendedors;
    },
  },
};
</script>

<style>
</style>
