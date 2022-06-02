<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý bàn</h1>
        <div id="message"></div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách bàn</h6>
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
                                <th>Số bàn</th>
                                <th>Số ghế</th>
                                <th>Tình trạng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(todo, index) in ds_ban" :key="index">
                                <td>{{ todo.id }}</td>
                                <td>{{ todo.ghe }}</td>

                                <td v-if="todo.tinhtrang == 0">
                                    <span class="badge badge-success">Trống</span>
                                </td>
                                <td v-else-if="todo.tinhtrang == 1">
                                    <span class="badge badge-warning">Đã có khách</span>
                                </td>
                                <td v-else-if="todo.tinhtrang == 2">
                                    <span class="badge badge-danger">Khách đặt</span>
                                </td>
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
                                <label for="ghe">Số ghế</label>
                                <input v-model="form.ghe" type="text" class="form-control" name="ghe">
                                <div class="text-danger error-text " v-if="form.errors.has('ghe')"
                                    v-html="form.errors.get('ghe')"></div>
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
            api: 'http://localhost:8000/api/ban',
            form: new Form({
                id: '',
                ghe: '',
                tinhtrang: 0,
            }),
            ds_ban: {},
        }
    },
    methods: {
        editModal(ban) {
            this.editmode = true
            $('#addModal').modal('show')
            this.form.fill(ban);//gán giá trị
            $('#modal_title').html('Sửa bàn');
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
            }, this.form).then(() => {
                $('#addModal').modal('hide')
                this.$swal(
                    'Thành công!',
                    'Bàn đã dược cập nhật.',
                    'success'
                )
                this.getBan();
            }).catch(error => {
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
            $('#modal_title').html('Thêm bàn');
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
                        'Bàn đã được thêm.',
                        'success'
                    )
                    this.getBan();
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
                    this.getBan();
                }

            })
        },

        getBan() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                console.log(response.data);
                this.ds_ban = response.data
            }).catch(error => {
                // console.log(error.message);
                this.$router.push('/');
            })
        },
    },
    created() {
        this.getBan();
    },

    // mounted() {
    //     this.getBan();
    // },
}      
</script>