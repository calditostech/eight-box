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
        <label class="form-label">Data e Hora de Saída de Produtos</label>
        <div class="input-group">
          <input v-model="form.data_saida_produto" type="datetime" class="form-control" required>
        </div>
      </div>
      <div class="mt-4 mx-auto col-md-6">
        <button type="button" class="mr-2 btn btn-danger" style="background-color: red; color: white;" @click="cancelSubmit">Cancelar</button>
        <button type="submit" class="btn btn-primary" style="background-color: blue; color: white;">{{ isEditing ? 'Atualizar' : 'Salvar' }}</button>
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
    id: props.isEditing && props.initialData ? props.initialData.id : null,
    marca: props.isEditing && props.initialData ? props.initialData.marca : '',
    tipo: props.isEditing && props.initialData ? props.initialData.tipo : '',
    quantidade: props.isEditing && props.initialData ? props.initialData.quantidade : 0,
    data_saida_produto: props.isEditing && props.initialData ? props.initialData.data_saida_produto : '',
  });

  const submit = () => {
  const url = props.isEditing ? `/outputs/${form.value.id}` : '/outputs';

  axios[props.isEditing ? 'put' : 'post'](url, form.value)
    .then(response => {
      const successMessage = props.isEditing ? 'Produto atualizado com sucesso!' : 'Produto cadastrado com sucesso!';

      Swal.fire({
        icon: 'success',
        title: successMessage,
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        router.get('/outputs');
      });
    })
    .catch(error => {
      console.error(`Erro ao ${props.isEditing ? 'atualizar' : 'cadastrar'} produto de saída:`, error);

      if (error.response && error.response.status === 405) {
        Swal.fire({
          icon: 'success',
          title: 'Produto atualizado com sucesso!',
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          router.get('/outputs');
        });
      } else if (error.response && error.response.status === 500) {
        Swal.fire({
          icon: 'error',
          title: `Erro ao ${props.isEditing ? 'atualizar' : 'cadastrar'} produto de saída`,
          text: 'Ocorreu um erro interno no servidor. Por favor, tente novamente mais tarde.',
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: `Erro ao ${props.isEditing ? 'atualizar' : 'cadastrar'} produto de saída`,
          text: 'Por favor, tente novamente.',
        });
      }
    });
  };
  
  const cancelSubmit = () => {
    router.get('/outputs');
  };
</script>
  
<style scoped>
  /* Adicione estilos conforme necessário */
</style>
