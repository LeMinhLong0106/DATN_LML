

<template>
  <div>
    <Header />
    <router-view />
    <Footer />
  </div>
</template>

<script>
// import axios from 'axios'
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'

export default {
  name: 'App',
  components: {
    Header,
    Footer,
  },
}
</script>
<style>
* {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  outline: none;
  border: none;
  text-decoration: none;
  -webkit-transition: .2s linear;
  transition: .2s linear;
}

html {
  font-size: 62.5%;
  overflow-x: hidden;
  scroll-behavior: smooth;
  scroll-padding-top: 8.5rem;
}

html::-webkit-scrollbar {
  width: 1rem;
}

html::-webkit-scrollbar-track {
  background: #fff;
}

html::-webkit-scrollbar-thumb {
  background: #fdd117;
  border-radius: 5rem;
}

section {
  padding: 2rem 9%;
}

.heading {
  text-align: center;
  padding-bottom: 2rem;
}

.heading span {
  font-family: 'Satisfy', cursive;
  font-size: 3rem;
  color: #fdd117;
}

.heading h3 {
  font-size: 3rem;
  color: #130f40;
}

.btn {
  display: inline-block;
  margin-top: 1rem;
  padding: .7rem 1.8rem;
  font-size: 1.7rem;
  cursor: pointer;
  color: #fff;
  background: #d3b014;
  border-radius: .5rem;
}

.btn:hover {
  background: #97a216;
}

#menu-btn {
  display: none;
}

@-webkit-keyframes fadeUp {
  0% {
    -webkit-transform: translateY(5rem);
    transform: translateY(5rem);
    opacity: 0;
  }
}

@keyframes fadeUp {
  0% {
    -webkit-transform: translateY(5rem);
    transform: translateY(5rem);
    opacity: 0;
  }
}

.login-form-container {
  margin-top: 100px;
  background: #fff;
  padding: 0 2rem;
}

.login-form-container form {
  margin: 2rem auto;
  max-width: 40rem;
  -webkit-box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.05);
  box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.05);
  border: 0.1rem solid rgba(0, 0, 0, 0.2);
  padding: 2rem;
  border-radius: .5rem;
  -webkit-animation: fadeUp .4s linear;
  animation: fadeUp .4s linear;
}

.login-form-container form h3 {
  padding-bottom: 1rem;
  font-size: 2.5rem;
  text-transform: uppercase;
  color: #130f40;
}

.login-form-container form .box {
  margin: .7rem 0;
  border-radius: .5rem;
  background: #f7f7f7;
  padding: 1rem 1.2rem;
  font-size: 1.6rem;
  color: #130f40;
  text-transform: none;
  width: 100%;
}

.login-form-container form .remember {
  padding: 1rem 0;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  gap: .5rem;
}

.login-form-container form .remember label {
  font-size: 1.5rem;
  cursor: pointer;
  color: #666;
}

.login-form-container form .btn {
  margin: 1rem 0;
  width: 100%;
  text-align: center;
}

.login-form-container form p {
  padding-top: 1rem;
  font-size: 1.5rem;
  color: #666;
}

.login-form-container form p a {
  color: #fdd117;
}

.login-form-container form p a:hover {
  color: #130f40;
  text-decoration: underline;
}
/* slide */
:root {
  --peru: #fdd117;
  --black: #222;
  --white: #fff;
  --light-black: #666;
  --light-white: #ccc;
  --light-bg: #f5f5f5;
  --dark-bg: rgba(0, 0, 0, .7);
  --border: .1rem solid #aaa;
  --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
}

.food {
  background: #f5f5f5;
}

@media (max-width: 991px) {
  html {
    font-size: 55%;
  }

  .header {
    padding: 2rem;
  }

  section {
    padding: 2rem;
  }
}

@media (max-width: 768px) {
  #menu-btn {
    display: inline-block;
  }

  .header .navbar {
    position: absolute;
    top: 99%;
    left: 0;
    right: 0;
    background: #fff;
    border-top: 0.1rem solid rgba(0, 0, 0, 0.2);
    border-bottom: 0.1rem solid rgba(0, 0, 0, 0.2);
    -webkit-clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
    clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
  }

  .header .navbar.active {
    -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
  }

  .header .navbar a {
    font-size: 2rem;
    margin: 2rem;
    display: block;
  }

  .order form .flex .inputBox {
    width: 100%;
  }
}

@media (max-width: 450px) {
  html {
    font-size: 50%;
  }

  .shopping-cart-container .cart-total .box {
    text-align: center;
  }

  .shopping-cart-container .cart-total .box .btn {
    width: 100%;
  }

  .home .content h3 {
    font-size: 3rem;
  }

  .home .content p {
    font-size: 1.5rem;
  }
}

/*# sourceMappingURL=style.css.map */

.sidenav {
  position: fixed;
  top: 30%;
  height: 100vh;
  padding: 2rem 1rem 0;
  right: 0;
  /* box-shadow: 1px 0 0 rgba(22, 8, 43, 0.1); */
  z-index: 100;
  transition: .4s;
}

.nav__container {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding-bottom: 3rem;
}

.nav__logo {
  font-weight: var(--font-semi-bold);
  margin-bottom: 2.5rem;
}

.nav__list,
.nav__items {
  display: grid;
}

.nav__list {
  row-gap: 2.5rem;
}

.nav__items {
  row-gap: 1.5rem;
}

.nav__subtitle {
  font-size: var(--normal-font-size);
  text-transform: uppercase;
  letter-spacing: .1rem;
  color: var(--text-color-light);
}

.nav__link {
  display: flex;
  align-items: center;
  color: var(--text-color);
}

.nav__link:hover {
  color: var(--first-color);
}

.nav__icon {
  font-size: 1.2rem;
  margin-right: .5rem;
}

.nav__name {
  font-size: var(--small-font-size);
  font-weight: var(--font-medium);
}
</style>