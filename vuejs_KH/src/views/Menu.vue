<template>
    <div>
        <!-- <div>
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
    </div> -->
        <div class="container grid">
            <div class="input-group mb-3 mt-3">
                <input type="search" class="form-control" style="height: 40px; font-size: 16px;"
                    placeholder="Tìm kiếm..." v-model="search">
                <div class="input-group-prepend">
                    <button @click="searchI" class="input-group-text"><img src="../assets/search.svg"
                            style="width: 26px;"></button>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="row col-6 pb-4 pr-1">
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown">Giá
                            <span style="color:#f2be00;">{{ sortButton }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" @click="sortDate">Từ cao-thấp</a>
                            <a class="dropdown-item" @click="sortPrice">Từ thấp-cao</a>
                        </div>
                    </div>
                </div>
                <div class="row col-6 flex-row-reverse">
                    <div class="view-button">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle d-block d-lg-none d-xl-none" role="button"
                                id="MenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Danh
                                mục</button>
                            <div class="dropdown-menu" aria-labelledby="MenuLink">
                                <a class="dropdown-item" v-for="item in danhmucs" @click="sortI(item.tendm)">{{
                                        item.tendm
                                }}</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" @click="reSet">Tất cả</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col col-xl-3 col-lg-3 d-none d-lg-block d-xl-block">
                        <div class="card-selector">
                            <div class="card-body p-5">
                                <div class="search-title">
                                    <h4>Danh mục:
                                        <span style="color:#f2be00;">{{ danhmuc }}</span>
                                    </h4>
                                    <div class="dropdown-divider"></div>

                                    <h4 @click="reSet">Tất cả</h4>

                                    <h4 v-for="item in danhmucs" @click="sortI(item.tendm)">{{ item.tendm }}</h4>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12 text-center">
                        <div v-if="this.monans == 0" class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4 style="margin-left:9rem;margin-right:9rem">Xin lỗi, món ăn hiện
                                chưa có, mong quý khách thông cảm!!!
                            </h4>
                        </div>

                        <div v-for="item in monans" class="col-6 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-4 pb-3"
                            :key="item.id">
                            <div class="card">
                                <img class="card-img-top" :src="getIMG(item.hinhanh)">
                                <div class="overlay">
                                    <!-- <button type="button" class="btn btn-outline-secondary btn-lg"
                                        @click="addtoCart(item)">Thêm</button> -->
                                    <!-- <router-link to="/Info"> -->
                                    <button type="button" class="btn btn-outline-secondary btn-lg"
                                        @click="detail(item)">Chi tiết</button>
                                    <!-- </router-link> -->
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">{{ item.tenmonan }}</h3>
                                    <h4 class="card-text">${{ item.gia }}</h4>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 py-5">
                            <button type="button" @click="incCardNumber"
                                class="btn btn-outline-secondary btn-lg btn-block">More
                                +</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
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
            monanss: [],
            danhmucs: [],
            detailmonan: {},
            active: {
                monan_show: true,
            },
            search: '',
            danhmuc: '',
            sortButton: '',
        }
    },
    // computed: {
    //     danhsachmonan() {
    //         // return this.monans = this.monanss.filter(monan => {
    //         //     return monan.tenmonan.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
    //         // })
    //         return this.monans.filter(monan => {
    //             return monan.tenmonan.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
    //         })
    //     },
    // },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
        getData() {
            this.axios.get('http://127.0.0.1:8000/api/menu').then(res => {
                console.log(res.data.danhmucs);
                this.monans = res.data.monans;
                this.monanss = res.data.monans;
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
        },
        sortDate() {
            this.monans.sort((a, b) => {
                return b.gia - a.gia;
            })
            return this.sortButton = 'giảm dần';
        },
        sortPrice() {
            this.monans.sort((a, b) => {
                return a.gia - b.gia;
            })
            return this.sortButton = 'tăng dần';
        },
        sortI(tendm) {
            this.monans = this.monanss.filter(monan => {
                return monan.danhmucmonss.tendm == tendm;
            })
            this.danhmuc = tendm;
        },
        reSet() {
            this.monans = this.monanss;
            this.danhmuc = '';
        },
        searchI() {
            this.monans = this.monanss.filter(monan => {
                return monan.tenmonan.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
            })
        },
    },

    created() {
        this.getData();
        // this.getDanhMuc()
    },

}
</script>


<style>
.container.grid {
    min-height: 60rem;
}

.container.grid a {
    cursor: pointer !important;
}

.btn-light {
    color: black !important;
    background: white;
    border-radius: 0 !important;
    border: 1px solid grey !important;
}

.dropdown-menu {
    background-color: #eee;
    color: #2c3539;
}

.dropdown-menu>a:hover {
    background-color: #dae0e5
}

.btn-outline-secondary {
    border-radius: 0 !important;
}

/*search options*/

.card-selector {
    color: #DCDCDC;
    /* height: 40rem; */
    background: #2c3539 !important;
    box-shadow: 0 8px 6px 0 rgba(0, 0, 0, 0.1), 0 26px 70px 0 rgba(0, 0, 0, 0.69);
}

.search-title h4 {
    cursor: pointer;
}

.circle {
    height: 17px;
    width: 17px;
    border-radius: 50%;
    border: 0.7px solid #2c3539;
    display: inline-block;
    margin-left: 6px;
    cursor: pointer
}

/* transition Group style */
.fade-move {
    transition: transform 1s;
}

/* Card Style */
.card {
    transition: 500ms;
    position: relative;
    overflow: hidden;
}

.card img {
    z-index: 1;
}

.card button {
    width: 140px;
    margin-bottom: 10px;
}

.card:hover img {
    filter: blur(4px);
}

.card:hover .overlay {
    opacity: 0.8;

}

.card .overlay {
    position: absolute;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 70%;
    background-color: #232b34;
    opacity: 0;
    z-index: 100;
    transition: all 0.3s ease-in;
}

.card:hover,
.card:active {
    transform: scaleY(1.1) scaleX(1.06);
    box-shadow: 0 14px 98px rgba(0, 0, 0, 0.25), 0 0px 60px rgba(0, 0, 0, 0.22);
}
</style>