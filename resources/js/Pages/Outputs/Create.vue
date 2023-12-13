<template>
    <div>
      <Head title="Outputs - Criar"/>
      <AuthenticatedLayout>
        <OutputsForm :isEditing="false" />
      </AuthenticatedLayout>
    </div>
  </template>
  
  <script setup>
  import { reactive } from 'vue'
  import { router } from '@inertiajs/vue3'
  import { Head } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Swal from 'sweetalert2';
  import OutputsForm from './OutputsForm.vue';
  
  const form = reactive({
    marca: '',
    tipo: '',
    quantidade: 0,
    data_saida_produto: ''
  })
  
  function submit() {
    axios.post('/outputs', form)
    .then(response => {
      Swal.fire({
        icon: 'success',
        title: 'Produto cadastrado com sucesso!',
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        window.location.href = '/outputs';
      });
    })
    .catch(error => {
      console.error('Erro ao cadastrar produto de saída:', error);
      Swal.fire({
        icon: 'error',
        title: 'Erro ao cadastrar produto de saída',
        text: 'Por favor, tente novamente.',
      });
    });
  }
  
  function cancelSubmit() {
    router.get('/outputs')
  }
  
  </script>
  
  <style>
  
  
  </style>