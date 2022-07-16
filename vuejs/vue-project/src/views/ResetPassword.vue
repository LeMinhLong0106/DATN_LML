<template>
    <div class="container">
        <h2 class="text-center">Thay đổi mật khẩu</h2>
        <div class="alert alert-primary">
            <form v-on:submit.prevent="sendToken">
                <div class="form-group">
                    <label>Nhập email</label>
                    <input v-model="email" type="email" class="form-control form-control-user"
                        v-bind:class="{ 'is-invalid': errEmail }" placeholder="Email...">
                    <div class="invalid-feedback">
                        {{ errEmail }}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Gửi mã xác nhận
                </button>
            </form>
        </div>

        <div class="alert alert-secondary">
            <form v-on:submit.prevent="validateToken">
                <div class="form-group">
                    <label>Mã xác nhận</label>
                    <input v-model="token" type="text" class="form-control form-control-user"
                        v-bind:class="{ 'is-invalid': errToken }" placeholder="Mã xác nhận...">
                    <div class="invalid-feedback">
                        {{ errToken }}
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary btn-user btn-block">
                    Kiểm tra mã xác nhận
                </button>
            </form>
        </div>

        <div class="alert alert-success" v-if="tokenValid">
            <form v-on:submit.prevent="resetPass">
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input v-model="newPassword" type="password" class="form-control form-control-user"
                        v-bind:class="{ 'is-invalid': errNewPassword }" placeholder="Password...">
                    <div class="invalid-feedback">
                        {{ errNewPassword }}
                    </div>
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input v-model="password_confirmation" type="password" class="form-control form-control-user"
                        v-bind:class="{ 'is-invalid': errPassword_confirmation }" placeholder="Confirm Password...">
                    <div class="invalid-feedback">
                        {{ errPassword_confirmation }}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Đặt lại mật khẩu
                </button>
            </form>
        </div>
        <div class="text-center">
            <router-link to="/login" class="small"><button class="btn btn-primary ">Quay lại đăng nhập</button> </router-link>
        </div>
    </div>
</template>
<script>
// import axios from 'axios'
export default {
    // props: ['email'],
    data() {
        return {
            email: '',
            errEmail: null,
            token: '',
            errToken: null,
            tokenValid: false,
            newPassword: '',
            errNewPassword: null,
            password_confirmation: '',
            errPassword_confirmation: null,
        }
    },

    methods: {
        sendToken() {
            this.errEmail = null;
            this.errToken = null;
            this.errNewPassword = null;
            this.errPassword_confirmation = null;
            if (this.email == '') {
                this.errEmail = 'Email không được để trống';
                return;
            }
            this.axios.post('/sendToken', {
                email: this.email
            }).then(res => {
                console.log(res.data)
                this.token = res.data.token;
                this.tokenValid = true;
            }).catch(err => {
                console.log(err.response.data)
                this.errToken = err.response.data.message;
            })
        },

        validateToken() {
            this.errToken = null;
            this.errNewPassword = null;
            this.errPassword_confirmation = null;
            if (this.token == '') {
                this.errToken = 'Mã xác nhận không được để trống';
                return;
            }
            this.axios.post('/validateToken', {
                token: this.token
            }).then(res => {
                console.log(res.data)
                this.tokenValid = true;
            }).catch(err => {
                console.log(err.response.data)
                this.errToken = err.response.data.message;
            })
        },

        resetPass() {
            this.errNewPassword = null;
            this.errPassword_confirmation = null;
            if (this.newPassword == '') {
                this.errNewPassword = 'Mật khẩu không được để trống';
                return;
            }
            if (this.password_confirmation == '') {
                this.errPassword_confirmation = 'Xác nhận mật khẩu không được để trống';
                return;
            }
            if (this.newPassword != this.password_confirmation) {
                this.errPassword_confirmation = 'Xác nhận mật khẩu không đúng';
                return;
            }
            this.axios.post('/resetPass', {
                password: this.newPassword,
                token: this.token
            }).then(res => {
                console.log(res.data)
                this.tokenValid = false;
                this.$router.push('/');
            }).catch(err => {
                console.log(err.response.data)
                this.errPassword_confirmation = err.response.data.message;
            })
        },
    },
}
</script>