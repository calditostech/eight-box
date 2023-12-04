<template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h3>Gráfico de entrada de produtos</h3>
            <canvas ref="entradas"></canvas>
            <h3>Tabela de quantidades de entrada de produtos</h3>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="px-4 py-2">Produto</th>
                  <th class="px-4 py-2">Quantidades</th>
                  <th class="px-4 py-2">Data Entrada</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in data" :key="item.product">
                  <td class="border px-4 py-2">{{ item.product }}</td>
                  <td class="border px-4 py-2">{{ item.sales }}</td>
                  <td class="border px-4 py-2">{{ item.data_entrada }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h3>Gráfico de saída de produtos</h3>
            <canvas ref="saidas"></canvas>
            <h3>Tabela de quantidades de saida de produtos</h3>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="px-4 py-2">Produto</th>
                  <th class="px-4 py-2">Quantidades</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in data" :key="item.product">
                  <td class="border px-4 py-2">{{ item.product }}</td>
                  <td class="border px-4 py-2">{{ item.sales }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</template>
  
<script>
import { ref } from 'vue';
import Chart from 'chart.js/auto';

export default {
  name: 'SalesChart',
  setup() {
    const data = ref([
      { product: 'Product A', sales: 20, data_entrada: '20/01/2020' },
      { product: 'Product B', sales: 40, data_entrada: '06/03/2021' },
      { product: 'Product C', sales: 60, data_entrada: '17/05/2021' },
      { product: 'Product D', sales: 80, data_entrada: '20/01/2020' },
      { product: 'Product E', sales: 100, data_entrada: '20/01/2020' },
    ]);

    const EntriesChart = function() {
      const entradas = new Chart(this.$refs.entradas, {
        type: 'bar',
        data: {
          labels: data.value.map(item => item.product),
          datasets: [
            {
              label: 'Entradas',
              data: data.value.map(item => item.sales),
              backgroundColor: '#006400',
            },
          ],
          labels: data.value.map(item => item.data_entrada),
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    };

    const OutputsGraph = function() {
      const saidas = new Chart(this.$refs.saidas, {
        type: 'bar',
        data: {
          labels: data.value.map(item => item.product),
          datasets: [
            {
              label: 'Saídas',
              data: data.value.map(item => item.sales),
              backgroundColor: '#FF0000',
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    };

    return {
      data,
      EntriesChart,
      OutputsGraph
    };
  },

  mounted() {
    this.EntriesChart();
    this.OutputsGraph();
  },

  updated() {
    this.createChart();
    this.EntriesChart();
    this.OutputsGraph();
  },
};
</script>
  