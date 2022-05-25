<template>
    <section class="popular" id="popular">

        <div class="heading">
            <span>popular food</span>
            <h3>our special dishes</h3>
        </div>

        <div class="box-container">
            <!-- <Toasts :show-progress="true" :rtl="false" :max-messages="5" :time-out="3000" :closeable="true"></Toasts> -->

            <div class="box" v-for="(todo, index) in monan_moi" :key="index">
                <a href="#" class="fas fa-heart"></a>
                <div class="image">
                    <img src="images/food-1.png" alt="">
                </div>
                <div class="content">
                    <h3>{{ todo.tenmonan }}</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span> (50) </span>
                    </div>
                    <div class="price">{{ todo.gia }}/{{ todo.donvitinh }}</div>
                    <div class="btn" @click="addToCart(todo)">add to cart</div>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
export default {
    name: 'PopularSection',
    data() {
        return {
            monan_moi: [],
            monan_db: [],
        }
    },
    methods: {
        getDM() {
            this.axios.get('http://127.0.0.1:8000/api/majestic').then(res => {
                // console.log(res.data.monan_moi);
                this.monan_moi = res.data.monan_moi;
            })
        },
        addToCart(item) {
            this.$store.commit('addToCart', item);
            this.$swal(
                'Thành công!',
                'Thêm thành công',
                'success'
            )

            // console.log(item);
        },
    },

    created() {
        this.getDM();
    },

}
</script>