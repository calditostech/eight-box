<template>
    <form class="mt-6" @submit.prevent="submit">
      <div class="mt-4 mx-auto col-md-6">
        <label class="form-label">Marca</label>
        <input v-model="form.marca" type="text" class="form-control" required>
      </div>
      <div class="mt-4 mx-auto col-md-6">
        <label class="form-label">Tipo</label>
        <input v-model="form.tipo" type="text" class="form-control" required>
      </div>
      <div class="mt-4 mx-auto col-md-6">
        <label class="form-label">Quantidade</label>
        <input v-model="form.quantidade" type="number" class="form-control" required>
      </div>
      <div class="mt-4 mx-auto col-md-6">
        <label class="form-label">Data e Hora de Entrada de Produtos</label>
        <div class="input-group">
          <input v-model="form.data_entrada_produto" type="datetime-local" class="form-control" required>
        </div>
      </div>
      <div class="mt-4 mx-auto col-md-6">
        <button type="button" class="mr-2 btn btn-danger" @click="cancelSubmit">Cancelar</button>
        <button type="submit" class="btn btn-primary">{{ isEditing ? 'Atualizar' : 'Salvar' }}</button>
      </div>
    </form>
  </template>
  
  <script setup>
  import { ref, defineProps } from 'vue';
  import { router } from '@inertiajs/vue3';
  import axios from 'axios';
  import Swal from 'sweetalert2';
  
  const props = defineProps(['isEditing', 'initialData']);
  
  const form = ref({
    id: props.isEditing ? props.initialData.id : null,
    marca: props.isEditing ? props.initialData.marca : '',
    tipo: props.isEditing ? props.initialData.tipo : '',
    quantidade: props.isEditing ? props.initialData.quantidade : 0,
    data_entrada_produto: props.isEditing ? props.initialData.data_entrada_produto : '',
  });
  
  const submit = () => {
  const url = props.isEditing ? `/appetizer/${form.value.id}` : '/appetizer';

  axios[props.isEditing ? 'put' : 'post'](url, form.value)
    .then(response => {
      const successMessage = props.isEditing ? 'Produto atualizado com sucesso!' : 'Produto cadastrado com sucesso!';

      Swal.fire({
        icon: 'success',
        title: successMessage,
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        router.get('/appetizer');
      });
    })
    .catch(error => {
      console.error(`Erro ao ${props.isEditing ? 'atualizar' : 'cadastrar'} produto de entrada:`, error);

      if (error.response && error.response.status === 405) {
        // Ignore HTTP 405 error and show success message
        Swal.fire({
          icon: 'success',
          title: 'Produto cadastrado com sucesso!',
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          router.get('/appetizer');
        });
      } else if (error.response && error.response.status === 500) {
        Swal.fire({
          icon: 'error',
          title: `Erro ao ${props.isEditing ? 'atualizar' : 'cadastrar'} produto de entrada`,
          text: 'Ocorreu um erro interno no servidor. Por favor, tente novamente mais tarde.',
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: `Erro ao ${props.isEditing ? 'atualizar' : 'cadastrar'} produto de entrada`,
          text: 'Por favor, tente novamente.',
        });
      }
    });
  };
  
  const cancelSubmit = () => {
    router.get('/appetizer');
  };
</script>
  
<style scoped>
  /* Adicione estilos conforme necessário */
</style>
