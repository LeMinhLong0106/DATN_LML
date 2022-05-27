<template>
    <div>
        <!-- start menu -->
        <!-- <section class="sidenav">
            <nav class="nav__container">
                <div>
                    <div class="nav__list">
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Menu</h3>
                            <div v-for="(todo, index) in danhmucs" :key="index">
                                <a href="" :id="index" class="nav__link">
                                    <span class="nav__name">{{ todo.tendm }}</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </nav>
        </section> -->
        <!-- end menu -->

        <!-- <div v-for="(dm, index) in danhmucs" :key="index">
            <section class="popular" id="">
                <div>
                    <h3>{{ dm.tendm }}</h3>
                    <div class="box-container">
                        <div v-for="(ma, index) in monans" :key="index">

                                <div class="box"  v-if="dm.id == ma.danhmuc">
                                    <div class="image">
                                        <img src="" alt="">
                                    </div>
                                    <div class="content">
                                        <h3>{{ ma.tenmonan }}</h3>
                                        <div class="price">{{ ma.gia }}</div>
                                        <a href="" class="btn">Chi tiết</a>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </section>
        </div> -->
        
        <section class="popular">
            <input type="search" name="timkiem" v-model="search" placeholder="Tìm kiếm..." id="search-box">
            
            <div class="box-container">
                <div class="box" v-for="ma in danhsachmonan">
                    <div class="image">
                        <img :src="getIMG(ma.hinhanh)">
                    </div>
                    <div class="content">
                        <h3>{{ ma.tenmonan }}</h3>
                        <div class="price">{{ ma.gia }}/{{ ma.donvitinh }}</div>
                        <button type="button" class="btn" @click="detail(ma)">Chi tiết</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- {{dm.monan}} -->
        <!-- <div v-for="(dm, index) in danhmucs" :key="index">
            <section class="popular">
                <div>
                    <h3>teen danh muc: {{ dm.tendm }}</h3>

                    <div class="box-container">
                        <div class="box" v-for="ma in dm.monan">
                            <div class="image">
                                <img :src="getIMG(ma.hinhanh)" >
                            </div>
                            <div class="content">
                                <h3>{{ ma.tenmonan }}</h3>
                                <div class="price">{{ ma.gia }}/{{ ma.donvitinh }}</div>
                                <button type="button" class="btn" @click="detail(ma)">Chi tiết</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> -->

        <!-- <Detail :detailmonan="detailmonan" :active="active.monan_show" /> -->


    </div>
</template>

<script setup>
// import Detail from './Detail.vue';
</script>

<script>
export default {
    name: 'menu',
    data() {
        return {
            monans: [],
            danhmucs: [],
            detailmonan: {},
            active: {
                monan_show: true,
            },
            search: '',
        }
    },
    computed: {
        danhsachmonan() {
            return this.monans.filter(monan => {
                return monan.tenmonan.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
            })
        },
        // danhsachmonana() {
        //     return this.monans.filter(monan => monan.tenmonan.toLowerCase().includes(this.search.toLowerCase()))
        // },
        // danhsachmonan() {
        //     return this.danhmucs.filter(danhmuc => {
        //         return danhmuc.monan.filter(monan => monan.tenmonan.toLowerCase().includes(this.search.toLowerCase()))
        //     })
        // },
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
        getData() {
            this.axios.get('http://127.0.0.1:8000/api/menu').then(res => {
                console.log(res.data.danhmucs);
                this.monans = res.data.monans;
                this.danhmucs = res.data.danhmucs;
                // this.m = res.data.monans;
            })
        },
        detail(ma) {
            this.detailmonan = ma;
            // console.log(this.detailmonan);
            this.$router.push({
                name: 'detail',
                params: {
                    id: ma.id
                }
            })
        }
    },

    created() {
        this.getData();
    },
}
</script>