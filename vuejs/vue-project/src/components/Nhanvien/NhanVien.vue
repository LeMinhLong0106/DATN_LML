<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý nhân viên</h1>
        <div id="message"></div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách nhân viên</h6>
                    </div>
                    <div class="col" align="right">
                        <router-link :to="{ name: 'createNV' }">
                            <button type="button" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-plus"></i></button>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Hình ảnh</th>
                                <th>Tên nhân viên</th>
                                <th>Giới tính</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in ds_nv">
                                <td>{{ item.id }}</td>
                                <td><img :src="getIMG(item.hinhanh)" style="width: 5rem; "></td>
                                <td>{{ item.hoten }}</td>
                                <td v-if="item.gioitinh == 1">Nam</td>
                                <td v-else>Nữ</td>
                                <td>{{ item.diachi }}</td>
                                <td>{{ item.sdt }}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ item.vaitross.mota }}</td>
                                <td>
                                    <router-link :to="{ name: 'editNV', params: { id: item.id } }">
                                        <button class="btn btn-primary btn-circle btn-sm mr-2"><i
                                                class="fas fa-edit"></i></button>
                                    </router-link>

                                    <button class="btn btn-danger btn-circle btn-sm" @click="deleteNV(item.id)"><i
                                            class="fas fa-trash"></i></button>
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
export default {
    data() {
        return {
            api: 'http://localhost:8000/api/nhanvien',
            ds_nv: {},
            ds_vt: {},
        }
    },
    methods: {
        deleteNV(id) {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.$swal({
                title: 'Bạn chắc chứ?',
                text: "Bạn muốn xóa nhân viên này!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Hủy',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.axios.delete(this.api + '/' + id, {
                        headers: {
                            Authorization: 'Bearer ' + token
                        }
                    }).then(res => {
                        this.$swal(
                            'Đã xóa!',
                            res.data.message,
                            'success'
                        )
                    })
                    this.getNV();
                }

            })
        },

        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },

        getNV() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_nv = res.data
                $('#dataTable').DataTable().destroy();
                this.$nextTick(() => {
                    $('#dataTable').DataTable(
                        {
                            "language": {
                                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                                "zeroRecords": "Không có nhân viên cần tìm",
                                "info": "Hiển thị _PAGE_ trong _PAGES_",
                                "infoEmpty": "Không có nhân viên cần tìm",
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

        getVT() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/vaitro', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_vt = res.data
            })
        },
    },

    created() {
        this.getNV();
        this.getVT();
    },

}      
</script>

