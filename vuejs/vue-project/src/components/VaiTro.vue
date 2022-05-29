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
                                    <!-- <router-link :to="{ name: 'editVT', params: { id: todo.id } }">
                                        <button class="btn btn-primary btn-circle btn-sm mr-2"><i
                                                class="fas fa-edit"></i></button>
                                    </router-link> -->
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
                            <!-- <div>
                                <label class="small mb-1">Quyền</label>
                                <div class="form-check" v-for="item in ds_quyen">
                                    <input class="form-check-input" type="checkbox" :value="item.id"
                                        v-model="form.quyen" v-bind:true-value="yes" v-bind:false-value="no">
                                    <label class="form-check-label">{{ item.mota }}</label>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-6" v-for="item in ds_quyen">
                                    <div class="block">
                                        <label>
                                            <input type="checkbox" :value="item.id" v-model="form.quyen">
                                            <span>{{ item.mota }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div> -->

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
            api: 'http://localhost:8000/api/vaitro',
            form: new Form({
                id: '',
                tenvaitro: '',
                mota: '',
                quyen: [],
            }),
            yes: true,
            no: false,
            ds_vt: {},
            // ds_quyen: {},
        }
    },
    methods: {

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
            this.form.put(this.api + '/' + this.form.id, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then(() => {
                    $('#addModal').modal('hide')
                    this.$swal(
                        'Thành công!',
                        'Vai trò đã dược cập nhật.',
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
            $('#modal_title').html('Thêm vai trò');
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
                        'Vai trò đã được thêm.',
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

        getVT() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                // console.log(res.data);
                this.ds_vt = res.data
            }).catch(error => {
                this.$router.push('/');
            })
        },

        // getQuyen() {
        //     let token = window.localStorage.getItem('token');
        //     if (token == null) {
        //         this.$router.push('/login');
        //     }
        //     this.axios.get('http://localhost:8000/api/quyen', {
        //         headers: {
        //             Authorization: 'Bearer ' + token
        //         }
        //     }).then(res => {
        //         // console.log(res.data);
        //         this.ds_quyen = res.data
        //     })
        // },


    },

    created() {
        this.getVT();
        // this.getQuyen();
    },



}      
</script>