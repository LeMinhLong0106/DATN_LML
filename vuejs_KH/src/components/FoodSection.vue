<template>
    <!-- <section class="food" id="food">
        <div class="heading">
            <span>poular disheps</span>
            <h3>our delicious food</h3>
        </div>

        <div class="swiper food-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide" data-name="food-1">
                    <img src="images/food-img-1.png" alt="">
                    <h3>delicious food</h3>
                    <div class="price">$49.99</div>
                </div>

                <div class="swiper-slide slide" data-name="food-2">
                    <img src="images/food-img-2.png" alt="">
                    <h3>delicious food</h3>
                    <div class="price">$49.99</div>
                </div>

                <div class="swiper-slide slide" data-name="food-3">
                    <img src="images/food-img-3.png" alt="">
                    <h3>delicious food</h3>
                    <div class="price">$49.99</div>
                </div>

                <div class="swiper-slide slide" data-name="food-4">
                    <img src="images/food-img-4.png" alt="">
                    <h3>delicious food</h3>
                    <div class="price">$49.99</div>
                </div>

                <div class="swiper-slide slide" data-name="food-5">
                    <img src="images/food-img-5.png" alt="">
                    <h3>delicious food</h3>
                    <div class="price">$49.99</div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section> -->

    <!-- <Swiper :slides-per-view="1" :space-between="50" :modules="[Navigation, Pagination, A11y, Virtual]" navigation
        :pagination="{ clickable: true, dynamicBullets: true }" grab-cursor virtual>
        <SwiperSlide v-for="(todo, index) in monan_moi" :key="index">
            <div class="food-slide" style="text-align: center;">
                <div class="food-img">
                    <img :src="getIMG(todo.hinhanh)" style="width: 50rem; ">
                </div>
                <div class="food-content">
                    <h3>{{ todo.tenmonan }}</h3>
                    <div class="price">{{ todo.gia }}/{{ todo.donvitinh }}</div>
                    <div v-if="todo.tinhtrang == 1" class="btn" @click="addToCart(todo)">Thêm vào giỏ</div>
                    <div v-else class="btn">Món ăn hết</div>
                </div>
            </div>
        </SwiperSlide>
    </Swiper> -->
    <section class="food" id="food">
        <div class="heading">
            <!-- <span>Món đặc biệt</span> -->
            <h3>Món đặc biệt</h3>
        </div>
        <Swiper :slides-per-view="1" :space-between="40" :modules="[Navigation, Pagination, A11y, Virtual]" navigation>
            <SwiperSlide v-for="(todo, index) in monan_moi" :key="index">
                <div class="food-slide" style="text-align: center;">
                    <div class="food-img">
                        <img :src="getIMG(todo.hinhanh)" style="width: 50rem; ">
                    </div>
                    <div class="food-content">
                        <h3 class="mt-2">{{ todo.tenmonan }}</h3>
                        <div class="price">{{ todo.gia }}/{{ todo.donvitinh }}</div>
                        <div v-if="todo.tinhtrang == 1" class="btn" @click="addToCart(todo)">Thêm vào giỏ</div>
                        <div v-else class="btn">Món ăn hết</div>
                    </div>
                </div>
            </SwiperSlide>
        </Swiper>
    </section>
</template>

<script setup>
import { Navigation, Pagination, A11y, Virtual } from 'swiper'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import 'swiper/css/bundle'
</script>

<script>
export default {
    data() {
        return {
            monan_moi: [],
            monan_db: [],
        }
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
        addToCart(item) {
            this.$store.commit('addToCart', item);
            this.$swal(
                'Thành công!',
                'Thêm thành công',
                'success'
            )
        },

        getDM() {
            this.axios.get('http://127.0.0.1:8000/api/majestic').then(res => {
                // console.log(res.data.monan_moi);
                this.monan_moi = res.data.monan_moi;
            })
        },
    },

    created() {
        this.getDM();
    },

}
</script>
<style>
.food-content {
    font-size: 2rem;
    color: #130f40;
}
</style>