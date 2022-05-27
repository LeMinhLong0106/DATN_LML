<template>
    <div>
        
        <section class="food-preview-container">
            <div class="food-preview">
                <img :src="getIMG(monans.hinhanh)">
                <h3>{{ monans.tenmonan }}</h3>
                <p>{{ monans.mota }}</p>


                <p>Danh mục: {{ monans.danhmucmonss.tendm }}</p>
                <div class="price">{{ monans.gia }}/{{ monans.donvitinh }}</div>

                <div v-if="monans.tinhtrang == 1">
                    Số lượng:<input type="number" v-model="monans.quantity" class="form-control" min="1"
                        style="width: 100px;">
                    Ghi chú:<input type="text" v-model="monans.note" class="form-control" style="width: 100px;">
                    <button class="btn btn-danger" @click="addToCart(monans)">Thêm vào giỏ hàng</button>
                </div>
                <div v-else>
                    <button class="btn btn-danger" disabled>Đã hết hàng</button>
                </div>
            </div>
        </section>
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
