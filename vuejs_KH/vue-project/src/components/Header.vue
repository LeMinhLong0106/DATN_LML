<template>
    <div>
        <!-- search-form  -->
        <section class="search-form-container">
            <form @submit.prevent="timkiem">
                <input type="search" name="timkiem" placeholder="search here..." id="search-box">
                <label for="search-box" class="fas fa-search"></label>
            </form>
        </section>

        <header class="header">
            <a href="#" class="logo"> <img src="images/majestic.png"> Majestic </a>

            <nav class="navbar">
                <router-link to="/">Trang chủ</router-link>
                <router-link to="/about">Thông tin</router-link>
                <router-link to="/menu">Thực đơn</router-link>
                <router-link to="/test">TEST</router-link>
            </nav>

            <div class="icons">
                <div @click="menu" id="menu-btn" class="fas fa-bars"></div>
                <div @click="search" id="search-btn" class="fas fa-search"></div>
                <router-link to="/cart">
                    <div id="cart-btn" class="fas fa-shopping-cart">
                        <span class="badge"></span>
                    </div>
                </router-link>
                <router-link to="/login">
                    <div id="login-btn" class="fas fa-user"></div>
                </router-link>

                <div @click="logout()" id="login-btn" class="fas fa-user"></div>
            </div>
        </header>
    </div>

</template>

<script>

export default {
    methods: {
        menu() {
            document.querySelector('.header .navbar').classList.toggle('active')
            document.querySelector('.search-form-container').classList.remove('active')
        },
        search() {
            document.querySelector('.search-form-container').classList.toggle('active')
            document.querySelector('.header .navbar').classList.remove('active')
        },
        logout() {
            window.localStorage.removeItem('token');
            window.localStorage.removeItem('idKH');
            this.$router.push('/login');
        },
        timkiem() {
            this.$router.push('/search/' + this.timkiem);
            
        }
    }
}  
</script>

