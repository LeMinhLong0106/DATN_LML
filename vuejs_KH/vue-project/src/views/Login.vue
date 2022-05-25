<template>
    <div class="login-form-container">
        <form @submit.prevent="loginsubmit()">
            <h3>Login form</h3>
            <input type="email" v-model="user.email" placeholder="Nhập email" id="" class="box">
            <input type="password" v-model="user.matkhau" placeholder="Nhập mật khẩu" id="" class="box">
            <div class="remember">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">remember me</label>
            </div>
            <input type="submit" value="Đăng nhập" class="btn">
            <p>forget password? <a href="#">click here</a></p>
            <p>don't have an account?
                <router-link to="/registor">create one</router-link>
            </p>
        </form>
        <!-- <a :href="url('/redirectToGoogle')" class="btn btn-primary btn-block">Đăng
                                            nhập Google</a> -->
        <!-- <button  @click="loginGG()">Đăng nhập GG</button> -->
        <button @click="loginGG()" class="btn">Đăng nhập GG</button>
        <!-- <button @click="authProvider('google')" class="btn">Sign up with Google</button> -->
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
            errors: {}
        }
    },

    methods: {
        // authProvider(provider) {
        //     let self = this;
        //     this.$auth.authenticate(provider).then(response => {
        //         self.socialLogin(provider, response)
        //     }).catch(err => {
        //         console.log({ err: err })
        //     })
        // },
        // socialLogin(provider, response) {
        //     this.$http.post('http://127.0.0.1:8000/api/social/' + provider, response).then(response => {
        //         return response.data.token;
        //     }).catch(err => {
        //         console.log({ err: err })
        //     })
        // },

        // async loginGG() {
        //     const googleUser = await this.$gAuth.signIn();
        //     console.log("googleUser", googleUser);
        // },

        loginGG() {
            this.axios.get('http://127.0.0.1:8000/api/login/google').then(response => {
                // console.log(response.data.url);
                if (response.data.url) {
                    window.location.href = response.data.url;
                }
                // this.$router.push('/');//redirect to home page
            })
        },



        loginsubmit() {
            this.axios.post('http://127.0.0.1:8000/api/khachhang/login', this.user).then(response => {
                // console.log(response.data.id);
                this.idKH = response.data.id;
                window.localStorage.setItem('token', response.data.token);//store token in local storage
                window.localStorage.setItem('idKH', response.data.id);

                this.$router.push('/');//redirect to home page
            }).catch(error => {
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
    // mounted() {
    //     this.checkLogin();
    // },

    created() {
        this.checkLogin();
    }

}
</script>