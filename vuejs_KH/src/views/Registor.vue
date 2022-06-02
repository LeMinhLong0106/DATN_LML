<template>
  <div class="login-form-container">
    <form @submit.prevent="registorsubmit()">
      <h3>Đăng ký</h3>
      <div class="form-group">
        <input class="box" placeholder="Nhập tên" v-model="user.tenkh">
      </div>
      <div class="form-group">
        <input class="box" placeholder="Nhập email" v-model="user.email">
      </div>
      <div class="form-group">
        <input class="box" placeholder="Nhập số điện thoại" v-model="user.sdt">
      </div>
      <div class="form-group">
        <input class="box" placeholder="Nhập địa chỉ" v-model="user.diachi">
      </div>
      <div class="form-group">
        <input class="box" placeholder="Nhập mật khẩu" v-model="user.matkhau">
      </div>
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
    // registorsubmit() {
    //   this.axios.post('khachhang/register', this.user)
    //     .then(response => {
    //       this.$router.push('/login')
    //     })
    //     .catch(error => {
    //       this.errors = error.response.data.errors
    //     })
    // }

    async registorsubmit() {
      await this.axios.post('khachhang/register', this.user)
      this.$router.push('/login')
      // console.log(res)
    }
  }
}
</script>
