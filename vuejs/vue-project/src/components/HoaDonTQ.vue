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
                            <router-link :to="{ name: 'hdtaiquay.detail', params: { id: item.id } }">
                                <button type="button" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-eye"></i></button>
                            </router-link>
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>

        <div class="card shadow mb-4">
            <div class="card-header py-3">Tình trạng bàn</div>
            <div class="card-body" v-if="ds_ban.length > 0">
                <span v-for="todo in ds_ban">
                    <button v-if="todo.tinhtrang == 0" class="mb-2 mr-2 btn btn-secondary"
                        @click="showmodal(todo.id)">Bàn {{ todo.id }}
                        <br> {{
                                todo.ghe
                        }} ghế</button>
                </span>
            </div>
            <div class="card-body" v-else>
                <h4 class="text-center">Hiện tại hết bàn</h4>
            </div>

        </div>

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
                                    <!-- <th>Chức năng</th> -->

                                </tr>
                            </thead>
                            <tbody id="cthd_table_body">
                                <tr v-for="item in cthd">
                                    <td>{{ item.monanss.tenmonan }}</td>
                                    <td>
                                        <input v-model="item.soluong" type="number"
                                            @change="updateSoluong(item.id, item.soluong)" class="form-control" min="1"
                                            style="width: 70px;">
                                    </td>
                                    <td>{{ item.tongtien.toLocaleString() }}</td>
                                    <td>
                                        <div v-if="item.tinhtrang == 0">
                                            <button class="btn btn-danger btn-circle btn-sm mr-2"
                                                @click="deleteMon(item.id)"><i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div v-else></div>
                                    </td>
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

        <div id="orderModal" class="modal fade">
            <div class="modal-dialog">
                <form @submit.prevent="saveDSmon">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal_title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tên khách hàng</label>
                                <input type="text" class="form-control" v-model="hoten">
                                <div class="text-danger error-text " v-if="errors['hoten']" v-html="errors['hoten']">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="number" class="form-control" v-model="sdt">
                                <div class="text-danger error-text " v-if="errors['sdt']" v-html="errors['sdt']">
                                </div>
                            </div>

                            <div class="form-group" id="form_people">
                                <label>Số lượng người</label>
                                <input type="number" class="form-control" id="songuoi" min="1" v-model="songuoi">
                            </div>

                            <div class="form-group">
                                <label>Thời gian đến</label>
                                <input type="time" class="form-control" v-model="thoigianden">
                                <div class="text-danger error-text " v-if="errors['thoigianden']"
                                    v-html="errors['thoigianden']">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea class="form-control" rows="4" v-model="ghichu"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Add" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
import moment from 'moment'
export default {

    data() {
        return {
            ds_ban: {},
            ds_hd: {},
            cthd: {},
            errors: {},

            hoten: '',
            sdt: '',
            songuoi: '',
            ghichu: '',
            thoigianden: '',

            id: '',
            tong: '',
            product_quantity: '',

            api: 'http://localhost:8000/api/hdtaiquay',
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
                this.getBan();
                $('#editHD').modal('hide');
            }).catch(error => {
                console.log(error);
            });

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
                    this.axios.delete(this.api + '/deleteHD/' + id, {
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

        showmodal(id) {
            $('#orderModal').modal('show')
            $('#modal_title').text('Khách hàng đặt bàn:' + id)
            let dsb = this.ds_ban.find(a => a.id == id);
            this.table_ghe = dsb.ghe;
            $('#songuoi').attr('max', this.table_ghe);

            this.table_id = id;
            this.hoten = '';
            this.sdt = '';
            this.songuoi = '';
            this.ghichu = '';
            this.thoigianden = '';
        },

        saveDSmon() {
            let data = {
                id: this.table_id,
                hoten: this.hoten,
                sdt: this.sdt,
                songuoi: this.songuoi,
                ghichu: this.ghichu,
                thoigianden: this.thoigianden,
            }
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.post(this.api + '/khdattruoc', data, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                // console.log(response);
                this.$swal(
                    'Thành công!',
                    'Đặt bàn thành công.',
                    'success'
                )
                $('#orderModal').modal('hide')
                this.getHD();
                this.getBan();
            }).catch(error => {
                this.errors = error.response.data.errors;
                // this.showMessage('Sửa thất bại');
                this.$swal(
                    'Thất bại!',
                    'Có gì đó sai òi!!.',
                    'error'
                )
            });
        },

        getBan() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/getBanTrong', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_ban = res.data
            }).catch(error => {
                this.$router.push('/');
            })
        },

        getHD() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_hd = res.data.data
            }).catch(error => {
                this.$router.push('/');
            })
        },

        getCTHD(id) {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api + '/' + id, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                // console.log(res.data.cthd)
                this.cthd = res.data.cthd
                this.tong = res.data.tong
            }).catch(error => {
                this.$router.push('/');
            })
        },
    },

    created() {
        this.getHD();
        this.getBan();
    },

}    
</script>