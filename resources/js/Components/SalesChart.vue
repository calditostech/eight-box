<template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h3>Gráfico de vendas</h3>
            <canvas ref="chart"></canvas>
            <h3>Tabela de vendas</h3>
            <table class="table-auto">
              <thead>
                <tr>
                  <th class="px-4 py-2">Produto</th>
                  <th class="px-4 py-2">Vendas</th>
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
      { product: 'Product A', sales: 20 },
      { product: 'Product B', sales: 40 },
      { product: 'Product C', sales: 60 },
      { product: 'Product D', sales: 80 },
      { product: 'Product E', sales: 100 },
    ]);

    const createChart = function() {
      const chart = new Chart(this.$refs.chart, {
        type: 'bar',
        data: {
          labels: data.value.map(item => item.product),
          datasets: [
            {
              label: 'Vendas',
              data: data.value.map(item => item.sales),
              backgroundColor: '#36a2eb',
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
      createChart,
    };
  },
  mounted() {
    this.createChart();
  },
  updated() {
    this.createChart();
  },
};
</script>
  