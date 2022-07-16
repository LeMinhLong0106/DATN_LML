<template>
    <div>
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Chào mừng bạn trở lại!</h1>
                                        </div>
                                        <form @submit.prevent="loginsubmit()">
                                            <div class="form-group">
                                                <input v-model="user.email" type="email"
                                                    class="form-control form-control-user"
                                                    :class="{ 'is-invalid': errors.email }" placeholder="Nhập email...">
                                                <div v-if="errors.email" class="invalid-feedback">
                                                    <strong>{{ errors.email[0] }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control"
                                                    :class="{ 'is-invalid': errEmail }">
                                                <div v-if="errEmail" class="invalid-feedback">
                                                    <strong>{{ errEmail }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input v-model="user.password" type="password"
                                                    class="form-control form-control-user"
                                                    :class="{ 'is-invalid': errors.password }"
                                                    placeholder="Nhập mật khẩu...">
                                                <div v-if="errors.password" class="invalid-feedback">
                                                    <strong>{{ errors.password[0] }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control"
                                                    :class="{ 'is-invalid': errPassword }">
                                                <div v-if="errPassword" class="invalid-feedback">
                                                    <strong>{{ errPassword }}</strong>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div> -->
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Đăng nhập
                                            </button>
                                            <hr>
                                        </form>
                                        <div class="text-center">
                                            <!-- <router-link class="small" to="/forgot">Quên mật khẩu?</router-link> -->
                                            <router-link class="small" to="/reset-password">Quên mật khẩu?</router-link>
                                        </div>
                                        <!-- <div class="text-center">
                                            <router-link to="/registor" class="small" href="register.html">Create an
                                                Account!</router-link>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            errors: {},
            errPassword: '',
            errEmail: ''
        }
    },

    methods: {

        loginsubmit() {
            this.axios.post('http://localhost:8000/api/login', this.user).then(response => {
                window.localStorage.setItem('token', response.data.token);//store token in local storage
                this.$router.push('/');//redirect to home page
            }).catch(error => {
                if (error.response.status == 401) {
                    this.errPassword = error.response.data.errPassword;
                    this.errors = '';
                    this.errEmail = '';
                } else if (error.response.status == 404) {
                    this.errEmail = error.response.data.errEmail;
                    this.errors = '';
                    this.errPassword = '';
                } else {
                    this.errors = error.response.data.errors;
                    this.errPassword = '';
                    this.errEmail = '';
                }
            })
        },
        checkLogin() {
            let token = window.localStorage.getItem('token');
            if (token) {
                this.$router.push('/');
            }
        },
    },
    created() {
        this.checkLogin();
    }

}
</script>