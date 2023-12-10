<template>
  <div>
    <Head title="Appetizer - Editar"/>
    <AuthenticatedLayout>
      <AppetizerForm :isEditing="true" :initialData="appetizer" />
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { defineProps, ref, onMounted, reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import AppetizerForm from './AppetizerForm.vue';

const props = defineProps(['appetizer', 'appetizers']);
const appetizerSelecionada = ref(props.appetizer || null);

onMounted(() => {
  console.log('Componente montado. Valor de appetizerSelecionada:', appetizerSelecionada.value);
});

const editarAppetizer = () => {
  if (!appetizerSelecionada.value) {
    console.error('Nenhum produto selecionado para edição.');
    return;
  }

  axios.put(`appetizer/${appetizerSelecionada.value.id}`, appetizerSelecionada.value)
    .then(response => {
      Swal.fire({
        icon: 'success',
        title: 'Produto editado com sucesso!',
        showConfirmButton: false,
        timer: 1500,
      });
    })
    .catch(error => {
      console.error('Erro ao editar produto de entrada:', error);
      Swal.fire({
        icon: 'error',
        title: 'Erro ao editar produto de entrada',
        text: 'Por favor, tente novamente.',
      });
    });
};

function cancelSubmit() {
  router.get('/appetizer');
}
</script>

<style scoped>
/* Estilos CSS específicos para este componente */
</style>
