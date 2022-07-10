<template>
    <section class="user-details">

        <div class="user">
            <img src="../assets/user-icon.png" alt="">
            <p><i class="fas fa-user"></i> <span>Họ tên: {{ user.tenkh }}</span></p>
            <p><i class="fas fa-phone"></i> <span>Số điện thoại: {{ user.sdt }}</span></p>
            <p><i class="fas fa-envelope"></i> <span>Email: {{ user.email }}</span></p>
            <p class="address"><i class="fas fa-map-marker-alt"></i> <span>Địa chỉ: {{ user.diachi }}</span></p>
        </div>
    </section>
</template>

<script>
export default {
    // computed: {
    //     user() {
    //         return this.$store.getters.user;
    //     },
    // },

    data() {
        return {
            user: {},
        }
    },
    methods: {
        getCus() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            else {
                this.axios.get('http://localhost:8000/api/getCus/' + window.localStorage.getItem('idKH'), {
                    headers: {
                        Authorization: 'Bearer ' + token
                    }
                }).then(response => {
                    this.user = response.data;
                }).catch(() => {
                    this.$router.push('/login');
                })
            }
        },
    },

    created() {
        this.getCus();
    },
}  
</script>

<style scoped>
.user-details {
    margin-top: 100px;
}

.user-details .user {
    border: .2rem solid #222;
    padding: 2rem;
    max-width: 40rem;
    margin: 0 auto;
}

.user-details .user img {
    width: 100%;
    height: 15rem;
    object-fit: contain;
    margin-bottom: 2rem;
}

.user-details .user p {
    line-height: 1.5;
    margin-bottom: .5rem;
    font-size: 2rem;
}

.user-details .user p span {
    color: #222;
}

.user-details .user i {
    margin-right: .7rem;
    color: #777;
}

/* .user-details .user p.address {
    margin-top: 2rem;
} */
</style>