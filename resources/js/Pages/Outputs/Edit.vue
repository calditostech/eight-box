<template>
    <div>
      <Head title="Outputs - Editar"/>
      <AuthenticatedLayout>
        <OutputsForm :isEditing="true" :initialData="outputs" />
      </AuthenticatedLayout>
    </div>
  </template>
  
  <script setup>
  import { defineProps, ref, onMounted, reactive } from 'vue';
  import { Head, router } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import axios from 'axios';
  import Swal from 'sweetalert2';
  import OutputsForm from './OutputsForm.vue';
  
  const props = defineProps(['output', 'outputs']);
  const outputSelecionada = ref(props.outputs || null);
  
  onMounted(() => {
    console.log('Componente montado. Valor de outputSelecionada:', outputSelecionada.value);
  });
  
  const editarOutputs = () => {
    if (!outputSelecionada.value) {
      console.error('Nenhum produto selecionado para edição.');
      return;
    }
  
    axios.put(`outputs/${outputSelecionada.value.id}`, outputSelecionada.value)
      .then(response => {
        Swal.fire({
          icon: 'success',
          title: 'Produto editado com sucesso!',
          showConfirmButton: false,
          timer: 1500,
        });
      })
      .catch(error => {
        console.error('Erro ao editar produto de saída:', error);
        Swal.fire({
          icon: 'error',
          title: 'Erro ao editar produto de saída',
          text: 'Por favor, tente novamente.',
        });
      });
  };

  </script>
  
  <style scoped>
  /* Estilos CSS específicos para este componente */
  </style>
  