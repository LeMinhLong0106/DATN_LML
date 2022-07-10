<template>
  <div class="login-form-container">
    <form @submit.prevent="registorsubmit()">
      <h3>Đăng ký</h3>
      <input class="box" placeholder="Nhập tên" v-model="user.tenkh">
      <span style="color: red;" v-if="errors['tenkh']" v-html="errors['tenkh']">
      </span>
      <input class="box" placeholder="Nhập email" v-model="user.email">
      <span style="color: red;" v-if="errors['email']" v-html="errors['email']">
      </span>
      <input class="box" placeholder="Nhập số điện thoại" v-model="user.sdt">
      <span style="color: red;" v-if="errors['sdt']" v-html="errors['sdt']">
      </span>
      <input class="box" placeholder="Nhập địa chỉ" v-model="user.diachi">
      <span style="color: red;" v-if="errors['diachi']" v-html="errors['diachi']">
      </span>
      <input class="box" placeholder="Nhập mật khẩu" v-model="user.matkhau">
      <span style="color: red;" v-if="errors['matkhau']" v-html="errors['matkhau']">
      </span>
      <!-- <div class="remember">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">remember me</label>
            </div> -->

      <input type="submit" value="Đăng ký" class="btn">
      <!-- <p>forget password? <a href="#">click here</a></p> -->
      <p>Đã có tài khoản !!!
        <router-link to="/login">đăng nhập</router-link>
      </p>
    </form>
  </div>
</template>


<script>
export default {
  data() {
    return {
      user: {
        tenkh: '',
        email: '',
        sdt: '',
        diachi: '',
        matkhau: ''
      },
      errors: {}
    }
  },
  methods: {
    registorsubmit() {
      this.axios.post('http://localhost:8000/api/customer/register', this.user)
        .then(() => {
          this.$router.push('/login')
        })
        .catch(error => {
          this.errors = error.response.data.errors
        })
    }

    // async registorsubmit() {
    //   await this.axios.post('customer/register', this.user)
    //   this.$router.push('/login')
    //   // console.log(res)
    // }
  }
}
</script>
