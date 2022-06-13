<template>
    <section class="orders">
        <!-- hóa dơn: {{ user.hoadonss }} -->
        <br>
        <!-- oorder {{ order }} -->
        <h1 class="title">Đơn hàng</h1>
        <div class="box-container" v-if="orders.length > 0">
            <div class="box" v-for="item in orders">
                <p> Ngày đặt: <span>{{ format_date(item.created_at) }}</span> </p>
                <p> Tên người nhận: <span>{{ item.hoten }}</span> </p>
                <p> Số điện thoại: <span>{{ item.sdt }}</span> </p>
                <p> Địa chỉ: <span>{{ item.diachi }}</span> </p>
                <p> Món ăn: <span v-for="i in item.monanss" class="text-lowercase">{{ i.tenmonan }}, </span> </p>
                <!-- <p> your orders : <span>pizza 01 (1) - main dish 02 (3) -</span> </p> -->
                <p> Tổng tiền: <span>{{ item.tongtien }}</span> </p>
                <p> Tình trạng đơn:
                    <span class="text-success" v-if="item.tinhtrang == 1"> đã giao</span>
                    <span class="text-danger " v-else>đang chờ xử lý</span>
                </p>
            </div>
        </div>
        <div class="box-container" v-else>
            <div class="box">
                <h2> Hiện chưa có đơn nào </h2>
            </div>
        </div>
    </section>

</template>

<script>
import moment from 'moment'

export default {
    data() {
        return {
            orders: null,
            monan: [],
        }
    },
    // computed: {
    //     user() {
    //         return this.$store.getters.user;
    //     },
    //     order() {
    //         return this.$store.getters.order;
    //     },
    // },
    methods: {
        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        getOrder() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://localhost:8000/api/getOrder', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                console.log(response.data);
                // console.log(response.data['0'].monanss['0'].tenmonan);
                this.orders = response.data;
                // this.monan = response.data.monans;
            }).catch(error => {
                // console.log(error.message);
                this.$router.push('/');
            })
        },
    },

    created() {
        this.getOrder();
    },
}  
</script>

<style scoped>
h2 {
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
}
.title {
    text-align: center;
    margin-bottom: 3rem;
    font-size: 4rem;
    color: #130f40;
    text-transform: uppercase;
    text-decoration: underline;
    text-underline-offset: 1rem;
}

.orders {
    margin-top: 90px;
}

.orders .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
    gap: 1.5rem;
    align-items: flex-start;
}

.orders .box-container .box {
    border: var(--border);
    padding: 1rem 2rem;
}

.orders .box-container .box p {
    font-size: 2rem;
    color: var(--light-color);
    line-height: 2;
}

.orders .box-container .box p span {
    color: var(--black);
}
</style>