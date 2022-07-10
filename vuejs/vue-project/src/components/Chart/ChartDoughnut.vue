<template>
  <div>
    <h2 class="h3 mb-4 text-gray-800 text-center">Thống kê số lượng món</h2>
    <canvas id="myDou"></canvas>
  </div>
</template>

<script>

export default {
  async mounted() {
    const ctx = document.getElementById('myDou');

    try {
      let token = window.localStorage.getItem('token');
      const response = await this.axios.get('http://localhost:8000/api/report', {
        headers: {
          Authorization: 'Bearer ' + token
        }
      })
      const myDou = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: response.data.soluongmon.map(item => item.monanss.tenmonan),
          datasets: [{
            label: 'My First Dataset',
            data: response.data.soluongmon.map(item => item.total),
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
          }]
        },
      });
      myDou
    } catch (e) {
      console.error(e)
    }
  }
}
</script>