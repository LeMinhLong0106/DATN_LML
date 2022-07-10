<template>
    <div class="login-form-container">
        <form @submit.prevent="resetPass">
            <h3>Quên mật khẩu</h3>
            <input v-model="matkhau" type="password" class="box" placeholder="Nhập mật khẩu...">
            <input v-model="password_confirmation" type="password" class="box" placeholder="Nhập lại mật khẩu...">

            <button type="submit" class="btn btn-primary btn-user btn-block">
                Đặt lại
            </button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            matkhau: '',
            password_confirmation: '',
        }
    },

    methods: {
        // async resetPass() {
        //     const res = await this.axios.post('http://localhost:8000/api/resetKH', {
        //         matkhau: this.matkhau,
        //         password_confirmation: this.password_confirmation,
        //         token: this.$route.params.token,
        //     })
        //     console.log(res.data)
        //     this.$router.push('/login')
        // },
        
        resetPass(){
            this.axios.post('http://localhost:8000/api/resetKH', {
                matkhau: this.matkhau,
                password_confirmation: this.password_confirmation,
                token: this.$route.params.token,
            })
            .then(() => {
                this.$router.push('/login')
            })
            .catch(error => {
                this.errors = error.response.data.errors
            })
        }
    },

}
</script>