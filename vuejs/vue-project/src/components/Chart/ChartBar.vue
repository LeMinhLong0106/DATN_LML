<template>
    <div>
        <h2 class="h3 mb-4 text-gray-800 text-center">Thống kê số người theo tháng</h2>
        <canvas id="myBar"></canvas>
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
        const ctx = document.getElementById('myBar');

        try {
            let token = window.localStorage.getItem('token');
            const response = await this.axios.get('http://localhost:8000/api/report', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
            // console.log(response.data.hd)
            const myBar = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.data.songuoi.map(item => 'Tháng ' + item.month),
                    datasets: [{
                        label: 'Số người',
                        data: response.data.songuoi.map(item => item.songuoi),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]

                },
            });
            myBar
        } catch (e) {
            console.error(e)
        }
    }
}
</script>