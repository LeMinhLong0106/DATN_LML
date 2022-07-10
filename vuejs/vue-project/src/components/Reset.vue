<template>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        <!-- <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p> -->
                                    </div>
                                    <form @submit.prevent="resetPass">
                                        <div class="form-group">
                                            <input v-model="password" type="password"
                                                class="form-control form-control-user" placeholder="Enter Password...">
                                        </div>
                                        <div class="form-group">
                                            <input v-model="password_confirmation" type="password"
                                                class="form-control form-control-user"
                                                placeholder="Enter Password Confirm...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
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
// import axios from 'axios'
export default {
    data() {
        return {
            password: '',
            password_confirmation: '',
        }
    },

    methods: {
        async resetPass() {
            const res = await this.axios.post('reset', {
                password: this.password,
                password_confirmation: this.password_confirmation,
                token: this.$route.params.token,
            })
            console.log(res.data)
            this.$router.push('/login')
        }
    },


}
</script>