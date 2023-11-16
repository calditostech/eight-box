<template>
    <Head title="Bebidas"/>
    <AuthenticatedLayout>
    <template #header>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Adicionar Bebidas</h2>
</template>
<form class="mt-6" @submit.prevent="submit">
    <div class="mt-4 mx-auto w-1/2">
        <label class="block text-xs font-medium text-black-400">Marca</label>
        <input v-model="form.marca" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
    </div>
    <div class="mt-4 mx-auto w-1/2">
        <label class="block text-xs font-medium text-black-400">Tipo</label>
        <input v-model="form.tipo" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
    </div>
    <div class="mt-4 mx-auto w-1/2">
        <label class="block text-xs font-medium text-black-400">Preço</label>
        <input v-model="form.preco" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
    </div>
    <div class="mt-4 mx-auto w-1/2">
        <button type="button" class="mr-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" @click="cancelSubmit">Cancelar</button>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Salvar</button>
    </div>
</form>
</AuthenticatedLayout>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';

const form = reactive({
  marca: null,
  tipo: null,
  preco: null,
})

function submit() {
  axios.post('/bebidas', form)
  .then(response => {
    Swal.fire({
      icon: 'success',
      title: 'Bebida cadastrada com sucesso!',
      showConfirmButton: false,
      timer: 1500, // Tempo em milissegundos para manter o alerta aberto
    });
  })
  .catch(error => {
    console.error('Erro ao cadastrar bebibas bebidas:', error);
    Swal.fire({
      icon: 'error',
      title: 'Erro ao cadastrar bebidas',
      text: 'Por favor, tente novamente.',
    });
  });
}

function cancelSubmit() {
  router.get('/bebidas')
}
</script>

<style>


</style>