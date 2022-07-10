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
                                <input v-model="tenvaitro" type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.tenvaitro }" name="tenvaitro">
                                <div v-if="errors.tenvaitro" class="invalid-feedback">
                                    <strong>{{ errors.tenvaitro[0] }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mota">Mô tả</label>
                                <input v-model="mota" type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.mota }" name="mota">
                                <div v-if="errors.mota" class="invalid-feedback">
                                    <strong>{{ errors.mota[0] }}</strong>
                                </div>

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
import BaseRequest from '../core/BaseRequest'
export default {
    data() {
        return {
            editmode: true,
            // api: 'http://localhost:8000/api/role',
            id: '',
            tenvaitro: '',
            mota: '',
            ds_vt: {},
            errors: {},
        }
    },
    methods: {
        newModal() {
            this.editmode = false
            this.id = ''
            this.tenvaitro = ''
            this.mota = ''
            $('#addModal').modal('show')
            $('#modal_title').html('Thêm vai trò');
        },

        saveDM() {
            BaseRequest.post('role')
                .then(res => {
                    $('#addModal').modal('hide')
                    this.$swal(
                        'Thành công!',
                        res.data.message,
                        'success'
                    )
                    this.getVT();
                }).catch(err => {
                    this.errors = err.response.data.errors
                    this.$swal(
                        'Thất bại!',
                        'Có lỗi xảy ra.',
                        'error'
                    )
                })
        },
        editModal(vaitro) {
            this.editmode = true
            this.id = vaitro.id
            this.tenvaitro = vaitro.tenvaitro
            this.mota = vaitro.mota
            $('#addModal').modal('show')
            $('#modal_title').html('Sửa vai trò');
        },

        updateDM() {
            let data = {
                id: this.id,
                tenvaitro: this.tenvaitro,
                mota: this.mota
            }
            BaseRequest.put('role/' + this.id, data).then(res => {
                $('#addModal').modal('hide')
                this.$swal(
                    'Thành công!',
                    res.data.message,
                    'success'
                )
                this.getVT()
            }).catch(err => {
                this.errors = err.response.data.errors
                this.$swal(
                    'Lỗi!',
                    'Có lỗi xảy ra.',
                    'error'
                )
            })
        },


        deleteDM(id) {
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
                    BaseRequest.delete('role/' + id).then(res => {
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
            BaseRequest.get('role').then(res => {
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