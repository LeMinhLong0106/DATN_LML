<template>
    <div class="container-fluid">
        <h2 class="h3 mb-4 text-gray-800 text-center">Thống kê doanh thu</h2>
        <div class="input-group mb-3" style="width: 60%;">
            <div class="input-group-prepend">
                <span class="input-group-text">Bắt đầu</span>
            </div>
            <input type="date" class="form-control" v-model="start">
            <div class="input-group-prepend">
                <span class="input-group-text">Kết thúc</span>
            </div>
            <input type="date" class="form-control" v-model="end">
            <div class="input-group-append">
                <button @click="filterDate()" class="btn btn-primary" type="button">Thống kê</button>
                <!-- <button @click="reset()" class="btn btn-danger" type="button">Cancel</button> -->
            </div>
        </div>


        <canvas id="myLine"></canvas>
        <!-- <canvas id="myLines"></canvas> -->
    </div>
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            start: '',
            end: '',
            ds_dm: {}
        }
    },
    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },
        getDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/baocao', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                console.log(res.data)
                this.ds_dm = res.data.hd
            }).catch(() => {
                // this.$router.push('/');
            })
        },
        filterDate() {
            // console.log(response)
            const test = this.ds_dm.filter(item =>
                // {
                //     return moment(item.created_at).isBetween(this.start, this.end)
                // }
                item.created_at >= this.start && item.created_at <= this.end
            )
            const myLine = new Chart(document.getElementById('myLine'), {
                type: 'line',
                data: {
                    labels: test.map(item => this.format_date(item.created_at)),
                    datasets: [{
                        label: 'Doanh thu',
                        data: test.map(item => item.total),
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
            });
            const myLines = new Chart(document.getElementById('myLines'), {
                type: 'line',
                data: {
                    labels: test.map(item => this.format_date(item.created_at)),
                    datasets: [{
                        label: 'Doanh thu 1',
                        data: test.map(item => item.total),
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
            });
            myLine,
            myLines
            // this.data = this.data.filter(item => item.date >= this.start && item.date <= this.end)
        },
        reset() {
            this.start = ''
            this.end = ''
            this.filterDate()
        }
    },
    created() {
        this.getDM()
    }



}
</script>