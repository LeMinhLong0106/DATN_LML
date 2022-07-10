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
import BaseRequest from '../core/BaseRequest';
export default {
    data() {
        return {
            ds_cthd: {},
        }
    },
    methods: {
        getCook() {
            BaseRequest.get('listCook').then(res => {
                this.ds_cthd = res.data.cthd
            }).catch(() => {
                this.$router.push('/');
            })
        },

    },

    created() {
        // this.getCook();
        setInterval(() => {
            this.getCook();
        }, 3000);
    },




}    
</script>