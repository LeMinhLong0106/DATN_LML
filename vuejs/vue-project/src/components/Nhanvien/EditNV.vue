<template>
    <div class="container-fluid">
        <div class="modal-content">
            <form @submit.prevent="updateMon" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                </div>

                <!-- Modal body -->
                <div class="form-group">
                    <label for="hoten">Tên nhân viên</label>
                    <input v-model="ds_nv.hoten" type="text" class="form-control" name="hoten" placeholder="Họ tên">
                    <div class="text-danger error-text "></div>
                </div>
                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input v-model="ds_nv.diachi" type="text" class="form-control" name="diachi" placeholder="Địa chỉ">
                    <div class="text-danger error-text ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input v-model="ds_nv.sdt" type="number" class="form-control" name="sdt"
                        placeholder="Số điện thoại">
                    <div class="text-danger error-text ">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sdt">Email</label>
                    <input v-model="ds_nv.email" type="email" class="form-control" name="email" placeholder="Email">
                    <div class="text-danger error-text "></div>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input v-model="ds_nv.password" type="password" class="form-control" name="password"
                        placeholder="Mật khẩu">
                    <div class="text-danger error-text ">
                    </div>
                </div>
                <!-- <div class="form-group d-none">
                                <label for="tinhtrang">Tình trạng</label>
                                <input type="radio" name="tinhtrang" value="1" checked> Còn
                                <input type="radio" name="tinhtrang" value="0"> Hết
                            </div> -->
                <div>
                    <img :src="getIMG(ds_nv.hinhanh)" style="width: 5rem; ">
                </div>
                <div class="form-group">
                    <label for="hinhanh">Ảnh</label>
                    <input v-on:change="updateImage" type="file" class="form-control" name="hinhanh">
                    <div class="text-danger error-text ">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label for="vaitro_id">Vai trò</label>
                    <select class="form-control" name="vaitro_id" v-model="ds_nv.vaitro_id">
                        <option value="" class="form-control">Vai trò</option>
                        <option v-for="item in ds_vt" v-bind:value="item.id">
                            {{ item.tenvaitro }}
                        </option>
                    </select>
                    <div class="text-danger error-text "></div>
                </div> -->
                <div class="form-group">
                    <label for="vaitro_id">Vai trò</label>
                    <select class="form-control" name="vaitro_id" v-model="ds_nv.vaitro_id">
                        <option value="" class="form-control">Vai trò</option>
                        <option v-for="item in ds_vt" v-bind:value="item.id">
                            {{ item.tenvaitro }}
                        </option>
                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
    </div>
</template>

<script>
import Form from 'vform'

export default {
    data() {
        return {
            api: 'http://localhost:8000/api/nhanvien',
            ds_nv: {},
            ds_vt: {},
        }
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },

        updateMon() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            let formData = new FormData();
            formData.append('hoten', this.ds_nv.hoten);
            formData.append('diachi', this.ds_nv.diachi);
            formData.append('sdt', this.ds_nv.sdt);
            formData.append('email', this.ds_nv.email);
            formData.append('password', this.ds_nv.password);
            formData.append('vaitro_id', this.ds_nv.vaitro_id);
            formData.append('hinhanh', this.hinhanh);
            this.axios.post('http://localhost:8000/api/update_nv' + '/' + this.$route.params.id, formData, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.$router.push('/admin/nhanvien');
                this.$swal(
                    'Thành công!',
                    'nhân viên đã được thêm.',
                    'success'
                )
            }).catch(err => {
                this.$swal(
                    'Error!',
                    'Your file has been deleted.',
                    'error'
                )
            })


        },
        updateImage(e) {
            this.hinhanh = e.target.files[0]
        },

        getNV() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get(this.api + '/' + this.$route.params.id, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                // console.log(response.data)
                this.ds_nv = response.data;
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