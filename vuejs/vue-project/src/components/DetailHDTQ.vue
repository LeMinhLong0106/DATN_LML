<template>
    <div class="row container d-flex justify-content-center mx-auto mb-2">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card printHD">
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
                                    <td>{{ parseInt(item.giaban).toLocaleString("de-DE") }}đ </td>
                                    <td>{{ (item.giaban * item.soluong).toLocaleString("de-DE") }}đ </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><b>Tổng:</b></td>
                                    <td colspan="2">{{ tong.toLocaleString("de-DE") }}đ </td>
                                </tr>
                            </tbody>
                        </table>
                        <h6 class="text-center font-italic">Cám ơn quý khách, hẹn gặp lại!</h6>
                        <div class="noprint">
                            <button @click="printHD()" class="btn btn-primary ">In hóa đơn</button>
                            <router-link to="/hdtaiquay" class="btn btn-primary float-right">Quay lại</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import BaseRequest from '../core/BaseRequest'
export default {
    data() {
        return {
            hd: {},
            cthd: {},
            tong: '',
        }
    },
    methods: {
        printHD() {
            window.print()
        },
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        getCTHD(id) {

            BaseRequest.get('hdtaiquay/' + id).then(res => {
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