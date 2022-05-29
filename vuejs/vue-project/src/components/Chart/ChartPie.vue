<template>
  <Pie v-if="loaded" :chart-data="chartData" :width="width" :height="height" />
</template>

<script>
import { Pie } from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
} from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale)

export default {
  name: 'PieChart',
  components: {
    Pie
  },
  props: {
    width: {
     type: Number,
      default: 0
    },
    height: {
      type: Number,
      default: 0
    },
  },
  data: () => ({
    loaded: false,
    chartData: null
  }),
  async mounted() {
    this.loaded = false

    try {
      let token = window.localStorage.getItem('token');
      const response = await this.axios.get('http://127.0.0.1:8000/api/baocao', {
        headers: {
          Authorization: 'Bearer ' + token
        }
      })
      // console.log(response.data)
      this.chartData = {
        labels: response.data.soluongmon.map(item => item.monanss.tenmonan),
        datasets: [{
          label: 'Số lượng bàn',
          data: response.data.soluongmon.map(item => item.total),
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          ],
        },
        ],
      }

      this.loaded = true
    } catch (e) {
      console.error(e)
    }
  }
}
</script>