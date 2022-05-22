<template>
  <div>

    <HomeSection />

    <!-- food section starts  -->
    <FoodSection />
    <!-- food section ends -->

    <!-- popular section starts  -->
    <PopularSection />
    <!-- popular section ends -->

   </div>
</template>

<script setup>
import HomeSection from '@/components/HomeSection.vue'
import FoodSection from '@/components/FoodSection.vue'
import PopularSection from '@/components/PopularSection.vue'
</script>