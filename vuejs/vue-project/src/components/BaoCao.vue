<template>
    <div class="container-fluid">

        <h3 class="text-center">Báo cáo doanh thu</h3>
        <h4 class="text-center">Từ ngày ... đến ngày ...</h4>

        <table class="table table-striped table-class">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Số bàn</th>
                    <th>Ngày đặt</th>
                    <th>Nhân viên phục vụ</th>
                    <th>Nhân viên thu ngân</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in hdtq">
                    <td>{{ item.id }}</td>
                    <td>{{ item.ban_id }}</td>
                    <td>{{ format_date(item.created_at) }}</td>
                    <td>{{ item.nhanvien_id }}</td>
                    <td>{{ item.nhanvien_tn }}</td>
                    <td>{{ item.tongtien.toLocaleString() }} VNĐ</td>
                    <td>
                        <span v-if="item.tinhtrang == 0" class="badge badge-danger">Chưa thanh toán</span>
                        <span v-else class="badge badge-success">Đã thanh toán</span>
                    </td>
                    <td>
                        <a class="btn btn-warning btn-circle btn-sm" href="">
                            <i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            </tbody>

        </table>
        <h3>Tổng tiền:{{ $data.tongtien.toLocaleString() }} VNĐ </h3>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            date_from: '',
            date_to: '',
            hdtq: {},
            tongtien: '',

            selectedType: '',
            startDate: null,
            endDate: null,
        }
    },
    methods: {
        baocaoTK() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/baocao/hdtq', {
                params: {
                    date_from: this.date_from,
                    date_to: this.date_to,
                }
            }, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.hdtq = res.data.data
                this.tongtien = res.data.tongtien
            })
        },

        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
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
                this.hdtq = res.data.hdtq
                this.date_from = res.data.date_from
                this.date_to = res.data.date_to
                this.tongtien = res.data.tttq
            })
        },
    },

    created() {
        this.getBaoCao();
    },

    computed: {
        // filterItem: function () {
        //     let filterType = this.selectedType
        //     if (!filterType) return this.items;  // when filterType not selected

        //     let startDate = this.startDate && new Date(this.startDate);
        //     let endDate = this.endDate && new Date(this.endDate);

        //     return this.items.filter(item => {
        //         return item.type == filterType;
        //     }).filter(item => {
        //         const itemDate = new Date(item.date)
        //         if (startDate && endDate) {
        //             return startDate <= itemDate && itemDate <= endDate;
        //         }
        //         if (startDate && !endDate) {
        //             return startDate <= itemDate;
        //         }
        //         if (!startDate && endDate) {
        //             return itemDate <= endDate;
        //         }
        //         return true;  // when neither startDate nor endDate selected
        //     })

        // }
    }
}
</script>