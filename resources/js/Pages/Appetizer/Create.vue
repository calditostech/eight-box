<template>
  <div>
    <Head title="Appetizer - Criar"/>
    <AuthenticatedLayout>
      <AppetizerForm :isEditing="false" />
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import AppetizerForm from './AppetizerForm.vue';

const form = reactive({
  marca: '',
  tipo: '',
  quantidade: 0,
  data_entrada_produto: ''
})

function submit() {
  axios.post('/appetizer', form)
  .then(response => {
    Swal.fire({
      icon: 'success',
      title: 'Produto cadastrado com sucesso!',
      showConfirmButton: false,
      timer: 1500,
    }).then(() => {
      window.location.href = '/appetizer';
    });
  })
  .catch(error => {
    console.error('Erro ao cadastrar produto de entrada:', error);
    Swal.fire({
      icon: 'error',
      title: 'Erro ao cadastrar produto de entrada',
      text: 'Por favor, tente novamente.',
    });
  });
}

function cancelSubmit() {
  router.get('/appetizer')
}

</script>

<style>


</style>