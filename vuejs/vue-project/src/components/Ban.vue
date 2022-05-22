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
                        <button type="button" class="btn btn-success btn-circle btn-sm" @click="addBan()">
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
                                    <span class="badge badge-danger">Trống</span>
                                </td>
                                <td v-else-if="todo.tinhtrang == 1">
                                    <span class="badge badge-success">Đã đặt</span>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-circle btn-sm mr-2" @click="editBan(todo.id)"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-circle btn-sm" @click="deleteBan(todo.id)"><i
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
                    <form @submit.prevent="saveBan">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm bàn</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ghe">Số ghế</label>
                                <input type="number" class="ghe form-control" name="ghe" v-model="ghe">
                                <span class="text-danger error-text ghe_err"></span>
                            </div>
                            <!-- <div class="form-group d-none">
                                <label for="tinhtrang">Tình trạng</label>
                                <input type="radio" class="tinhtrang" name="tinhtrang" value="0" checked> Trống
                                <input type="radio" class="tinhtrang" name="tinhtrang" value="1"> Đã đặt
                            </div> -->
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal edit -->
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="updateBan">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Sửa bàn</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ghe">Số ghế</label>
                                <input type="number" class="ghe form-control" name="ghe" v-model="ghe">
                                <span class="text-danger error-text ghe_err"></span>
                            </div>
                            <!-- <div class="form-group d-none">
                                <label for="tinhtrang">Tình trạng</label>
                                <input type="radio" class="tinhtrang" name="tinhtrang" value="0" checked> Trống
                                <input type="radio" class="tinhtrang" name="tinhtrang" value="1"> Đã đặt
                            </div> -->
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Sửa</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            ds_ban: [],
            api: 'http://localhost:8000/api/ban',
            ghe: '',
            tinhtrang: 0,
            edit_ban_id: '',
            edit_index: '',
        }
    },
    mounted() {
        //get api data
        this.checkLogin();
    },
    methods: {

        addBan() {
            $('#modal_title').html('Thêm bàn');
            $('#form_ban').trigger('reset');
            $('#addModal').modal('show');
            this.ghe = '';
        },

        saveBan() {
            let data = {
                ghe: this.ghe,
                tinhtrang: this.tinhtrang,
            }

            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }

            this.axios.post('http://localhost:8000/api/ban', data, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                this.ds_ban.push(response.data);
                $('#addModal').modal('hide');
                $('#message').addClass('alert alert-success');
                $('#message').html('Thêm thành công');
            }).catch(error => {
                this.showMessage('Thêm thất bại');
            });

            setTimeout(function () {
                $('#message').removeClass('alert alert-success');
                $('#message').html('');
            }, 3000);
        },

        editBan(id) {
            let data = this.ds_ban.find(a => a.id == id);
            // console.log(data);
            this.ghe = data.ghe;//set value 
            this.tinhtrang = data.tinhtrang;//set value 
            this.edit_ban_id = id;//set id to edit
            this.edit_index = this.ds_ban.indexOf(data);//set index to edit
            $('#modal_title').html('Sửa bàn');
            $('#editModal').modal('show');
        },

        updateBan() {
            let data = {
                ghe: this.ghe,
                tinhtrang: this.tinhtrang,
            };
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }

            this.axios.put(this.api + '/' + this.edit_ban_id, data, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                // console.log(response);

                this.ds_ban[this.edit_index] = response.data;
                $('#editModal').modal('hide');
                $('#message').addClass('alert alert-success');
                $('#message').html('Sửa thành công');
            }).catch(error => {
                this.showMessage('Sửa thất bại');
            });

            setTimeout(function () {
                $('#message').removeClass('alert alert-success');
                $('#message').html('');
            }, 3000);
        },


        deleteBan(id) {

            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }

            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                this.axios.delete(this.api + '/' + id, {
                    headers: {
                        Authorization: 'Bearer ' + token
                    }
                }).then(response => {
                    this.ds_ban = this.ds_ban.filter(a => a.id != id);
                });
            }
        },

        checkLogin() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://localhost:8000/api/ban', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                this.ds_ban = response.data;
            }).catch(error => {
                this.$router.push('/login');
            })
        },
    }
}      
</script>