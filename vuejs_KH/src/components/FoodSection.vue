<template>

    <section class="food" id="food">
        <div class="heading">
            <h3>{{ tendm }}</h3>
        </div>
        <Swiper :breakpoints="swiperOptions.breakpoints" :modules="[Navigation, Pagination, A11y, Virtual]" navigation>
            <SwiperSlide v-for="(todo, index) in monan_db" :key="index">
                <div class="food-slide" style="text-align: center;">
                    <div class="food-img">
                        <img :src="getIMG(todo.hinhanh)" style="width: 50rem; ">
                    </div>
                    <div class="food-content">
                        <h3 class="mt-2">{{ todo.tenmonan }}</h3>
                        <div class="price">{{ todo.gia.toLocaleString("de-DE") }}/{{ todo.donvitinh }}</div>
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
            monan_db: [],
            tendm: '',
            swiperOptions: {
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    1025: {// when window width is >= 1025px
                        slidesPerView: 2,
                        spaceBetween: 50
                    }
                }
            }
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

        // getDM() {
        //     this.axios.get('http://127.0.0.1:8000/api/majestic').then(res => {
        //         this.monan_db = res.data.monan_db;
        //         this.tendm = res.data.monan_db['0'].danhmucmonss.tendm
        //     }).catch(err => {
        //         console.log(err);
        //     })
        // },

        async getDM() {
            const res = await this.axios.get('majestic')
            this.monan_db = res.data.monan_db;
            this.tendm = res.data.monan_db['0'].danhmucmonss.tendm
        },
    },

    created() {
        this.getDM();
    },

    // async created() {
    //     const res = await this.axios.get('majestic')
    //     this.monan_db = res.data.monan_db;
    //     this.tendm = res.data.monan_db['0'].danhmucmonss.tendm
    // },

}
</script>
<style>
.food-content {
    font-size: 2rem;
    color: #130f40;
}
</style>