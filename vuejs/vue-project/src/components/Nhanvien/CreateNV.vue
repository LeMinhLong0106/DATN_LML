<template>
    <div class="px-4 mt-4">
        <form @submit.prevent="saveMon" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <!-- <img class="img-account-profile rounded-circle mb-2" :src="getIMG()"> -->
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                            <input @change="saveImage" type="file" class="form-control" name="hinhanh">
                            <div class="text-danger error-text " v-if="form.errors.has('hinhanh')"
                                v-html="form.errors.get('hinhanh')"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="hoten">Tên nhân viên</label>
                                    <input v-model="form.hoten" type="text" class="form-control" name="hoten"
                                        placeholder="Họ tên">
                                    <div class="text-danger error-text " v-if="form.errors.has('hoten')"
                                        v-html="form.errors.get('hoten')"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="hoten">Giới tính</label>
                                    <br>
                                    <input type="radio" value="1" checked v-model="form.gioitinh" />
                                    Nam

                                    <input type="radio" value="0" v-model="form.gioitinh" />
                                    Nữ
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="hoten">Số điện thoại</label>
                                    <input v-model="form.sdt" type="number" class="form-control" name="sdt"
                                        placeholder="Số điện thoại">
                                    <div class="text-danger error-text " v-if="form.errors.has('sdt')"
                                        v-html="form.errors.get('sdt')">
                                    </div>
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Địa chỉ</label>
                                    <input v-model="form.diachi" type="text" class="form-control" name="diachi"
                                        placeholder="Địa chỉ">
                                    <div class="text-danger error-text " v-if="form.errors.has('diachi')"
                                        v-html="form.errors.get('diachi')"></div>
                                </div>
                            </div>

                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="hoten">Email</label>
                                    <input v-model="form.email" type="email" class="form-control" name="email"
                                        placeholder="Email">
                                    <div class="text-danger error-text " v-if="form.errors.has('email')"
                                        v-html="form.errors.get('email')"></div>
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="password">Mật khẩu</label>
                                    <input v-model="form.password" type="password" class="form-control" name="password"
                                        placeholder="Mật khẩu">
                                    <div class="text-danger error-text " v-if="form.errors.has('password')"
                                        v-html="form.errors.get('password')"></div>
                                </div>
                            </div>

                            <!-- Form Group (Roles)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="vaitro_id">Vai trò</label>
                                <select class="form-control" name="vaitro_id" v-model="form.vaitro_id">
                                    <option value="" class="form-control">Vai trò</option>
                                    <option v-for="item in ds_vt" v-bind:value="item.id">
                                        {{ item.tenvaitro }}
                                    </option>
                                </select>
                                <div class="text-danger error-text " v-if="form.errors.has('vaitro_id')"
                                    v-html="form.errors.get('vaitro_id')"></div>
                            </div>
                            <!-- Submit button-->
                            <button type="submit" class="btn btn-primary">Thêm</button>

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
            api: 'http://localhost:8000/api/nhanvien',
            form: new Form({
                id: '',
                hoten: '',
                diachi: '',
                sdt: '',
                email: '',
                vaitro_id: '',
                hinhanh: '',
                password: '',
                gioitinh: '',
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

        saveMon() {
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
                    this.$swal(
                        'Thành công!',
                        'nhân viên đã được thêm.',
                        'success'
                    )
                    this.$router.push('/nhanvien')

                })
                .catch(error => {
                    this.$swal(
                        'Error!',
                        'Your file has been deleted.',
                        'error'
                    )
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
        this.getVT();
    },



}      
</script>


