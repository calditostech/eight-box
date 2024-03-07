<template>
  <Head title="Appetizer"/>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-56">Entrada de Produtos</h2>
    </template>
    <div class="py-12">
      <table class="w-3/3 divide-y divide-gray-200 mx-auto">
        <thead class="bg-gray-50">
          <button @click="abrirFormularioAdicao" class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
          <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Adicionar Produto
        </button>
          <button @click.prevent="visualizarPDF" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            Visualizar PDF
          </button>
          <button @click.prevent="baixarPDF" class="bg-purple-500 text-white px-4 py-2 rounded ml-4 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            Baixar PDF
          </button>
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data e Hora de Entrada de Produtos</th>
            <th class="px-6 py-3 text-right pr-4">Ações</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="appetizer in appetizers" :key="appetizer.id">
            <td class="px-6 py-4 whitespace-nowrap">{{ appetizer.marca }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ appetizer.tipo }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ appetizer.quantidade }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ appetizer.data_entrada_produto }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
              <button @click="editarAppetizer(appetizer)" class="text-green-600 hover:text-indigo-900"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
              </svg>
              Editar
            </button>
              <button @click="excluirAppetizer(appetizer)" class="text-red-600 hover:text-red-900 ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
              </svg>
              Excluir</button>
            </td>
          </tr>            
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { defineProps, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3'
import axios from 'axios';

const props = defineProps({
  appetizers: {
    type: Array,
    required: true
  },
  appetizer: String,
  filtros: {
    type: Object,
    required: true,
    default: () => ({ marca: '', tipo: '', quantidade: 0, data_entrada_produto: ''}),
  },
});

const appetizerSelecionada = ref(null);

function abrirFormularioAdicao(){
  router.get('appetizer/create')
};

function editarAppetizer(appetizer){
  router.get(`appetizer/${appetizer.id}/edit`,{
    params: {
      id: appetizer.id,
    },
    props: {
      appetizer: appetizer,
    },
  });
}

function excluirAppetizer(appetizer){
   router.delete(`appetizer/${appetizer.id}`)
};

function visualizarPDF() {
  router.post('/appetizers/view-pdf').then(() => {
  }).catch((error) => {
    console.error('Erro ao visualizar o PDF:', error);
  });
};

function baixarPDF() {
  window.location.href = '/appetizers/download-pdf';
}

</script>

<style scoped>
/* Estilos CSS específicos para este componente */
</style>
