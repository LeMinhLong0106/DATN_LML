<template>
  <DoughnutChart :chart-data="data" :options="options" css-classes="chart-container" />
</template>

<script setup>
import { ref, computed } from "vue"
import { DoughnutChart } from "vue-chart-3"
import { Chart, DoughnutController, ArcElement } from "chart.js"

Chart.register(DoughnutController, ArcElement)
const database = [
  {
    name: "TTHQ",
    value: 110
  },
  {
    name: "Hội đồng",
    value: 20
  },
  {
    name: "Công ty",
    value: 41
  }
]

// const database = 

const dataValues = ref(database)

const data = computed(() => ({
  labels: dataValues.value.map(item => item.name),

  datasets: [
    {
      data: dataValues.value,
      backgroundColor: ["#859900", "#d33682", "#cb4b16"]
    }
  ]
}))

const options = ref({
  elements: {
    arc: {
      borderColor: "#073642"
    }
  },

  plugins: {
    title: {
      text: "Doughnut"
    }
  }
})


// methods = {
//   getBaoCao() {
//     let token = window.localStorage.getItem('token');
//     if (token == null) {
//       this.$router.push('/login');
//     }
//     this.axios.get('http://127.0.0.1:8000/api/baocao', {
//       headers: {
//         Authorization: 'Bearer ' + token
//       }
//     }).then(res => {
//       console.log(res.data.hd);

//       this.hd = res.data.hd

//     })
//   },
// },
// created = () => {
//   this.getBaoCao()
// }

</script>