<template>
    <div>
        <div v-if="$store.state.cart.length > 0">
            <section class="shopping-cart-container">
                <div class="products-container">
                    <h3 class="title">Thông tin giỏ hàng</h3>
                    <div class="box-container">
                        <div class="box" v-for="item in $store.state.cart" :key="item.id">
                            <i class="fas fa-times" @click.prevent="removeFromCart(item)"></i>
                            <img src="images/menu-1.png" alt="">
                            <div class="content">
                                <h3>{{ item.tenmonan }}</h3>
                                <span> Số lượng : </span>
                                <input type="number" name="" v-model="item.quantity" min="1"
                                    @change="updateSoluong(item.id, item.quantity)">
                                <!-- <br>
                                <span> note : </span>
                                <span class="price"> abc </span> -->
                                <br>
                                <span> Giá : </span>
                                <span class="price"> {{ item.gia.toLocaleString() }} </span>
                                <br>
                                <span> Tổng : </span>
                                <span class="price"> {{ item.totalPrice.toLocaleString() }} </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-total">
                    <h3 class="title"> Hóa đơn </h3>
                    <div class="box">
                        <h3 class="total"> Thành tiền : <span>{{ totalPrice }} VNĐ</span> </h3>
                        <div class="order" id="order">
                            <form @submit.prevent="thanhtoan()">
                                <div class="flex">
                                    <div class="inputBox">
                                        <span>Tên người nhận</span>
                                        <input v-model="hoten" type="text" placeholder="Tên người nhận">
                                    </div>
                                    <div class="inputBox">
                                        <span>Số điện thoại</span>
                                        <input v-model="sdt" type="number" placeholder="Số điện thoại">
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="inputBox">
                                        <span>Địa chỉ</span>
                                        <input v-model="diachi" type="text" placeholder="Địa chỉ giao">
                                    </div>
                                    <div class="inputBox">
                                        <span>Ghi chú</span>
                                        <input v-model="ghichu" type="text" placeholder="Ghi chú" id="">
                                    </div>
                                </div>
                                <input type="submit" value="Thanh toán" class="btn">
                            </form>

                        </div>
                    </div>
                </div>

            </section>
        </div>
        <div v-else>
            <section class="shopping-cart-container">
                <div class="products-container">
                    <h3 class="title">Không có sản phẩm nào trong giỏ hàng</h3>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            idKH: '',
            hoten: '',
            sdt: '',
            diachi: '',
            ghichu: '',
            tongtien: 0
        }
    },
    computed: {
        totalPrice() {
            let total = 0;

            for (let item of this.$store.state.cart) {
                total += item.totalPrice;
            }

            return total;
        },

        getKH() {
            return window.localStorage.getItem('idKH');
        }
    },
    methods: {
        removeFromCart(item) {
            this.$store.commit('removeFromCart', item);
        },
        updateSoluong(id, quantity) {
            this.$store.commit('updateSoluong', { id, quantity });
        },
        thanhtoan() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            else {
                // this.$router.push('/cart');
                let data = {
                    idKH: this.getKH,
                    hoten: this.hoten,
                    sdt: this.sdt,
                    diachi: this.diachi,
                    ghichu: this.ghichu,
                    tongtien: this.tongtien,
                    cart: this.$store.state.cart
                }

                this.axios.post('http://127.0.0.1:8000/api/checkout', data, {
                    headers: {
                        Authorization: 'Bearer ' + token
                    }
                }).then(res => {
                    console.log(res.data);
                    alert('Đặt hàng thành công');
                    this.$store.commit('clearCart');// xóa giỏ hàng
                }).catch(err => {
                    // console.log(err);
                })

            }

        },

    },
    created() {
        this.tongtien = this.totalPrice;
        this.idKH = this.getKH;
    }

}
</script>
