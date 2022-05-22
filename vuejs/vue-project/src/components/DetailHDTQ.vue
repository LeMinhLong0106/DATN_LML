<template>
    <!-- <div class="container text-center">
        <div>
            <h3> Restaurant </h3>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Tên món</td>
                        <td>Số lượng</td>
                        <td>Giá</td>
                        <td>Tổng</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in cthd" :key="index">
                        <td> {{ ++index }} </td>
                        <td>{{ item.monanss.tenmonan }}</td>
                        <td>{{ item.soluong }}</td>
                        <td>{{ item.giaban }}</td>
                        <td>{{ item.giaban * item.soluong }}</td>
                    </tr>
                </tbody>

            </table>

            <table class="mycustonTable">
                <tr>
                    <td class='td' colspan=2>Tổng tiền</td>
                    <td colspan=2>{{ tong }}</td>
                </tr>
                <tr class='no-print'>
                    <td colspan='2'><a href="/admin/hoadontq">Go Back</a></td>
                    <td colspan='2'><a href="javascript:void(0)" onClick='window.print();return false;'>Print</a></td>
                </tr>
            </table>
        </div>
        <div class="receipt-footer"> Thank You!</div>
    </div> -->
    <div>
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="card-title">Nhà hàng Majestic</h4>
                                    <p class="card-description">
                                        105B-Nguyễn Thị Minh Khai-Nha Trang
                                    </p>
                                    <p class="card-description">
                                        ĐT:123456789 - FAX: 0987654321
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p>Số bàn: {{ hd.ban_id }} -- Số phiếu: {{ hd.id }}</p>
                                    <p>NVPV: {{ hd.nhanvien_id }}</p>
                                    <p>Ngày: {{ format_date(hd.created_at) }}</p>
                                </div>
                            </div>
                            <h5 class="text-center">PHIẾU TÍNH TIỀN</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên món</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in cthd" :key="index">
                                            <td> {{ ++index }} </td>
                                            <td>{{ item.monanss.tenmonan }}</td>
                                            <td>{{ item.soluong }}</td>
                                            <td>{{ item.giaban }} </td>
                                            <td>{{ item.giaban * item.soluong }} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><b>Tổng:</b></td>
                                            <td colspan="2">{{ tong.toLocaleString() }} </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            hd: {},
            cthd: {},
            tong: '',
        }
    },
    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        getCTHD(id) {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/hdtaiquay/' + id, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                // console.log(res.data.cthd)
                this.hd = res.data.data;
                this.cthd = res.data.cthd
                this.tong = res.data.tong
            })
        },

    },
    created() {
        this.getCTHD(this.$route.params.id)
    },
}
</script>