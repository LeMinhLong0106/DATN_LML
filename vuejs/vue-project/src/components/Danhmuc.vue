<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý danh mục</h1>
        <div id="message"></div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
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
                                <th>Mã</th>
                                <th>Tên danh mục</th>
                                <th>Độ ưu tiên</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(todo, index) in ds_dm" :key="index">
                                <td>{{ todo.id }}</td>
                                <td>{{ todo.tendm }}</td>
                                <td>{{ todo.uutien }}</td>
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
                                <label for="tendm">Tên danh mục</label>
                                <input v-model="form.tendm" type="text" class="form-control" name="tendm">
                                <div class="text-danger error-text " v-if="form.errors.has('tendm')"
                                    v-html="form.errors.get('tendm')"></div>
                            </div>
                            <div class="form-group">
                                <label for="uutien">Độ ưu tiên</label>
                                <input v-model="form.uutien" type="number" class="form-control" name="uutien">
                                <div class="text-danger error-text " v-if="form.errors.has('uutien')"
                                    v-html="form.errors.get('uutien')"></div>
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
                tendm: '',
                uutien: '',
            }),
            ds_dm: {},
        }
    },
    methods: {
        newModal() {
            this.editmode = false
            this.form.reset();
            $('#addModal').modal('show')
            $('#modal_title').html('Thêm danh mục');
        },

        saveDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.form.post('category', {
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
                    this.getDM();
                })
                .catch(() => {
                    this.$swal(
                        'Lỗi!',
                        'Có lỗi xảy ra.',
                        'error'
                    )
                })
        },
        
        editModal(danhmuc) {
            this.editmode = true
            $('#addModal').modal('show')
            this.form.fill(danhmuc);//gán giá trị
            $('#modal_title').html('Sửa danh mục');
        },

        updateDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            // console.log('update');
            this.form.put('category/' + this.form.id, {
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
                    this.getDM();
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
                text: "Bạn muốn xóa danh mục này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Hủy',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.form.delete( 'category/' + id, {
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
                    this.getDM();
                }

            })
        },

        getDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('category', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_dm = res.data
                $('#dataTable').DataTable().destroy();
                this.$nextTick(() => {
                    $('#dataTable').DataTable(
                        {
                            "language": {
                                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                                "zeroRecords": "Không có danh mục cần tìm",
                                "info": "Hiển thị _PAGE_ trong _PAGES_",
                                "infoEmpty": "Không có danh mục cần tìm",
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
        this.getDM();
    },
}      
</script>