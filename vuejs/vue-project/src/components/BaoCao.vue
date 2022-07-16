<template>
    <div class="container-fluid">
        <h2 class="h3 mb-4 text-gray-800 text-center">Thống kê doanh thu</h2>
        <table class="mx-auto">
            <tr>
                <td><b>Ngày bắt đầu: </b></td>
                <td><input type="date" class="form-control" v-model="start"></td>
            </tr>
            <tr>
                <td><b>Ngày kết thúc: </b></td>
                <td><input type="date" class="form-control" v-model="end"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button @click="filterDate()" class="btn btn-primary" type="button">Thống kê</button>
                    <!-- <button @click="reset()" class="btn btn-danger" type="button">Làm mới</button> -->
                </td>
            </tr>
        </table>
        <!-- <p>Số lượng khách: {{ songuoi }}</p> -->
        <div >
            <h4 v-if="tong !== 0" class="text-center">Tổng danh thu từ {{format_date(start)}} đến {{format_date(end)}}: {{ parseInt(tong).toLocaleString("de-DE") }}đ</h4>
            <canvas id="myLine"></canvas>
            <h4 v-if="tong !== 0" class="text-center">Số lượng món ăn
                <!-- <i v-for="item in soluongmon">{{ item.monanss.tenmonan }} ({{ item.total }}), </i> -->
            </h4>
            <canvas id="myPie"></canvas>
        </div>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            start: '',
            end: '',
            tong: 0,
            songuoi: 0,
            ds_dm: {},
            soluongmon: {}
        }
    },

    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },
        async filterDate() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            let res = await this.axios.post('baocao', {
                start: this.start,
                end: this.end,
            })
            this.ds_dm = res.data.hd
            this.tong = res.data.tongtien
            this.songuoi = res.data.songuoi
            this.soluongmon = res.data.soluongmon
            this.drawChart()

        },

        drawChart() {
            const doanhthu = this.ds_dm.filter(item =>
                item.created_at >= this.start && item.created_at <= this.end
            )
            const myLine = new Chart(document.getElementById('myLine'), {
                type: 'line',
                data: {
                    labels: doanhthu.map(item => this.format_date(item.created_at)),
                    datasets: [{
                        label: 'Doanh thu',
                        data: doanhthu.map(item => item.total),
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
            });

            const myPie = new Chart(document.getElementById('myPie'), {
                type: 'pie',
                data: {
                    labels: this.soluongmon.map(item => item.monanss.tenmonan),
                    datasets: [{
                        label: 'Số lượng bàn',
                        data: this.soluongmon.map(item => item.total),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                    },],
                },
            });
            myLine,
                myPie
        },
        reset() {
            this.start = ''
            this.end = ''
            this.tong = 0
            this.songuoi = 0
            this.soluongmon = {}
            // this.drawChart()

            // this.$router.push('/report');
        }
    },
    // created() {
    //     this.getDM()
    // }

}
</script>