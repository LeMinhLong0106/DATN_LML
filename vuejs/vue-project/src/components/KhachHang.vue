<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý khách hàng</h1>
        <div id="message"></div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Mã khách hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in ds_kh">
                                <td>{{ item.id }}</td>
                                <td>{{ item.tenkh }}</td>
                                <td>{{ item.sdt }}</td>
                                <td>{{ item.diachi }}</td>
                                <td>{{ item.email }}</td>
                                <td>
                                    <button class="btn btn-danger btn-circle btn-sm" @click="deleteKH(item.id)"><i
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
import Form from 'vform'

export default {
    data() {
        return {
            api: 'http://localhost:8000/api/khachhang',
            ds_kh: {},
        }
    },
    methods: {
        deleteKH(id) {
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
                    this.axios.delete(this.api + '/' + id, {
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
                    this.getKH();
                }

            })
        },
        getKH() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_kh = res.data
                this.$nextTick(() => {
                    $('#dataTable').DataTable();
                })
            }).catch(error => {
                this.$router.push('/');
            })
        },

    },

    mounted() {
        this.getKH();
    },



}      
</script>