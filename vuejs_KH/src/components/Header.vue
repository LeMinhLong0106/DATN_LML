<template>

  <div>
    <header class="header sticky-top">
      <!-- <a href="#" class="logo"> <img src="images/majestic.png"> Majestic </a> -->
      <router-link class="text-decoration-none logo" to="/"><img src="../assets/majestic.png">Majestic</router-link>

      <nav class="navbar">
        <router-link class="text-decoration-none navlink" @click="removeNav" to="/">Trang chủ</router-link>
        <router-link class="text-decoration-none navlink" @click="removeNav" to="/about">Thông tin</router-link>
        <router-link class="text-decoration-none navlink" @click="removeNav" to="/menu">Thực đơn</router-link>
      </nav>

      <div @click="menu" id="menu-btn">
        <img src="../assets/menu.svg" aria-haspopup="true" aria-expanded="false" style="width: 26px;">
      </div>

      <ul class="navbar-item d-flex align-items-end list-unstyled">
        <!-- Nav Item - User Information -->
        <li v-if="user" class="nav-item">

          <a class="nav-link" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <h5>Chào, {{ user.tenkh }}</h5>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <router-link class="text-decoration-none" to="/profile">
              <button class="dropdown-item">
                Thông tin
              </button>
            </router-link>
            <router-link class="text-decoration-none" to="/order">
              <button class="dropdown-item">
                Đơn hàng
              </button>
            </router-link>
            <div class="dropdown-divider"></div>
            <button class="dropdown-item" @click="logout()">
              Đăng xuất
            </button>
          </div>

        </li>
        <li v-else>
          <router-link to="/login" class="text-decoration-none">
            <h5>Đăng nhập</h5>
          </router-link>
        </li>
        <router-link to="/cart">
          <div class="bag">
            <img class="pb-1" src="../assets/cart.svg">
            <span v-if="this.bagItemscount > 0">{{ bagItemscount }}</span>
          </div>
        </router-link>
      </ul>
    </header>
  </div>

</template>

<script>
export default {
  data() {
    return {
      checklog: false,
      soluong: '',
      // user: null,
    }
  },

  computed: {
    user() {
      return this.$store.getters.user;
    },

    bagItemscount() {
      return this.$store.getters.itemsNumber
    },


  },

  methods: {
    removeNav() {
      document.querySelector('.header .navbar').classList.toggle('active')
    },

    menu() {
      document.querySelector('.header .navbar').classList.toggle('active')
    },

    logout() {
      window.localStorage.removeItem('token');
      window.localStorage.removeItem('idKH');
      this.$store.dispatch('user', null);
      this.$store.commit('clearCart');

      this.$router.push('/login');
    },
  },

  async created() {
    const res = await this.axios.get('getCus')
    console.log(res.data)
    this.$store.dispatch('user', res.data)
    // this.$store.dispatch('order', res.data.order)
    this.removeNav()
    // this.user = res.data
    // console.log(res.data)
  }

  // created() {
  //     let token = window.localStorage.getItem('token');
  //     if (token == null) {
  //         this.checklog = false;
  //     }
  //     else {
  //         this.checklog = true;
  //     }
  // }
}  
</script>

<style scoped>
.header {
  position: fixed;
  width: 100%;
  background: #fff;
  box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.05);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 2rem 9%;
}

.header .logo {
  font-size: 2.5rem;
  font-weight: bolder;
  color: #130f40;
  display: flex;
  align-items: center;
}

.header .logo img {
  width: 5rem;
}

.header .logo i {
  padding-right: .5rem;
  color: #fdd117;
}

.header .navbar a {
  font-size: 1.7rem;
  margin: 0 1rem;
  color: #666;
}

.header .navbar a:hover {
  color: #fdd117;
}

.header .icons div {
  height: 4.5rem;
  width: 4.5rem;
  line-height: 4.5rem;
  font-size: 2rem;
  background: #f7f7f7;
  color: #130f40;
  border-radius: .5rem;
  margin-left: .3rem;
  cursor: pointer;
  text-align: center;
}

.header .icons div:hover {
  color: #fff;
  background: #fdd117;
}


nav {
  z-index: 100;
}

h5 {
  font-size: 1.7rem;
  text-decoration: none;
  color: black;
  margin-bottom: 0;
  cursor: pointer;
}

/* .navbar {
  border-bottom: 1px solid #DCDCDC;
  background-color: #F8F8F8;
} */

.close {
  position: relative;
  bottom: 20px;
  left: 10px;
  font-size: 31px;
  color: #000;
}

.navbar-item.bc a {
  font-size: 17px;
  text-decoration: none;
  color: black;
}

.navbar-item.bc a:hover,
.navbar-item.bc a:active {
  color: #FFD700;
}


.bag span {
  background-color: #fdd117;
  border-radius: 10px;
  color: white;
  position: absolute;
  font-size: 15px;
  line-height: 1;
  padding: 2px 3px 3px 3px;
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
  margin-left: -9px;
}

.bag img {
  cursor: pointer;
  width: 30px;
  height: auto;
}

.user {
  margin-right: 20px;
  padding-top: 10px;
}

.user:hover {
  text-decoration: underline;
}


.header .profile {
  width: 30rem;
  position: absolute;
  top: 120%;
  right: 2rem;
  background-color: var(--white);
  border: var(--border);
  padding: 1.5rem;
  text-align: center;
  display: none;
  animation: fadeIn .2s linear;
}

.header .profile.active {
  display: block;
}

.header .profile .name {
  font-size: 1.7rem;
  margin-bottom: .5rem;
}

.header .profile .account {
  font-size: 1.7rem;
  color: var(--light-color);
  margin-top: 1.5rem;
}

.header .profile .account a {
  color: var(--black);
  text-decoration: underline;
}

.header .profile .account a:hover {
  color: var(--yellow);
}
</style>

