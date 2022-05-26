<template>
    <div class="container-fluid">
        <!-- <form>
            <input type="date" v-model="date_from">
            <input type="date" v-model="date_to">
            <input type="submit" value="Thống kê">
        </form>
        <ul>
            <li v-for="all in filterDate">{{ all }}</li>
        </ul>
        <ul>
            <li v-for="slm in filterSoluongmon">{{ slm }}</li>
        </ul>
        <ul>
            {{ tongtien }}
            TTHQ: {{ tthq }}
        </ul> -->

        <!-- <canvas id="myChart" ></canvas> -->
        <ChartBar />
        <br>
        <ChartLine />
        <br>
        <ChartDoughnut />


    </div>
</template>

<script setup>
import ChartBar from './Chart/ChartBar.vue'
import ChartLine from './Chart/ChartLine.vue'
import ChartDoughnut from './Chart/ChartDoughnut.vue'
</script>

<style>
.container-fluid {
    margin-top: 20px;
}

.chart-container {
    background-color: #eee8d5;
    border-radius: 0.5rem;
}
</style>

<script>
import moment from 'moment'
import Chart from 'chart.js/auto';
export default {
    data() {
        return {
            hd: [],
            hdtq: [],
            tongtien: '',
            soluongmon: [],
            startDate: null,
            endDate: null,
            date_from: null,
            date_to: null,
            tthq: '',
        }
    },
    mounted() {
        const ctx = document.getElementById('myChart');
        const data = {
            labels: [
                'Red',
                'Blue',
                'Yellow',
                'Green',
            ],
            datasets: [{
                label: 'Món ăn được đặt nhiều nhất',
                data: [12, 19, 3, 5],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)'
                ],
                hoverOffset: 4
            }]
        };

        // const labels = ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'];
        // const data = {
        //     labels: labels,
        //     datasets: [{
        //         label: 'My First Dataset',
        //         data: [65, 59, 80, 81, 56, 55, 40, 50,32, 45, 67, 89],
        //         fill: false,
        //         borderColor: 'rgb(75, 192, 192)',
        //         tension: 0.1
        //     }]
        // };
        const myChart = new Chart(ctx, {
            // type: 'line',
            // data: data,

            type: 'pie',
            data: data,

            // type: 'bar',
            // data: {
            //     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            //     datasets: [{
            //         label: '# of Votes',
            //         data: [12, 19, 3, 5, 6, 3],
            //         backgroundColor: [
            //             'rgba(255, 99, 132, 0.2)',
            //             'rgba(54, 162, 235, 0.2)',
            //             'rgba(255, 206, 86, 0.2)',
            //             'rgba(75, 192, 192, 0.2)',
            //             'rgba(153, 102, 255, 0.2)',
            //             'rgba(255, 159, 64, 0.2)'
            //         ],
            //         borderColor: [
            //             'rgba(255, 99, 132, 1)',
            //             'rgba(54, 162, 235, 1)',
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(75, 192, 192, 1)',
            //             'rgba(153, 102, 255, 1)',
            //             'rgba(255, 159, 64, 1)'
            //         ],
            //         borderWidth: 1
            //     }]
            // },
            // options: {
            //     scales: {
            //         y: {
            //             beginAtZero: true
            //         }
            //     }
            // }
        });

        myChart;
    },
    computed: {
        filterDate() {
            if (this.date_from && this.date_to) {
                return this.hd.filter(item => {
                    return moment(item.created_at).isBetween(this.date_from, this.date_to)
                })
            }
            else {
                return this.hd
            }
        },

        filterSoluongmon() {
            if (this.date_from && this.date_to) {
                return this.soluongmon
            }
        }
    },
    methods: {
        localizeDate(date) {
            if (!date || !date.includes('-')) return date
            const [yyyy, mm, dd] = date.split('-')
            return new Date(`${mm}/${dd}/${yyyy}`)
        },

        getBaoCao() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/baocao', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                console.log(res.data);
                this.hd = res.data.hd
                this.hdtq = res.data.hdtq
                this.soluongmon = res.data.soluongmon
                this.tongtien = res.data.tttq
                this.date_from = res.data.date_from
                this.date_to = res.data.date_to
                this.tthq = res.data.tongtienhomnay
            })
        },

        format_date(date) {
            return moment(date).format('DD-MM-YYYY')
        },
    },
    created() {
        this.getBaoCao()
    },

    // data() {
    //     return {
    //         date_from: '',
    //         date_to: '',
    //         hdtq: {},
    //         tongtien: '',

    //         selectedType: '',
    //         startDate: null,
    //         endDate: null,
    //     }
    // },
    // methods: {
    //     baocaoTK() {
    //         let token = window.localStorage.getItem('token');
    //         if (token == null) {
    //             this.$router.push('/login');
    //         }
    //         this.axios.get('http://127.0.0.1:8000/api/baocao/hdtq', {
    //             params: {
    //                 date_from: this.date_from,
    //                 date_to: this.date_to,
    //             }
    //         }, {
    //             headers: {
    //                 Authorization: 'Bearer ' + token
    //             }
    //         }).then(res => {
    //             this.hdtq = res.data.data
    //             this.tongtien = res.data.tongtien
    //         })
    //     },

    //     format_date(value) {
    //         if (value) {
    //             return moment(String(value)).format('DD-MM-YYYY')
    //         }
    //     },
    //     getBaoCao() {
    //         let token = window.localStorage.getItem('token');
    //         if (token == null) {
    //             this.$router.push('/login');
    //         }
    //         this.axios.get('http://127.0.0.1:8000/api/baocao', {
    //             headers: {
    //                 Authorization: 'Bearer ' + token
    //             }
    //         }).then(res => {
    //             console.log(res.data);
    //             this.hdtq = res.data.hdtq
    //             this.date_from = res.data.date_from
    //             this.date_to = res.data.date_to
    //             this.tongtien = res.data.tttq
    //         })
    //     },
    // },

    // created() {
    //     this.getBaoCao();
    // },

    // computed: {
    //     filterItem: function () {
    //         let filterType = this.selectedType
    //         if (!filterType) return this.items;  // when filterType not selected

    //         let startDate = this.startDate && new Date(this.startDate);
    //         let endDate = this.endDate && new Date(this.endDate);

    //         return this.items.filter(item => {
    //             return item.type == filterType;
    //         }).filter(item => {
    //             const itemDate = new Date(item.date)
    //             if (startDate && endDate) {
    //                 return startDate <= itemDate && itemDate <= endDate;
    //             }
    //             if (startDate && !endDate) {
    //                 return startDate <= itemDate;
    //             }
    //             if (!startDate && endDate) {
    //                 return itemDate <= endDate;
    //             }
    //             return true;  // when neither startDate nor endDate selected
    //         })

    //     }
    // }
}
</script>
