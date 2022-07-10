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
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form @submit.prevent="forgotPass" class="user">
                                        <div class="form-group">
                                            <input v-model="email" type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/registor" class="small" href="register.html">Create an
                                            Account!</router-link>
                                    </div>
                                    <div class="text-center">
                                        <router-link to="/login" class="small">Already have an account? Login!
                                        </router-link>
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
// import axios from 'axios'
export default {
    data() {
        return {
            email: '',
        }
    },

    methods: {
        forgotPass() {
            this.axios.post('http://localhost:8000/api/forgot', {
                email: this.email,
            }).then(res => {
                // console.log(res.data.token);
                this.$router.push('/reset/' + res.data.token);
            }).catch(err => {
                console.log(err);
            });
        }
    },
}
</script>