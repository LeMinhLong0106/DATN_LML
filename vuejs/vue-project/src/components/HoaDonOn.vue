<template>
    <div class="container-fluid">
        <h3 class="text-center">DANH SÁCH HÓA ĐƠN</h3>
        <table class="table table-striped table-class" id="dataTable">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Họ tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Tổng tiền</th>
                    <th>Ngày mua</th>
                    <th>Tình trạng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in ds_hd">
                    <td>{{ item.id }}</td>
                    <td>{{ item.hoten }}</td>
                    <td>{{ item.sdt }}</td>
                    <td>{{ item.diachi }}</td>
                    <td>{{ item.tongtien.toLocaleString() }} đ</td>
                    <td>{{ format_date(item.created_at) }}</td>
                    <td>
                        <span v-if="item.tinhtrang == 0" class="badge badge-danger">Chưa xử lý</span>
                        <span v-else class="badge badge-success">Đã xử lý</span>
                    </td>
                    <td>
                        <div v-if="item.tinhtrang == 0">
                            <router-link :to="{ name: 'hoadononline.edit', params: { id: item.id } }">
                                <button type="button" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-edit"></i></button>
                            </router-link>
                            <!-- <button type="button" class="btn btn-primary btn-circle btn-sm" @click="detailhdonline(item.id)">
                                <i class="fas fa-edit"></i></button> -->
                        </div>
                        <div v-else>
                            <button type="button" class="btn btn-danger btn-circle btn-sm" @click="deleteHD(item.id)"><i
                                    class="fas fa-times"></i></button>
                            <a class="btn btn-warning btn-circle btn-sm" href="#">
                                <i class="fas fa-eye"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>

        </table>


    </div>

</template>

<script>
import moment from 'moment'
export default {

    data() {
        return {
            ds_hd: {},
            cthd: {},
            id: '',
            tong: '',
            product_quantity: '',
        }
    },

    methods: {

        // detailhdonline(id) {
        //     this.id = id
        //     this.$router.push({
        //         name: 'hoadononline.edit',
        //         params: {
        //             id: id
        //         }
        //     })
        // },

        // thanhToan() {
        //     var id = this.id;
        //     var tong = this.tong;
        //     var url = 'http://localhost:8000/api/hdonline/' + id + '/thanhtoan';
        //     let token = window.localStorage.getItem('token');
        //     if (token == null) {
        //         this.$router.push('/login');
        //     }
        //     this.axios.put(url, {
        //         tong: tong
        //     }, {
        //         headers: {
        //             Authorization: 'Bearer ' + token
        //         }
        //     }).then(response => {
        //         this.getHD();
        //         $('#detailhdonline').modal('hide');
        //     }).catch(error => {
        //         console.log(error);
        //     });

        //     // this.axios.post('http://127.0.0.1:8000/api/hdonline/thanhtoanhdtq/' + this.id).then(response => {
        //     //     console.log(response.data);
        //     //     this.getHD();
        //     //     $('#detailhdonline').modal('hide');
        //     // }).catch(error => {
        //     //     console.log(error);
        //     // });
        // },

        deleteMon(id) {
            let data = {
                id: id,
            }
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.post('http://127.0.0.1:8000/api/order/deleteOrder', data, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(response => {
                // console.log(response);
                this.cthd = response.data.saleDetails;
                this.tong = response.data.tong;

                this.getBan();
            }).catch(error => {
            });
        },

        // updateSoluong(id, soluong) {
        //     let data = {
        //         id: id,
        //         soluong: soluong,
        //     }
        //     let token = window.localStorage.getItem('token');
        //     if (token == null) {
        //         this.$router.push('/login');
        //     }
        //     this.axios.post('http://127.0.0.1:8000/api/order/updateSoluong', data, {
        //         headers: {
        //             Authorization: 'Bearer ' + token
        //         }
        //     }).then(response => {
        //         this.product_quantity = data.soluong;
        //         this.cthd = response.data.saleDetails;
        //         this.tong = response.data.tong;

        //         this.getBan();
        //     }).catch(error => {
        //         // this.showMessage('Sửa thất bại');
        //     });
        // },

        format_date(value) {
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        getHD() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/hdonline', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_hd = res.data.data
            })
        },

        getCTHD(id) {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/hdonline/' + id, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                // console.log(res.data.cthd)
                this.cthd = res.data.cthd
                this.tong = res.data.tong
            })
        },

        deleteHD(id) {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.axios.delete('http://127.0.0.1:8000/api/hdonline/deleteHD/' + id, {
                        headers: {
                            Authorization: 'Bearer ' + token
                        }
                    }).then(() => {
                        this.$swal(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    })
                    this.getHD()
                }
            })


        },
    },

    created() {
        this.getHD();
    },

}    
</script>