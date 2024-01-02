<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h3>Tabela de entrada de produtos</h3>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="px-4 py-2">Produto</th>
                <th class="px-4 py-2">Marca</th>
                <th class="px-4 py-2">Quantidades</th>
                <th class="px-4 py-2">Data Entrada</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="appetizer in appetizer" :key="appetizer.id">
                <td class="border px-4 py-2">{{ appetizer.tipo }}</td>
                <td class="border px-4 py-2">{{ appetizer.marca }}</td>
                <td class="border px-4 py-2">{{ appetizer.max_quantidade }}</td>
                <td class="border px-4 py-2">{{ appetizer.data_entrada }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h3>Tabela de saída de produtos</h3>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="px-4 py-2">Produto</th>
                  <th class="px-4 py-2">Marca</th>
                  <th class="px-4 py-2">Quantidades</th>
                  <th class="px-4 py-2">Data Saida</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="output in outputs" :key="output.id">
                  <td class="border px-4 py-2">{{ output.tipo }}</td>
                  <td class="border px-4 py-2">{{ output.marca }}</td>
                  <td class="border px-4 py-2">{{ output.max_quantidade }}</td>
                  <td class="border px-4 py-2">{{ output.data_saida }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, defineEmits } from 'vue';
import axios from 'axios';

const appetizer = ref([]);
const outputs = ref([]);
const emit = defineEmits();

const fetchData = async () => {
  try {
    const response = await axios.get('/graphic-charts-data');
    return response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
    return null;
  }
};

onMounted(async () => {
  const data = await fetchData();
  if (data) {
    appetizer.value = data.appetizer;
    outputs.value = data.outputs;
  }
});
</script>
