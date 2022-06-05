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
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <form @submit.prevent="loginsubmit()">
                                            <div class="form-group">
                                                <input v-model="user.email" type="email"
                                                    class="form-control form-control-user"
                                                    :class="{ 'is-invalid': errors.email }"
                                                    placeholder="Email Address...">

                                                <div v-if="errors.email" class="invalid-feedback">
                                                    <strong>{{ errors.email[0] }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input v-model="user.password" type="password"
                                                    class="form-control form-control-user"
                                                    :class="{ 'is-invalid': errors.password }" placeholder="Password">
                                                <div v-if="errors.password" class="invalid-feedback">
                                                    <strong>{{ errors.password[0] }}</strong>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <hr>

                                            <!-- <button type="submit" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                            </button> -->
                                        </form>
                                        <!-- <button @click="loginGG()" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </button> -->
                                        <!-- <button @click.prevent="authProvider('google')">Sign up with Google</button> -->
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <router-link to="/registor" class="small" href="register.html">Create an
                                                Account!</router-link>
                                        </div>
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
            errors: {}
        }
    },

    methods: {

        loginsubmit() {
            this.axios.post('http://127.0.0.1:8000/api/login', this.user).then(response => {
                window.localStorage.setItem('token', response.data.token);//store token in local storage
                this.$router.push('/');//redirect to home page
            }).catch(error => {
                console.log(error.response.data.errors);
                this.errors = error.response.data.errors;
            })
        },
        checkLogin() {
            let token = window.localStorage.getItem('token');
            if (token) {
                this.$router.push('/');
            }
        },
    },
    mounted() {
        this.checkLogin();
    }

}
</script>