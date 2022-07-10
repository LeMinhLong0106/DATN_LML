<template>
  <div>
    <h2 class="h3 mb-4 text-gray-800 text-center">Thống kê doanh thu</h2>
    <canvas id="myLine"></canvas>
  </div>
</template>

<script>
import moment from 'moment'

export default {
  methods: {
    format_date(value) {
      if (value) {
        return moment(String(value)).format('DD-MM-YYYY')
      }
    },
  },
  async mounted() {
    const ctx = document.getElementById('myLine');

    try {
      let token = window.localStorage.getItem('token');
      const response = await this.axios.get('http://localhost:8000/api/report', {
        headers: {
          Authorization: 'Bearer ' + token
        }
      })
      console.log(response.data.hd)
      const myLine = new Chart(ctx, {
        type: 'line',
        data: {
          labels: response.data.hd.map(item => this.format_date(item.created_at)),
          datasets: [{
            label: 'Doanh thu',
            data: response.data.hd.map(item => item.total),
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
      });
      myLine
    } catch (e) {
      console.error(e)
    }
  }
}
</script>