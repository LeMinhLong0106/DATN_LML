<template>
  <div>
    <div class="container">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản!</h1>
                </div>
                <form @submit.prevent="registorsubmit()">
                  <div class="form-group">
                    <input v-model="user.hoten" type="text" class="form-control form-control-user"
                      :class="{ 'is-invalid': errors.hoten }" placeholder="Họ và tên">
                    <div v-if="errors.hoten" class="invalid-feedback">
                      <strong>{{ errors.hoten[0] }}</strong>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input v-model="user.diachi" type="text" class="form-control form-control-user"
                        :class="{ 'is-invalid': errors.diachi }" placeholder="Địa chỉ...">
                      <div v-if="errors.diachi" class="invalid-feedback">
                        <strong>{{ errors.diachi[0] }}</strong>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <input v-model="user.sdt" type="text" class="form-control form-control-user"
                        :class="{ 'is-invalid': errors.sdt }" placeholder="Số điện thoại">
                      <div v-if="errors.sdt" class="invalid-feedback">
                        <strong>{{ errors.sdt[0] }}</strong>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <input v-model="user.email" type="email" class="form-control form-control-user"
                      :class="{ 'is-invalid': errors.email }" placeholder="Email Address">
                    <div v-if="errors.email" class="invalid-feedback">
                      <strong>{{ errors.email[0] }}</strong>
                    </div>
                  </div>

                  <div class="form-group">
                    <input v-model="user.password" type="password" class="form-control form-control-user"
                      :class="{ 'is-invalid': errors.password }" placeholder="Password">
                    <div v-if="errors.password" class="invalid-feedback">
                      <strong>{{ errors.password[0] }}</strong>
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input v-model="user.password" type="password" class="form-control form-control-user"
                        :class="{ 'is-invalid': errors.password }" placeholder="Password">
                      <div v-if="errors.password" class="invalid-feedback">
                        <strong>{{ errors.password[0] }}</strong>
                      </div>

                    </div>
                    <div class="col-sm-6">
                      <input v-model="user.password_confirm" type="password" class="form-control form-control-user"
                        :class="{ 'is-invalid': errors.password_confirm }" placeholder="Repeat Password">
                      <div v-if="errors.password_confirm" class="invalid-feedback">
                        <strong>{{ errors.password_confirm[0] }}</strong>
                      </div>
                    </div>
                  </div> -->
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Register Account
                  </button>
                  <hr>
                </form>
                <div class="text-center">
                  <router-link class="small" to="/forgot">Forgot Password?</router-link>
                </div>
                <div class="text-center">
                  <router-link to="/login" class="small">Already have an account? Login!</router-link>
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
        hoten: '',
        diachi: '',
        sdt: '',
        email: '',
        password: ''
      },
      errors: {}
    }
  },
  methods: {
    registorsubmit() {
      this.axios.post('http://localhost:8000/api/register', this.user)
        .then(response => {
          this.$router.push('/login')
        })
        .catch(error => {
          this.errors = error.response.data.errors
        })
    }
  }
}
</script>
