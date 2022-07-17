<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800 text-center">DANH SÁCH HÓA ĐƠN ONLINE</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-class" id="dataTable">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tổng tiền</th>
                                <th>Ngày mua</th>
                                <th>Tình trạng</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in ds_hd">
                                <td>{{ item.id }}</td>
                                <td>{{ item.hoten }}</td>
                                <td>{{ item.sdt }}</td>
                                <td>{{ item.diachi }}</td>
                                <td>{{ item.tongtien.toLocaleString("de-DE") }}đ</td>
                                <td>{{ format_date(item.created_at) }}</td>
                                <td>
                                    <span v-if="item.tinhtrang == 0" class="badge badge-danger">Chưa xử lý</span>
                                    <span v-else class="badge badge-success">Đã xử lý</span>
                                </td>
                                <td>
                                    <div v-if="item.tinhtrang == 0">
                                        <router-link :to="{ name: 'hdonline.edit', params: { id: item.id } }">
                                            <button type="button" class="btn btn-primary btn-circle btn-sm">
                                                <i class="fas fa-edit"></i></button>
                                        </router-link>
                                    </div>
                                    <div v-else>
                                        <button type="button" class="btn btn-danger btn-circle btn-sm mr-2"
                                            @click="deleteHD(item.id)"><i class="fas fa-times"></i></button>
                                        <router-link :to="{ name: 'hdonline.detail', params: { id: item.id } }">
                                            <button type="button" class="btn btn-warning btn-circle btn-sm">
                                                <i class="fas fa-eye"></i></button>
                                        </router-link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseRequest from '../core/BaseRequest'
import moment from 'moment'
export default {

    data() {
        return {
            ds_hd: {},
            cthd: {},
            id: '',
            tong: 0,
        }
    },

    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        deleteHD(id) {
            this.$swal({
                title: 'Bạn chắc chứ?',
                text: "Bạn muốn xóa hóa đơn này!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Hủy',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa'
            }).then((result) => {
                if (result.isConfirmed) {
                    BaseRequest.delete('hdonline/deleteHDO/' + id).then(res => {
                        this.$swal(
                            'Đã xóa!',
                            res.data.message,
                            'success'
                        )
                    })
                    this.getHD()
                }
            })
        },

        getHD() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            BaseRequest.get('hdonline').then(res => {
                // console.log(res.data.data)
                this.ds_hd = res.data.data
                $('#dataTable').DataTable().destroy();
                this.$nextTick(() => {
                    $('#dataTable').DataTable(
                        {
                            "language": {
                                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                                "zeroRecords": "Không có hóa đơn cần tìm",
                                "info": "Hiển thị _PAGE_ trong _PAGES_",
                                "infoEmpty": "Không có hóa đơn cần tìm",
                                "infoFiltered": "(Lọc từ _MAX_ bản ghi)",
                                "search": "Tìm kiếm:",
                                "paginate": {
                                    "first": "Đầu",
                                    "last": "Cuối",
                                    "next": "Sau",
                                    "previous": "Trước"
                                }
                            }
                        }
                    );
                })
            }).catch(() => {
                this.$router.push('/');
            })
        },

        getCTHD(id) {
            BaseRequest.get('hdonline/' + id).then(res => {
                // console.log(res.data.cthd)
                this.cthd = res.data.cthd
                this.tong = res.data.tong
            }).catch(() => {
                this.$router.push('/');
            })
        },
    },

    created() {
        this.getHD();
    },

}    
</script>