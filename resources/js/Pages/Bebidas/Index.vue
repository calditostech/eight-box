<template>
  <Head title="Bebidas"/>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bebidas</h2>
    </template>
    <div class="py-12">
      <table class="w-3/4 divide-y divide-gray-200 mx-auto">
        <thead class="bg-gray-50">
          <button @click="abrirFormularioAdicao" class="bg-blue-50 text-blue-400 hover:text-indigo-900">Adicionar Bebida</button>
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
              <button @click="editarBebida(bebida)" class="text-green-600 hover:text-indigo-900">Editar</button>
              <button @click="excluirBebida(bebida)" class="text-red-600 hover:text-red-900 ml-4">Excluir</button>
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
});

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

const excluirBebida = (bebida) => {
  bebidaSelecionada.value = bebida;
};
</script>

<style scoped>
/* Estilos CSS específicos para este componente */
</style>
