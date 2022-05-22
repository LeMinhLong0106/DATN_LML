<template>
<!-- http://www.voerro.com/en/tutorials/r/simple-persistent-shopping-cart-implementation-with-vuejs-2-and-vuex-in-laravel-5/2 -->
    <nav class="navbar is-primary">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                Voerro Shopping Cart Tutorial
            </a>

            <div class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="navbarExampleTransparentExample" class="navbar-menu">
            <div class="navbar-end">
                <Cart />
            </div>
        </div>
    </nav>

    <div class="section content">
        <h1>Our Products</h1>
        <ProductsList />
    </div>
</template>

<script setup>
import ProductsList from '../components/ProductsList.vue'
import Cart from '../components/Cart.vue'
</script>