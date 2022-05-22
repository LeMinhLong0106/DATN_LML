<script setup>
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
</script>


<template>
  <div>
    <div class="wrapper">
      <Header />

      <router-view></router-view>

      <Footer />
    </div>
  </div>
</template>
