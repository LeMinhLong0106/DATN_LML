<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Danh sách đặt món</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" v-if="ds_cthd.length > 0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Bàn</th>
                                        <th>Tên món ăn</th>
                                        <th>Số lượng</th>
                                        <th>Ghi chú</th>
                                        <th>Danh mục</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ctht in ds_cthd">
                                        <td v-if="ctht.ban_id">{{ ctht.ban_id }}</td>
                                        <td v-else>Online</td>
                                        <td> {{ ctht.tenmonan }} </td>
                                        <td>{{ ctht.soluong }}</td>
                                        <td>{{ ctht.ghichu }}</td>
                                        <td>{{ ctht.tendm }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center" v-else>
                            <h3>Hiện tại chưa có món</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    data() {
        return {
            ds_cthd: {},
        }
    },
    methods: {
        getCTHD() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/daubep', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_cthd = res.data.cthd
            }).catch(error => {
                // this.$router.push('/');
            })
        },

    },

    created() {
        // this.getCTHD();
        setInterval(() => {
            this.getCTHD();
        }, 3000);
    },




}    
</script>