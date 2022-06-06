<template>
    <div class="row container d-flex justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="row"> -->
                    <h3 class="text-center">CHI TIẾT HÓA ĐƠN: {{ hd.id }} </h3>
                    <hr />
                    <div style="margin-left: 150px;">
                        <div class="row">
                            <div class="col-md-6"><b>Số HĐ: </b> {{ hd.id }}</div>
                            <div class="col-md-6"><b>Ngày mua: </b> {{ format_date(hd.created_at) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><b>Họ tên khách hàng: </b>{{ hd.hoten }} </div>
                            <div class="col-md-6"><b>Số điện thoại: </b>{{ hd.sdt }} </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><b>Địa chỉ: </b>{{ hd.diachi }} </div>
                            <div class="col-md-6"><b>Ghi chú: </b>{{ hd.ghichu }} </div>
                        </div>
                    </div>
                    <br />
                    <form @submit.prevent="thanhtoan()">
                        <h4 class="text-center">Danh sách món ăn</h4>
                        <table class="table table-striped table-class">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên món</th>
                                    <th>Số lượng</th>
                                    <th>Ghi chú</th>
                                    <th>Giá bán</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cthd">
                                    <td> <img :src="getIMG(item.monanss.hinhanh)" style="width: 5rem; " /> </td>
                                    <td>{{ item.monanss.tenmonan }}</td>
                                    <td>{{ item.soluong }}</td>
                                    <td>{{ item.ghichu }}</td>
                                    <td>{{ item.giaban }} </td>
                                    <td>{{ item.soluong * item.giaban }} </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr />
                        <div style="text-align:right;">
                            <h4>Tổng tiền: {{ hd.tongtien }}</h4>
                        </div>

                        <div>
                            <!-- <input type="submit" name="them" value="Thanh toán" class="btn btn-primary" /> -->
                            <button type="submit" class="btn btn-primary">Thanh toán</button>
                            <router-link to="/nhanvien" class="btn btn-primary float-right">Quay lại</router-link>
                        </div>
                    </form>
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
            user: {},
            api: 'http://127.0.0.1:8000/api/hdonline/',
        }
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },

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
            this.axios.get(this.api + id, {
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
        thanhtoan() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api + this.hd.id + '/thanhtoanon', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.$swal(
                    'Thành công!',
                    'Hóa đơn đã được xử lý',
                    'success'
                )
                this.$router.push('/hdonline')
            })

        },
    },
    created() {
        this.getCTHD(this.$route.params.id)
    },
}
</script>