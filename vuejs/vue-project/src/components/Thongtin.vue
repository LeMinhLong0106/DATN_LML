<template>

    <div class="px-4 mt-4">
        <form>
            <div class="row mb-3">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Hình ảnh</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2 w-100" :src="getIMG(user.hinhanh)">
                            <!-- Profile picture help block-->
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
                                    <p>{{ user.hoten }}</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="hoten">Giới tính</label>
                                            <p v-if="user.gioitinh == 1"> Nam </p>
                                            <p v-else> Nữ </p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="hoten">Ngày sinh</label>
                                            <p>{{ format_date(user.ngaysinh) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="sdt">Số điện thoại</label>
                                    <p>{{ user.sdt }}</p>

                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="diachi">Địa chỉ</label>
                                    <p>{{ user.diachi }}</p>

                                </div>
                            </div>

                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="email">Email</label>
                                    <p>{{ user.email }}</p>

                                </div>
                                <!-- Form Group (last name)-->
                                <!-- <div class="col-md-6">
                                    <label class="small mb-1" for="password">Mật khẩu</label>
                                    <input v-model="user.password" type="password" class="form-control" name="password"
                                        placeholder="Mật khẩu">
                                </div> -->
                                <div class="col-md-6">
                                    <label for="vaitro_id">Vai trò</label>
                                    <p>{{ vaitro }}</p>
                                </div>
                            </div>

                            <!-- Form Group (Roles)-->
                            <!-- <div class="mb-3">
                                <label for="vaitro_id">Vai trò</label>
                                <p>{{ vaitro }}</p>
                            </div> -->
                            <!-- Submit button-->
                            <!-- <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <router-link to="/user" class="btn btn-primary float-right">Quay lại</router-link> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    data() {
        return {
            user: {},
            vaitro: {},
        }
    },
    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
        getUser() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://localhost:8000/api/getuser', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                // console.log(res.data);
                this.user = res.data;
                this.vaitro = res.data.vaitross.mota;
            }).catch(err => {
                console.log(err);
            })
        },
    },

    created() {
        this.getUser();
    },

}      
</script>