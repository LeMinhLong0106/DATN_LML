<template>
    <div class="container detail">
        <div class="row mb-5 mt-5">
            <div class="col6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <img class="img-fluid" :src="getIMG(monans.hinhanh)">
            </div>

            <div class="col6 col-xl-6 col-lg-6 col-md-12 col-sm-12 align-items-center ">
                <div class="info pt-xl-0 pt-lg-0 pt-5">
                    <h1 class="font-weight-bold text-uppercase pt-3">{{ monans.tenmonan }}</h1>
                    <h4>{{ monans.gia }}/{{ monans.donvitinh }}</h4>
                    <h4>Danh mục: {{ monans.danhmucmonss.tendm }}</h4>
                    <h4>Mô tả: {{ monans.mota }}</h4>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span style="font-size: 1.5rem;" class="input-group-text">Số lượng, ghi chú</span>
                        </div>
                        <input style="height: 40px; font-size: 1.5rem;" type="number" v-model="monans.quantity"
                            class="form-control" min="1">
                        <input style="height: 40px; font-size: 1.5rem;" type="text" v-model="monans.note"
                            class="form-control">
                    </div>

                    <button class="btn btn-danger" @click="addToCart(monans)">Thêm vào giỏ hàng</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            monans: {
                id: '',
                tenmonan: '',
                hinhanh: '',
                gia: '',
                mota: '',
                donvitinh: '',
                tinhtrang: '',
                danhmucmonss: {
                    tendm: ''
                },
                quantity: '',
                note: '',
            },
        }
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
        getMon() {
            this.axios.get('http://localhost:8000/api/detail/' + this.$route.params.id).then(response => {
                // this.monans = response.data;
                this.monans.hinhanh = response.data['hinhanh'];
                this.monans.tenmonan = response.data['tenmonan'];
                this.monans.gia = response.data['gia'];
                this.monans.mota = response.data['mota'];
                this.monans.donvitinh = response.data['donvitinh'];
                this.monans.tinhtrang = response.data['tinhtrang'];
                this.monans.danhmucmonss = response.data['danhmucmonss'];
                this.monans.id = response.data['id'];
                this.monans.quantity = 1;
                this.monans.note = '';
                // console.log(this.monans.danhmucmonss);
            })
        },

        addToCart(item) {
            console.log(item);
            this.$store.commit('addCart', item);
            // console.log(item);
            this.$swal(
                'Thành công!',
                'Thêm thành công',
                'success'
            )
            this.$router.push('/menu');
        },

        // addCart(monan) {

        // },
        // addCart(monan) {
        //     let token = window.localStorage.getItem('token');
        //     if (token == null) {
        //         this.$router.push('/login');
        //     }
        //     this.axios.post('http://localhost:8000/api/cart', {
        //         monan_id: monan.id,
        //         quantity: this.monan.quantity,
        //         note: this.monan.note,
        //     }, {
        //         headers: {
        //             Authorization: 'Bearer ' + token
        //         }
        //     }).then(response => {
        //         // console.log(response.data)
        //         this.$router.push('/cart');
        //     })
        // },
    },
    created() {
        this.getMon();
    },
}
</script>
<style>
.detail {
    margin-top: 100px;
}
</style>