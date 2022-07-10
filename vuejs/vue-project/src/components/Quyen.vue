<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Phân quyền</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <p> Vai trò
                    <select style="width:300px" class="form-control" name="vaitro_id" v-model="data.vaitro_id"
                        @change="changeAdmin">
                        <option v-for="item in ds_vt" v-bind:value="item.id">
                            {{ item.mota }}
                        </option>
                    </select>
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên quyền</th>
                                <th>Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in ds_q">
                                <td>{{ item.mota }}</td>
                                <td>
                                    <input type="checkbox" v-model="data.quyen" v-bind:value="item.id"
                                        v-bind:name="item.tenquyen" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary" @click="phanQuyen">Cập nhật</button>
            </div>
        </div>
    </div>
</template>

<script>
import BaseRequest from '../core/BaseRequest';
export default {
    data() {
        return {
            // api: 'http://localhost:8000/api/permission',
            data: {
                quyen: [],
                vaitro_id: null,
            },
            ds_q: {},
            ds_vt: {},
        }
    },
    methods: {
        changeAdmin() {
            let index = this.ds_vt.findIndex(item => item.id == this.data.vaitro_id);
            let quyen = this.ds_vt[index].quyens;
            if (quyen != null) {
                this.data.quyen = quyen.map(item => item.id)
            } else {
                this.data.quyen = [];
            }
        },
        phanQuyen() {
            let data = {
                vaitro_id: this.data.vaitro_id,
                quyen: this.data.quyen
                // resources: this.resources
            }
            BaseRequest.post('permission', data).then(response => {
                // console.log(response.data['tenvaitro']);
                if (response.data['tenvaitro'] == 'admin') {
                    this.$store.dispatch('quyen', response.data['quyens']);
                }
                this.$swal(
                    'Thành công!',
                    'Cập nhật phân quyền.',
                    'success'
                )
            })
        },

        getQuyen() {
            BaseRequest.get('permission').then(res => {
                // console.log(this.$route);
                this.ds_q = res.data
            })
        },

        getVT() {
            BaseRequest.get('role').then(res => {
                // console.log(res.data);
                this.ds_vt = res.data
                this.data.vaitro_id = this.ds_vt[0].id
                if (this.ds_vt[0].quyens != null) {
                    this.data.quyen = this.ds_vt[0].quyens.map(item => item.id)
                }
            })
        },

    },

    created() {
        this.getQuyen();
        this.getVT();
    },



}      
</script>