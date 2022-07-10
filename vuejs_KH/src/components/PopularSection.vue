<template>
    <section class="popular" id="popular">
        <div class="heading">
            <!-- <span>Phổ biến</span> -->
            <h3>Món chính</h3>
        </div>

        <div class="box-container">
            <!-- <Toasts :show-progress="true" :rtl="false" :max-messages="5" :time-out="3000" :closeable="true"></Toasts> -->

            <div class="box" v-for="(todo, index) in monan_moi" :key="index">
                <!-- <a href="#" class="fas fa-heart"></a> -->
                <div class="image">
                    <!-- <img src="images/food-1.png" alt=""> -->
                    <img :src="getIMG(todo.hinhanh)">
                </div>
                <div class="content">
                    <h3>{{ todo.tenmonan }}</h3>
                    <!-- <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span> (50) </span>
                    </div> -->
                    <div class="price">{{ todo.gia.toLocaleString("de-DE") }}/{{ todo.donvitinh }}</div>
                    <div v-if="todo.tinhtrang == 1" class="btn" @click="addToCart(todo)">Thêm vào giỏ</div>
                    <div v-else class="btn">Món ăn hết</div>
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
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
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

<style scoped>
.popular .box-container {
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: (minmax(25rem, 1fr))[auto-fit];
    grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
    gap: 1.5rem;
}

.popular .box-container .box {
    border-radius: .5rem;
    position: relative;
    background: #f7f7f7;
    padding: 2rem;
    text-align: center;
}

.popular .box-container .box .fa-heart {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    font-size: 2.5rem;
    color: #666;
    cursor: pointer;
}

.popular .box-container .box .fa-heart:hover {
    color: #fdd117;
}

.popular .box-container .box .image {
    margin: 1rem 0;
}

.popular .box-container .box .image img {
    height: 15rem;
}

.popular .box-container .box .content h3 {
    font-size: 2rem;
    color: #130f40;
}

.popular .box-container .box .content .stars {
    padding: 1rem 0;
    font-size: 1.7rem;
}

.popular .box-container .box .content .stars i {
    color: gold;
}

.popular .box-container .box .content .stars span {
    color: #666;
}

.popular .box-container .box .content .price {
    font-size: 2rem;
    color: #130f40;
}

.popular .box-container .box .content .price span {
    font-size: 1.5rem;
    color: #666;
    text-decoration: line-through;
}
</style>