<template>

    <div class="px-4 mt-4">
        <form @submit.prevent="updateMon" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Hình ảnh nhân viên</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2 w-100" :src="getIMG(ds_nv.hinhanh)">
                            <!-- Profile picture help block-->
                            <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                            <!-- Profile picture upload button-->
                            <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                            <input @change="updateImage" type="file" class="form-control" name="hinhanh">

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
                                    <input v-model="ds_nv.hoten" type="text" class="form-control" name="hoten"
                                        placeholder="Họ tên">
                                    <div class="text-danger error-text " v-if="errors['hoten']"
                                        v-html="errors['hoten']">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="hoten">Giới tính</label>
                                            <br>
                                            <input type="radio" value="1" checked v-model="ds_nv.gioitinh" />
                                            Nam
                                            <input type="radio" value="0" v-model="ds_nv.gioitinh" />
                                            Nữ
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="hoten">Ngày sinh</label>
                                            <input v-model="ds_nv.ngaysinh" type="date" class="form-control"
                                                name="ngaysinh">
                                            <div class="text-danger error-text " v-if="errors['ngaysinh']"
                                                v-html="errors['ngaysinh']">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="sdt">Số điện thoại</label>
                                    <input v-model="ds_nv.sdt" type="number" class="form-control" name="sdt"
                                        placeholder="Số điện thoại">
                                    <div class="text-danger error-text " v-if="errors['sdt']" v-html="errors['sdt']">
                                    </div>
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="diachi">Địa chỉ</label>
                                    <input v-model="ds_nv.diachi" type="text" class="form-control" name="diachi"
                                        placeholder="Địa chỉ">
                                    <div class="text-danger error-text " v-if="errors['diachi']"
                                        v-html="errors['diachi']">
                                    </div>
                                </div>
                            </div>

                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input v-model="ds_nv.email" type="email" class="form-control" name="email"
                                        placeholder="Email">
                                    <div class="text-danger error-text " v-if="errors['email']"
                                        v-html="errors['email']">
                                    </div>
                                </div>
                                <!-- Form Group (last name)-->
                                <!-- <div class="col-md-6">
                                    <label class="small mb-1" for="password">Mật khẩu</label>
                                    <input v-model="ds_nv.password" type="password" class="form-control" name="password"
                                        placeholder="Mật khẩu">
                                    <div class="text-danger error-text " v-if="errors['password']"
                                        v-html="errors['password']">
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="vaitro_id">Vai trò</label>
                                    <select class="form-control" name="vaitro_id" v-model="ds_nv.vaitro_id">
                                        <option value="" class="form-control">Vai trò</option>
                                        <option v-for="item in ds_vt" v-bind:value="item.id">
                                            {{ item.tenvaitro }}
                                        </option>
                                    </select>
                                    <div class="text-danger error-text " v-if="errors['vaitro_id']"
                                        v-html="errors['vaitro_id']">
                                    </div>
                                </div>
                            </div>

                            <!-- Form Group (Roles)-->
                            <!-- <div class="mb-3">
                                <label class="small mb-1" for="vaitro_id">Vai trò</label>
                                <select class="form-control" name="vaitro_id" v-model="ds_nv.vaitro_id">
                                    <option value="" class="form-control">Vai trò</option>
                                    <option v-for="item in ds_vt" v-bind:value="item.id">
                                        {{ item.tenvaitro }}
                                    </option>
                                </select>
                                <div class="text-danger error-text " v-if="errors['vaitro_id']"
                                    v-html="errors['vaitro_id']">
                                </div>
                            </div> -->
                            <!-- Submit button-->
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <router-link to="/user" class="btn btn-primary float-right">Quay lại</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            // api: 'http://localhost:8000/api/user',
            ds_nv: {},
            ds_vt: {},
            errors: {},
        }
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },

        updateImage(e) {
            this.hinhanh = e.target.files[0]
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
            formData.append('gioitinh', this.ds_nv.gioitinh);
            formData.append('ngaysinh', this.ds_nv.ngaysinh);
            // formData.append('password', this.ds_nv.password);
            formData.append('vaitro_id', this.ds_nv.vaitro_id);
            formData.append('hinhanh', this.hinhanh);
            this.axios.post('http://localhost:8000/api/update_nv/' + this.$route.params.id, formData, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.$router.push('/user');
                this.$swal(
                    'Thành công!',
                    res.data.message,
                    'success'
                )
            }).catch(err => {
                // console(err);
                this.errors = err.response.data.errors;
                // console.log(this.errors);
                this.$swal(
                    'Lỗi!',
                    'Có lỗi xảy ra.',
                    'error'
                )
            })
        },

        // getNV() {
        //     this.axios.get('user/' + this.$route.params.id).then(response => {
        //         this.ds_nv = response.data;
        //     })
        // },

        // getVT() {
        //     this.axios.get('role').then(res => {
        //         this.ds_vt = res.data
        //     })
        // },
    },

    // created() {
    //     this.getNV();
    //     this.getVT();
    // },

    async created() {
        let token = window.localStorage.getItem('token');
        if (token == null) {
            this.$router.push('/login');
        }
        const id = parseInt(this.$route.params.id);
        if (!id) {
            this.$router.push('/404');
        }
        const [user, role] = await Promise.all([
            this.axios.get('user/' + id, {
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }),
            this.axios.get('role', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }),
        ]);
        // console.log(user.data.id);
        if (!user.data.id) {//nếu không tồn tại id trong database
            this.$router.push('/404');
        } else {
            this.ds_nv = user.data;
            this.ds_vt = role.data;
        }
    },

}      
</script>