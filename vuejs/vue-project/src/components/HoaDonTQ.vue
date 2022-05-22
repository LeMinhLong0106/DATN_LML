<template>
    <div class="container-fluid">
        <h3 class="text-center">DANH SÁCH HÓA ĐƠN</h3>
        <table class="table table-striped table-class" id="dataTable">
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
                <tr v-for="item in ds_hd">
                    <td>{{ item.id }}</td>
                    <td>{{ item.ban_id }}</td>
                    <!-- <td>{{ item.created_at }}</td> -->
                    <td>{{ format_date(item.created_at) }}</td>
                    <td>{{ item.nhanvien_id }}</td>
                    <td>{{ item.nhanvien_tn }}</td>
                    <td>{{ item.tongtien.toLocaleString() }} đ</td>
                    <td>
                        <span v-if="item.tinhtrang == 0" class="badge badge-danger">Chưa xử lý</span>
                        <span v-else class="badge badge-success">Đã xử lý</span>
                    </td>
                    <td>
                        <div v-if="item.tinhtrang == 0">
                            <button type="button" class="btn btn-primary btn-circle btn-sm" @click="editHD(item.id)">
                                <i class="fas fa-edit"></i></button>
                            <!-- <button type="button" class="btn btn-danger btn-circle btn-sm" @click="deleteHD(item.id)">
                                <i class="fas fa-times"></i></button> -->
                        </div>
                        <div v-else>
                            <button type="button" class="btn btn-danger btn-circle btn-sm" @click="deleteHD(item.id)"><i
                                    class="fas fa-times"></i></button>
                            <router-link :to="{ name: 'hoadontq.detail', params: { id: item.id } }">
                                <button type="button" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-eye"></i></button>
                            </router-link>
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="editHD">
            <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editHDLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="cthd_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>Tên món ăn</th>
                                    <th>Số lượng</th>
                                    <!-- <th>Ghi chú</th> -->
                                    <th>Tổng tiền</th>
                                    <th>Chức năng</th>

                                </tr>
                            </thead>
                            <tbody id="cthd_table_body">
                                <tr v-for="item in cthd">
                                    <!-- <td>{{ item.id }}</td> -->
                                    <td>{{ item.monanss.tenmonan }}</td>
                                    <!-- <td>{{ item.soluong }}</td> -->
                                    <td>
                                        <input v-model="item.soluong" type="number"
                                            @change="updateSoluong(item.id, item.soluong)" class="form-control" min="1"
                                            style="width: 70px;">
                                    </td>
                                    <!-- <td>{{ item.ghichu }}</td> -->
                                    <td>{{ item.tongtien.toLocaleString() }}</td>
                                    <td><button class="btn btn-danger btn-circle btn-sm mr-2"
                                            @click="deleteMon(item.id)"><i class="fas fa-trash"></i></button></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right"><b>Tổng:</b></td>
                                    <td colspan="1">{{ $data.tong.toLocaleString() }} VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="thanhToan()">Thanh toán</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            ds_hd: {},
            cthd: {},
            id: '',
            tong: '',
            product_quantity: '',
        }
    },

    methods: {

        editHD(id) {
            $('#editHD').modal('show');
            this.id = id;
            this.getCTHD(id);
        },

        thanhToan() {
            var id = this.id;
            var tong = this.tong;
            var url = 'http://localhost:8000/api/hdtaiquay/' + id + '/thanhtoan';
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.put(url, {
                tong: tong
            }, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                this.getHD();
                $('#editHD').modal('hide');
            }).catch(error => {
                console.log(error);
            });

            // this.axios.post('http://127.0.0.1:8000/api/hdtaiquay/thanhtoanhdtq/' + this.id).then(response => {
            //     console.log(response.data);
            //     this.getHD();
            //     $('#editHD').modal('hide');
            // }).catch(error => {
            //     console.log(error);
            // });
        },

        deleteMon(id) {
            let data = {
                id: id,
            }
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.post('http://127.0.0.1:8000/api/order/deleteOrder', data, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                // console.log(response);
                this.cthd = response.data.saleDetails;
                this.tong = response.data.tong;

                this.getBan();
            }).catch(error => {
            });
        },

        updateSoluong(id, soluong) {
            let data = {
                id: id,
                soluong: soluong,
            }
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.post('http://127.0.0.1:8000/api/order/updateSoluong', data, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                this.product_quantity = data.soluong;
                this.cthd = response.data.saleDetails;
                this.tong = response.data.tong;

                this.getBan();
            }).catch(error => {
                // this.showMessage('Sửa thất bại');
            });
        },

        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        getHD() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/hdtaiquay', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_hd = res.data.data
            })
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
                this.cthd = res.data.cthd
                this.tong = res.data.tong
            })
        },

        deleteHD(id) {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.axios.delete('http://127.0.0.1:8000/api/hdtaiquay/deleteHD/' + id, {
                        headers: {
                            Authorization: 'Bearer ' + token
                        }
                    }).then(() => {
                        this.$swal(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    })
                    this.getHD()
                }
            })


        },
    },

    created() {
        this.getHD();
    },

}    
</script>