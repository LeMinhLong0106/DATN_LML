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
<script>

import HomeSection from '@/components/HomeSection.vue'
import FoodSection from '@/components/FoodSection.vue'
import PopularSection from '@/components/PopularSection.vue'

export default {
  components: {
    HomeSection,
    FoodSection,
    PopularSection
  },
}
</script>