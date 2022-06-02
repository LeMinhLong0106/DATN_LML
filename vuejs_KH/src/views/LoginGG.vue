<template>
    <div class="login-form-container">
        <form>
            <h3>Login form</h3>
            <input type="email" placeholder="Nhập email" id="" class="box">
            <input type="password" placeholder="Nhập mật khẩu" id="" class="box">
            <div class="remember">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">remember me</label>
            </div>
            <input type="submit" value="Đăng nhập" class="btn">
            <button class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Login with Google
            </button>
            <p>forget password? <a href="#">click here</a></p>
            <p>don't have an account?
                <a>create one</a>
            </p>
        </form>
    </div>
</template>

<script>
export default {
    name: 'LoginGG',

    methods: {
        loginGGcallBack() {
            this.axios.get('http://127.0.0.1:8000/api/login/google/callback', {
                params: {
                    code: this.$route.query.code
                }
            }).then(response => {
                window.localStorage.setItem('token', response.data.access_token);//store token in local storage
                window.localStorage.setItem('idKH', response.data.user['id']);

                if (response.data.url) {
                    window.location.href = response.data.url;
                }
                this.$store.dispatch('user', response.data.user);
                this.$router.push('/');
            })
        },
    },
    created() {
        this.loginGGcallBack();
    },

}
</script>