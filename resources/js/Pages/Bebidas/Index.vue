<template>
  <Head title="Bebidas"/>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bebidas</h2>
    </template>
    <div class="mt-4 mx-auto w-1/2">
      <form @submit.prevent="filtrarBebidas" method="post" class="w-1/4">
        <div class="flex space-x-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Marca</label>
            <input v-model="filtros.marca" type="text" class="mt-1 p-2 border rounded-md">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Tipo</label>
            <input v-model="filtros.tipo" type="text" class="mt-1 p-2 border rounded-md">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Preço</label>
            <input v-model="filtros.preco" type="text" class="mt-1 p-2 border rounded-md">
          </div>
          <div>
            <button type="submit" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded">
              Filtrar
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="py-12">
      <table class="w-3/4 divide-y divide-gray-200 mx-auto">
        <thead class="bg-gray-50">
          <button @click="abrirFormularioAdicao" class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
          <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Adicionar Bebida
        </button>
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
            <th class="px-6 py-3">Ações</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="bebida in bebidas" :key="bebida.id">
            <td class="px-6 py-4 whitespace-nowrap">{{ bebida.marca }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ bebida.tipo }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ bebida.preco }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
              <button @click="editarBebida(bebida)" class="text-green-600 hover:text-indigo-900"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
              </svg>
              Editar
            </button>
              <button @click="excluirBebida(bebida)" class="text-red-600 hover:text-red-900 ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
              </svg>
              Excluir</button>
            </td>
          </tr>            
        </tbody>
      </table>

      <div v-if="bebidaSelecionada" class="fixed inset-0 flex items-center justify-center">
        <div class="bg-gray-200 p-8 rounded-md shadow-lg w-1/2 h-1/2">
          <h3 class="text-lg font-semibold">Editar Bebida</h3>
          <form class="mt-4" @submit.prevent="editarBebida">
            <div>
              <label class="block text-sm font-medium text-gray-400">Marca</label>
              <input v-model="bebidaSelecionada.marca" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="mt-4">
              <label class="block text-sm font-medium text-gray-400">Tipo</label>
              <input v-model="bebidaSelecionada.tipo" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="mt-4">
              <label class="block text-sm font-medium text-gray-400">Preço</label>
              <input v-model="bebidaSelecionada.preco" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="mt-4 flex justify-end">
              <button type="button" class="mr-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" @click="fecharModal">Cancelar</button>
              <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import axios from 'axios';
import { defineProps, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3'

const props = defineProps({
  bebidas: {
    type: Array,
    required: true
  },
  bebida: String,
  filtros: {
    type: Object,
    required: true,
    default: () => ({ marca: '', tipo: '', preco: '' }),
  },
});

import Swal from 'sweetalert2';

function filtrarBebidas() {
  axios.post('bebidas/filters', props.filtros)
    .then(response => {
      // lógica após a resposta bem-sucedida
      Swal.fire({
        icon: 'success',
        title: 'Filtrado com sucesso!',
        showConfirmButton: false,
        timer: 1500, // Tempo em milissegundos para manter o alerta aberto
      });

      // Pode ser necessário recarregar os dados após o filtro
      // Você pode fazer isso chamando uma função para recarregar os dados da lista, por exemplo.
      // Exemplo: this.carregarBebidas();
    })
    .catch(error => {
      // lógica para lidar com erros
      console.error('Erro ao filtrar bebidas:', error);
      Swal.fire({
        icon: 'error',
        title: 'Erro ao filtrar bebidas',
        text: 'Por favor, tente novamente.',
      });
    });
}

const bebidaSelecionada = ref(null);

const fecharModal = () => {
  bebidaSelecionada.value = null;
};

function abrirFormularioAdicao(){
  router.get('bebidas/create')
};

const editarBebida = (bebida) => {
  bebidaSelecionada.value = bebida;
};

function excluirBebida(bebida){
   router.delete(`bebidas/${bebida.id}`)
};
</script>

<style scoped>
/* Estilos CSS específicos para este componente */
</style>
