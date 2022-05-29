<template>
    <!-- <Bar :chart-options="chartOptions" :chart-data="chartData"  /> -->
    <Bar v-if="loaded" :chart-data="chartData" :width="width" :height="height" />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

// export default {
//   name: 'BarChart',
//   components: { Bar },
//   data() {
//     return {
//       chartData: {
//         labels: ['January', 'February', 'March'],
//         datasets: [{ data: [40, 20, 12] }]
//       },
//       chartOptions: {
//         responsive: true
//       }
//     }
//   }
// }


export default {
    name: 'BarChart',
    components: { Bar },
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
            const response = await this.axios.get('http://127.0.0.1:8000/api/ban', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
            // console.log(response.data)
            this.chartData = {
                labels: response.data.map(item => item.id),
                datasets: [{
                    label: 'Số lượng bàn',
                    data: response.data.map(item => item.ghe),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }

            this.loaded = true
        } catch (e) {
            console.error(e)
        }
    }
}
</script>