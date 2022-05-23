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
            api: 'http://localhost:8000/api/danhmuc',
            form: new Form({
                id: '',
                tendm: '',
                uutien: '',
            }),
            ds_dm: {},
        }
    },
    methods: {

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
            this.form.put(this.api + '/' + this.form.id, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then(() => {
                    $('#addModal').modal('hide')
                    this.$swal(
                        'Thành công!',
                        'Danh mục đã dược cập nhật.',
                        'success'
                    )
                    this.getDM();
                })
                .catch(error => {
                    this.$swal(
                        'Error!',
                        'Your file has been deleted.',
                        'error'
                    )
                })
        },

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
            this.form.post(this.api, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then(() => {
                    $('#addModal').modal('hide')
                    this.$swal(
                        'Thành công!',
                        'Danh mục đã được thêm.',
                        'success'
                    )
                    this.getDM();
                })
                .catch(error => {
                    this.$swal(
                        'Error!',
                        'Your file has been deleted.',
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
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.form.delete(this.api + '/' + id, {
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
                    this.getDM();
                }

            })
        },

        getDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_dm = res.data.data
            })
        },

    },

    created() {
        this.getDM();
    },



}      
</script>