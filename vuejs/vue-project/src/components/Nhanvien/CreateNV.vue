<template>
    <div class="px-4 mt-4">
        <form @submit.prevent="saveUser" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Ảnh nhân viên</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <!-- <img class="img-account-profile rounded-circle mb-2" :src="getIMG()"> -->
                            <!-- Profile picture help block-->
                            <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                            <!-- Profile picture upload button-->
                            <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                            <input @change="saveImage" type="file" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('hinhanh') }" name="hinhanh">
                            <div v-if="form.errors.has('hinhanh')" class="invalid-feedback">
                                <strong>{{ form.errors.get('hinhanh') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Thông tin nhân viên</div>
                        <div class="card-body">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="hoten">Tên nhân viên</label>
                                    <input v-model="form.hoten" type="text" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('hoten') }" name="hoten"
                                        placeholder="Họ tên">
                                    <div v-if="form.errors.has('hoten')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('hoten') }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="hoten">Giới tính</label>
                                            <br>
                                            <input type="radio" value="1" checked v-model="form.gioitinh" />
                                            Nam
                                            <input type="radio" value="0" v-model="form.gioitinh" />
                                            Nữ
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="ngaysinh">Ngày sinh</label>
                                            <input v-model="form.ngaysinh" type="date" class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('ngaysinh') }" name="ngaysinh"
                                                placeholder="Ngày sinh">
                                            <div v-if="form.errors.has('ngaysinh')" class="invalid-feedback">
                                                <strong>{{ form.errors.get('ngaysinh') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="sdt">Số điện thoại</label>
                                    <input v-model="form.sdt" type="number" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('sdt') }" name="sdt"
                                        placeholder="Số điện thoại">
                                    <div v-if="form.errors.has('sdt')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('sdt') }}</strong>
                                    </div>
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="diachi">Địa chỉ</label>
                                    <input v-model="form.diachi" type="text" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('diachi') }" name="diachi"
                                        placeholder="Địa chỉ">
                                    <div v-if="form.errors.has('diachi')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('diachi') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="hoten">Email</label>
                                    <input v-model="form.email" type="email" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('email') }" name="email"
                                        placeholder="Email">
                                    <div v-if="form.errors.has('email')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('email') }}</strong>
                                    </div>
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="password">Mật khẩu</label>
                                    <input v-model="form.password" type="password" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('password') }" name="password"
                                        placeholder="Mật khẩu">
                                    <div v-if="form.errors.has('password')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('password') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Group (Roles)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="vaitro_id">Vai trò</label>
                                <select class="form-control" :class="{ 'is-invalid': form.errors.has('vaitro_id') }" name="vaitro_id" v-model="form.vaitro_id">
                                    <option value="" class="form-control">Vai trò</option>
                                    <option v-for="item in ds_vt" v-bind:value="item.id">
                                        {{ item.tenvaitro }}
                                    </option>
                                </select>
                                <div v-if="form.errors.has('vaitro_id')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('vaitro_id') }}</strong>
                                    </div>
                            </div>
                            <!-- Submit button-->
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <router-link to="/user" class="btn btn-primary float-right">Quay lại</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import Form from 'vform'

export default {
    data() {
        return {
            // api: 'http://localhost:8000/api/user',
            form: new Form({
                id: '',
                hoten: '',
                diachi: '',
                sdt: '',
                email: '',
                vaitro_id: '',
                hinhanh: '',
                password: '',
                gioitinh: 1,
                ngaysinh: '',
            }),
            ds_vt: {},
        }
    },
    methods: {
        // getIMG(hinhanh) {
        //     return `http://localhost:8000/images/${hinhanh}`
        // },

        saveImage(e) {
            this.form.hinhanh = e.target.files[0]
        },

        saveUser() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.form.post('user', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.$swal(
                    'Thành công!',
                    res.data.message,
                    'success'
                )
                this.$router.push('/user')
            }).catch(() => {
                this.$swal(
                    'Lỗi!',
                    'Có lỗi xảy ra.',
                    'error'
                )
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
                this.ds_vt = res.data
            })
        },

    },

    created() {
        this.getVT();
    },



}      
</script>


