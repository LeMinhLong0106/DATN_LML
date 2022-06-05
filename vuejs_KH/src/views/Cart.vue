<template>
    <div>
        <div v-if="$store.state.cart.length > 0">
            <section class="shopping-cart-container">
                <div class="products-container">
                    <h3 class="title">Thông tin giỏ hàng</h3>
                    <div class="box-container">
                        <div class="box" v-for="item in $store.state.cart" :key="item.id">
                            <i class="fas fa-times" @click.prevent="removeFromCart(item)"></i>
                            <!-- <img src="images/menu-1.png" alt=""> -->
                            <img :src="getIMG(item.hinhanh)">
                            <div class="content">
                                <h3>{{ item.tenmonan }}</h3>
                                <span> Số lượng: </span>
                                <input type="number" name="" v-model="item.quantity" min="1"
                                    @change="updateSoluong(item.id, item.quantity)">
                                <br>
                                <span> Ghi chú: </span>
                                <input type="text" v-model="item.note">
                                <br>
                                <span> Giá: </span>
                                <span class="price"> {{ item.gia }} </span>
                                <!-- <span class="price"> {{ item.gia.toLocaleString() }} </span> -->
                                <br>
                                <span> Tổng: </span>
                                <span class="price"> {{ item.totalPrice }} </span>
                                <!-- <span class="price"> {{ item.totalPrice.toLocaleString() }} </span> -->
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
                                        <span style="color: red;" v-if="errors['hoten']" v-html="errors['hoten']">
                                        </span>
                                    </div>
                                    <div class="inputBox">
                                        <span>Số điện thoại</span>
                                        <input v-model="sdt" type="number" placeholder="Số điện thoại">
                                        <span style="color: red;" v-if="errors['sdt']" v-html="errors['sdt']">
                                        </span>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="inputBox">
                                        <span>Địa chỉ</span>
                                        <input v-model="diachi" type="text" placeholder="Địa chỉ giao">
                                        <span style="color: red;" v-if="errors['diachi']" v-html="errors['diachi']">
                                        </span>
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
            tongtien: 0,

            errors: {},
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
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },

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
                    // alert('Đặt hàng thành công');
                    this.$swal(
                        'Thành công!',
                        'Đã xác nhận đặt hàng.',
                        'success'
                    )
                    this.$store.commit('clearCart');// xóa giỏ hàng
                }).catch(error => {
                    this.errors = error.response.data.errors;
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

<style scoped>
.shopping-cart-container {
  /* position: fixed; */
  top: 8.5rem;
  left: 0;
  right: 0;
  /* z-index: 1000; */
  /* height: calc(100vh - 8.5rem); */
  background: #fff;
  overflow-y: scroll;
  padding-bottom: 8rem;
  /* display: none; */
}

.shopping-cart-container.active {
  display: block;
}

.shopping-cart-container::-webkit-scrollbar {
  width: 1rem;
}

.shopping-cart-container::-webkit-scrollbar-track {
  background: #fff;
}

.shopping-cart-container::-webkit-scrollbar-thumb {
  background: #130f40;
  border-radius: 5rem;
}

.shopping-cart-container .title {
  font-size: 2.5rem;
  padding: 1rem;
  color: #130f40;
  border-bottom: 0.1rem solid rgba(0, 0, 0, 0.2);
  text-align: center;
}

.shopping-cart-container .products-container {
  border: 0.1rem solid rgba(0, 0, 0, 0.2);
  border-radius: .5rem;
  -webkit-animation: fadeUp .4s linear;
  animation: fadeUp .4s linear;
}

.shopping-cart-container .products-container .box-container {
  display: -ms-grid;
  display: grid;
  -ms-grid-columns: (minmax(30rem, 1fr))[auto-fit];
  grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
  gap: 1.5rem;
  padding: 1.5rem;
}

.shopping-cart-container .products-container .box-container .box {
  border-radius: .5rem;
  background: #f7f7f7;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  gap: 1.5rem;
  padding: 2rem;
  position: relative;
}

.shopping-cart-container .products-container .box-container .box .fa-times {
  position: absolute;
  top: .7rem;
  right: 1rem;
  font-size: 2rem;
  cursor: pointer;
  color: #130f40;
}

.shopping-cart-container .products-container .box-container .box .fa-times:hover {
  color: #fdd117;
}

.shopping-cart-container .products-container .box-container .box img {
  height: 8rem;
}

.shopping-cart-container .products-container .box-container .box .content h3 {
  font-size: 2rem;
  color: #130f40;
}

.shopping-cart-container .products-container .box-container .box .content span {
  font-size: 1.5rem;
  color: #666;
}

.shopping-cart-container .products-container .box-container .box .content span.price {
  color: #fdd117;
  font-size: 1.7rem;
}

.shopping-cart-container .products-container .box-container .box .content input {
  width: 8rem;
  padding: .5rem 1.2rem;
  font-size: 1.5rem;
  color: #130f40;
  margin: .2rem 0;
}

.shopping-cart-container .cart-total {
  margin-top: 2rem;
  border: 0.1rem solid rgba(0, 0, 0, 0.2);
  border-radius: .5rem;
  -webkit-animation: fadeUp .4s linear .4s backwards;
  animation: fadeUp .4s linear .4s backwards;
}

.shopping-cart-container .cart-total .box {
  padding: 1.5rem;
}

.shopping-cart-container .cart-total .box h3 {
  color: #130f40;
  font-size: 2rem;
  padding-bottom: .7rem;
}

.shopping-cart-container .cart-total .box h3 span {
  color: #fdd117;
}

.order .icons-container {
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: (minmax(30rem, 1fr))[auto-fit];
    grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.order .icons-container .icons {
    border-radius: .5rem;
    padding: 2rem;
    text-align: center;
    background: #f7f7f7;
}

.order .icons-container .icons img {
    height: 10rem;
}

.order .icons-container .icons h3 {
    font-size: 2rem;
    color: #130f40;
    margin-top: .5rem;
}

.order form {
    background: #f7f7f7;
    padding: 2rem;
    border-radius: .5rem;
}

.order form .flex {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.order form .flex .inputBox {
    width: 49%;
    padding: .7rem 0;
}

.order form .flex span {
    font-size: 1.7rem;
    color: #666;
}

.order form .flex input,
.order form .flex textarea {
    width: 100%;
    margin-top: .5rem;
    padding: 1rem 1.2rem;
    width: 100%;
    border-radius: .5rem;
    font-size: 1.6rem;
    text-transform: none;
    color: #130f40;
}

/* .order form .flex textarea {
  resize: none;
} */

.order form .flex .map {
    height: 100%;
    width: 100%;
    border-radius: .5rem;
}
</style>