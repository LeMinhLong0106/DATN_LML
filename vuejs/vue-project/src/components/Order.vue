<template>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Danh sách đặt món</h1>
        <div class="row">
            <!-- danh sách bàn -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">Tình trạng bàn</div>
                    <div class="card-body card-table">
                        <span v-for="item in ds_ban">
                            <button v-if="item.tinhtrang == 0" class="mb-2 btn btn-success"
                                @click="showmodal(item.id)">Bàn {{ item.id }}
                                <br> {{
                                        item.ghe
                                }} ghế</button>
                            <button v-else-if="item.tinhtrang == 1" class="mb-2 btn btn-warning"
                                @click="showmodal(item.id)">Bàn {{ item.id }}
                                <br> {{
                                        item.ghe
                                }} ghế</button>
                            <button v-else-if="item.tinhtrang == 2" class="mb-2 btn btn-danger"
                                @click="showmodal(item.id)">Bàn {{ item.id }}
                                <br> {{
                                        item.ghe
                                }} ghế</button>
                        </span>
                    </div>
                </div>
            </div>
            <!-- danh sách món ăn cho bàn -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3" id="showSelectedTable"></div>
                    <div class="card-body">
                        <div class="table-responsive showSelectedMenuAndTable" v-if="ds_mon != null">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tên món</th>
                                        <th>Số lượng</th>
                                        <th>Ghi chú</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Tình trạng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in ds_mon" :key="index">
                                        <td>{{ item.monanss.tenmonan }}</td>
                                        <td>
                                            <input v-model="item.soluong" v-if="item.tinhtrang == 0" type="number"
                                                @change="updateSoluong(item.id, item.soluong)" class="form-control"
                                                min="1" style="width: 100px;">
                                            <div v-else>{{ item.soluong }}</div>
                                        </td>
                                        <!-- <td>{{ item.ghichu }}</td> -->
                                        <td>
                                            <input v-model="item.ghichu" v-if="item.tinhtrang == 0"
                                                @change="updateNote(item.id, item.ghichu)" type="text"
                                                class="form-control" style="width: 100px;">
                                            <div v-else>{{ item.ghichu }}</div>
                                        </td>
                                        <td>{{ parseInt(item.giaban).toLocaleString("de-DE") }}đ</td>
                                        <td>{{ (item.soluong * item.giaban).toLocaleString("de-DE") }}đ</td>
                                        <td>
                                            <span v-if="item.tinhtrang == 0" class="badge badge-danger">Đang chờ</span>
                                            <span v-else class="badge badge-success">Đã nấu</span>
                                        </td>
                                        <td>
                                            <div v-if="item.tinhtrang == 0">
                                                <button class="btn btn-danger btn-circle btn-sm mr-2"
                                                    @click="deleteMon(item.id)"><i class="fas fa-trash"></i></button>
                                                <button class='btn btn-primary btn-circle btn-sm'
                                                    @click="confirmOrder(item.id)"><i class='fa fa-check'></i></button>
                                            </div>
                                            <div v-else>
                                                <i class='fa fa-check'></i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>Tổng: {{ $data.tong.toLocaleString("de-DE") }}đ</div>
                        </div>
                        <div v-else>
                            <div class="alert alert-danger">
                                <strong>Mời bạn chọn món</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal chọn món -->
        <div id="orderModal" class="modal fade">
            <div class="modal-dialog">
                <form @submit.prevent="saveDSmon">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal_title"></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Món ăn</label>
                                <select name="product_name" id="product_name" class="form-control"
                                    v-model="product_name">
                                    <option value="">Chọn món ăn</option>
                                    <option v-for="item in ds_monan" v-bind:value="item.id">
                                        {{ item.tenmonan }}
                                    </option>
                                </select>
                                <div class="text-danger error-text " v-if="errors['product_name']"
                                    v-html="errors['product_name']">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" name="product_quantity" id="product_quantity" class="form-control"
                                    min="1" v-model="product_quantity">
                                <div class="text-danger error-text " v-if="errors['product_quantity']"
                                    v-html="errors['product_quantity']">
                                </div>
                            </div>
                            <div class="form-group" id="form_people">
                                <label>Số lượng người</label>
                                <input type="number" name="people_quantity" id="people_quantity" class="form-control"
                                    min="1" v-model="people_quantity">
                            </div>

                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="product_note" id="product_note" class="form-control" rows="4"
                                    v-model="product_note"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="action" id="action" value="Thêm" />
                            <input type="submit" name="submit" id="submit_button" class="btn btn-success"
                                value="Thêm" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- danh sách đặt bàn -->
        <div v-if="ds_hdkd.length > 0">
            <h1 class="h3 mb-4 text-gray-800">Danh sách bàn đặt trước</h1>
            <div class="row">
                <div class="col-sm-3 mb-2" v-for="hd in ds_hdkd">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bàn: {{ hd.ban_id }}</h5>
                            <p class="card-text">Họ tên: {{ hd.hoten }}</p>
                            <p class="card-text">Số điện thoại: {{ hd.sdt }}</p>
                            <p class="card-text">Thời gian đến: {{ hd.thoigianden }}</p>
                            <p class="card-text">Số người: {{ hd.songuoi }}</p>
                            <p class="card-text">Ghi chú: {{ hd.ghichu }}</p>
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
            product_name: '',
            product_quantity: '',
            product_note: '',
            people_quantity: '',

            table_id: '',
            table_ghe: '',
            table_status: '',

            ds_ban: {},
            ds_monan: {},
            ds_mon: {},
            ds_hdkd: {},
            tong: '',

            // api: 'http://localhost:8000/api/',

            errors: {},
        }
    },

    methods: {
        showmodal(id) {
            let dsb = this.ds_ban.find(a => a.id == id);
            this.table_id = id;
            this.table_ghe = dsb.ghe;
            this.table_status = dsb.tinhtrang;
            $('#orderModal').modal('show')
            $('#modal_title').text('Thêm món cho bàn:' + id)
            $('#people_quantity').attr('max', this.table_ghe); // gán giá trị cho input hidden
            $('.showSelectedMenuAndTable').removeClass('d-none');

            if (this.table_status === 0) {
                $('#form_people').removeClass('d-none');
                $('#people_quantity').attr('required', true);
            } else {
                $('#form_people').addClass('d-none');
                $('#people_quantity').attr('required', false);
            };
            this.product_name = '',
                this.product_quantity = '',
                this.product_note = '',
                this.people_quantity = '',

                BaseRequest.get('order/getSaleDetails/' + this.table_id).then(response => {
                    console.log(response.data);
                    this.ds_mon = response.data.saleDetails;
                    this.tong = response.data.tong;

                    $('#showSelectedTable').html("Tình trạng order bàn: " + this.table_id);

                })
        },

        saveDSmon() {
            let data = {
                table_id: this.table_id,
                product_name: this.product_name,
                product_quantity: this.product_quantity,
                product_note: this.product_note,
                people_quantity: this.people_quantity
            }
            BaseRequest.post('order/orderFood', data).then(response => {
                this.ds_mon = response.data.saleDetails;
                this.tong = response.data.tong;
                $('#orderModal').modal('hide')
                this.getBan();
            }).catch(err => {
                // console(err);
                this.errors = err.response.data.errors;
            })
        },

        // xác nhận món ăn nấu xong
        confirmOrder(id) {
            let data = {
                id: id,
            }
            BaseRequest.post('order/confirmOrder', data).then(response => {
                this.ds_mon = response.data.saleDetails;
                this.tong = response.data.tong;
                $('#orderModal').modal('hide')

                this.getBan();
            }).catch(() => {
                this.$router.push('/');
            })
        },
        // xóa món ăn
        deleteMon(id) {
            let data = {
                id: id,
            }
            BaseRequest.post('order/deleteOrder', data).then(response => {
                // console.log(response);
                this.ds_mon = response.data.saleDetails;
                this.tong = response.data.tong;

                this.getBan();
            })
        },

        updateNote(id, ghichu) {
            let data = {
                id: id,
                ghichu: ghichu,
            }
            BaseRequest.post('order/updateNote', data).then(response => {
                this.ds_mon = response.data.saleDetails;
                this.getBan();
            })
        },

        updateSoluong(id, soluong) {
            let data = {
                id: id,
                soluong: soluong,
            }
            BaseRequest.post('order/updateQuantity', data).then(response => {
                this.product_quantity = data.soluong;
                this.ds_mon = response.data.saleDetails;
                this.tong = response.data.tong;

                this.getBan();
            })
        },

        getBan() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            BaseRequest.get('indexBan').then(res => {
                this.ds_ban = res.data
            }).catch(err => {
                this.$router.push('/');
            })
        },

        getMonAn() {
            BaseRequest.get('indexMonan').then(res => {
                this.ds_monan = res.data
            }).catch(err => {
                this.$router.push('/');
            })
        },

        getHDKD() {
            BaseRequest.get('order/getHDKD').then(res => {
                // console.log(res.data);
                this.ds_hdkd = res.data
            }).catch(err => {
                this.$router.push('/');
            })
        },

    },


    created() {
        this.getBan();
        this.getMonAn();
        this.getHDKD();
    },

}    
</script>
<style scoped>
.card-table {
    text-align: center;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(5rem, 1fr));
    /* gap: 2rem; */
}


</style>