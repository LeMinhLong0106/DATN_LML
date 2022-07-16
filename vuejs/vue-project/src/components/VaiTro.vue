<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Vai trò</h1>
        <div id="message"></div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách vai trò</h6>
                    </div>
                    <div class="col" align="right">
                        <button type="button" class="btn btn-success btn-circle btn-sm" @click="newModal()">
                            <i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Tên vai trò</th>
                                <th>Mô tả</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(todo, index) in ds_vt" :key="index">
                                <td>{{ todo.tenvaitro }}</td>
                                <td>{{ todo.mota }}</td>
                                <td>
                                    <button class="btn btn-primary btn-circle btn-sm mr-2" @click="editModal(todo)"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-circle btn-sm" @click="deleteDM(todo.id)"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal add -->
        <div class="modal fade" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="editmode ? updateDM() : saveDM()">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal_title"></h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tenvaitro">Tên vai trò</label>
                                <input v-model="form.tenvaitro" type="text" class="form-control" name="tenvaitro">
                                <div class="text-danger error-text " v-if="form.errors.has('tenvaitro')"
                                    v-html="form.errors.get('tenvaitro')"></div>
                            </div>
                            <div class="form-group">
                                <label for="mota">Mô tả</label>
                                <input v-model="form.mota" type="text" class="form-control" name="mota">
                                <div class="text-danger error-text " v-if="form.errors.has('mota')"
                                    v-html="form.errors.get('mota')"></div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Thêm</button>
                            <button v-show="editmode" type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>
                    </form>
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
            editmode: true,
            form: new Form({
                id: '',
                tenvaitro: '',
                mota: '',
            }),
            ds_vt: {},
        }
    },
    methods: {
        newModal() {
            this.editmode = false
            this.form.reset();
            $('#addModal').modal('show')
            $('#modal_title').html('Thêm vai trò');
        },

        saveDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.form.post('role', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then(res => {
                    $('#addModal').modal('hide')
                    this.$swal(
                        'Thành công!',
                        res.data.message,
                        'success'
                    )
                    this.getVT();
                })
                .catch(() => {
                    this.$swal(
                        'Lỗi!',
                        'Có lỗi xảy ra.',
                        'error'
                    )
                })
        },
        editModal(vaitro) {
            this.editmode = true
            $('#addModal').modal('show')
            this.form.fill(vaitro);//gán giá trị vào form
            // console.log(this.form)
            $('#modal_title').html('Sửa vai trò');
        },

        updateDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            // console.log('update');
            this.form.put('role/' + this.form.id, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }, this.form).then(res => {
                $('#addModal').modal('hide')
                this.$swal(
                    'Thành công!',
                    res.data.message,
                    'success'
                )
                this.getVT()
            }).catch(() => {
                this.$swal(
                    'Lỗi!',
                    'Có lỗi xảy ra.',
                    'error'
                )
            })
        },


        deleteDM(id) {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.$swal({
                title: 'Bạn chắc chứ?',
                text: "Bạn muốn xóa vai trò này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Hủy',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.form.delete('role/' + id, {
                        headers: {
                            Authorization: 'Bearer ' + token
                        }
                    }).then(res => {
                        this.$swal(
                            'Đã xóa!',
                            res.data.message,
                            'success'
                        )
                    }).catch(e => {
                        this.$swal(
                            'Lỗi!',
                            e.response.data.error,
                            'error'
                        )
                    })
                    this.getVT();
                }

            })
        },

        getVT() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('role', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                // console.log(res.data);
                this.ds_vt = res.data
                $('#dataTable').DataTable().destroy();
                this.$nextTick(() => {
                    $('#dataTable').DataTable(
                        {
                            "language": {
                                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                                "zeroRecords": "Không có vai trò cần tìm",
                                "info": "Hiển thị _PAGE_ trong _PAGES_",
                                "infoEmpty": "Không có vai trò cần tìm",
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
    },

    created() {
        this.getVT();
    },
}      
</script>