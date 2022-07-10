<template>
    <div class="login-form-container">
        <form @submit.prevent="forgotPass" class="user">
            <input v-model="email" type="email" class="box" aria-describedby="emailHelp" placeholder="Nhập email...">
            <span style="color: red;" v-if="errors['email']" v-html="errors['email']">
            </span>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Đặt lại mật khẩu
            </button>
        </form>
    </div>
</template>
<script>
// import axios from 'axios'
export default {
    data() {
        return {
            email: '',
            errors: {}
        }
    },

    methods: {
        forgotPass() {
            this.axios.post('http://localhost:8000/api/forgotKH', {
                email: this.email,
            }).then(res => {
                this.$router.push('/reset/' + res.data.token);
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    },
}
</script>