<template>
  <div style="text-align: center;">
    <div style="width: 95%; margin: 0 auto;">
      <div style="width: 10%; display: inline-block; margin-right: 20px; text-align: left;">
        <img :src="logoPath" width="100%" alt="">
      </div>
      <div style="width: 50%; display: inline-block; text-align: center;">
        <h1>Relatório Entrada</h1>
      </div>
    </div>

    <table style="position: relative; top: 50px; margin: 0 auto; text-align: left; border-collapse: separate; border-spacing: 10px;">
      <thead>
        <tr>
          <th style="padding: 10px;">MARCA</th>
          <th style="padding: 10px;">TIPO</th>
          <th style="padding: 10px;">QUANTIDADE</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in appetizers" :key="item.id">
          <td data-column="marca" style="padding: 10px;">{{ item.marca }}</td>
          <td data-column="tipo" style="padding: 10px;">{{ item.tipo }}</td>
          <td data-column="quantidade" style="padding: 20px; color: dodgerblue;">{{ item.quantidade }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    appetizers: Array,
    logoPath: String,
  },
};
</script>

