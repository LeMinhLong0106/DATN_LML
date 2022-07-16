<template>
    <div class="login-form-container">
        <form @submit.prevent="loginsubmit()">
            <h3>Đăng nhập</h3>
            <div>
                <input v-model="user.email" type="email" class="box" placeholder="Nhập email...">
                <div v-if="errors.email">
                    <strong>{{ errors.email[0] }}</strong>
                </div>
            </div>
            <div>
                <input type="hidden" class="form-control" :class="{ 'is-invalid': errEmail }">
                <div v-if="errEmail" class="invalid-feedback">
                    <strong>{{ errEmail }}</strong>
                </div>
            </div>
            <div>
                <input v-model="user.matkhau" type="password" class=" box" placeholder="Nhập mật khẩu...">
                <div v-if="errors.matkhau">
                    <strong>{{ errors.matkhau[0] }}</strong>
                </div>
            </div>
            <div>
                <input type="hidden" class="form-control" :class="{ 'is-invalid': errPassword }">
                <div v-if="errPassword" class="invalid-feedback">
                    <strong>{{ errPassword }}</strong>
                </div>
            </div>
            <!-- <div class="remember">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">remember me</label>
            </div> -->
            <input type="submit" value="Đăng nhập" class="btn">
            <button @click="loginGG()" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Đăng nhập với Google
            </button>
            <p>
                <router-link to="/forgot">Quên mật khẩu?</router-link>
            </p>
            <p>Bạn chưa có tài khoản?
                <router-link to="/registor">tạo tài khoản</router-link>
            </p>
        </form>
        <!-- <button @click="loginGG()" class="btn">Đăng nhập GG</button> -->

    </div>
</template>


<script>
export default {
    data() {
        return {
            idKH: '',
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
        loginGG() {
            this.axios.get('http://127.0.0.1:8000/api/login/google').then(response => {
                console.log(response.data);
                if (response.data.url) {
                    window.location.href = response.data.url;
                }
                this.$store.dispatch('user', response.data);//
                // this.$router.push('/');//redirect to home page
            })
        },

        loginsubmit() {
            this.axios.post('http://127.0.0.1:8000/api/customer/login', this.user).then(response => {
                // console.log(response.data);

                this.idKH = response.data.id;
                window.localStorage.setItem('token', response.data.token);//store token in local storage
                window.localStorage.setItem('idKH', response.data.id);

                this.$store.dispatch('user', response.data);

                this.$router.push('/');//redirect to home page
                // this.$router.back();//redirect to previous page

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
        //kiểm tra đã đn chưa
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
<style scoped>
.btn-google {
    color: #fff;
    background-color: #ea4335;
    border-color: #fff;
}

strong {
    color: red;
    font-size: 1.2rem;
}
</style>