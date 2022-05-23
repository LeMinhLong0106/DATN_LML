<template>
    <div class="container-fluid">
        <div class="modal-content">
            <form @submit.prevent="saveMon" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                </div>

                <!-- Modal body -->
                <div class="form-group">
                    <label for="hoten">Tên nhân viên</label>
                    <input v-model="ds_nv.hoten" type="text" class="form-control" name="hoten" placeholder="Họ tên">

                </div>
                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input v-model="ds_nv.diachi" type="text" class="form-control" name="diachi" placeholder="Địa chỉ">

                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input v-model="ds_nv.sdt" type="number" class="form-control" name="sdt"
                        placeholder="Số điện thoại">

                </div>

                <div class="form-group">
                    <label for="sdt">Email</label>
                    <input v-model="ds_nv.email" type="email" class="form-control" name="email" placeholder="Email">

                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input v-model="ds_nv.password" type="password" class="form-control" name="password"
                        placeholder="Mật khẩu">

                </div>
                <div class="form-group">
                    <label for="hinhanh">Ảnh</label>
                    <input @change="saveImage" type="file" class="form-control" name="hinhanh">

                </div>
                <div class="form-group">
                    <label for="vaitro_id">Vai trò</label>
                    <select class="form-control" name="vaitro_id" v-model="ds_nv.vaitro_id">
                        <option value="" class="form-control">Vai trò</option>
                        <option v-for="item in ds_vt" v-bind:value="item.id">
                            {{ item.tenvaitro }}
                        </option>
                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            api: 'http://localhost:8000/api/nhanvien',
            id: '',
            hoten: '',
            diachi: '',
            sdt: '',
            email: '',
            vaitro_id: '',
            hinhanh: '',
            ds_nv: {},
            ds_vt: {},
        }
    },
    methods: {
        saveImage(e) {
            this.hinhanh = e.target.files[0]
        },

        saveMon() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            let formData = new FormData();
            formData.append('hoten', this.ds_nv.hoten);
            formData.append('diachi', this.ds_nv.diachi);
            formData.append('sdt', this.ds_nv.sdt);
            formData.append('email', this.ds_nv.email);
            formData.append('password', this.ds_nv.password);
            formData.append('vaitro_id', this.ds_nv.vaitro_id);
            formData.append('hinhanh', this.hinhanh);
            this.axios.post(this.api, formData, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_nv = {};
                this.$swal(
                    'Thành công!',
                    'nhân viên đã được thêm.',
                    'success'
                )
            }).catch(err => {
                this.$swal(
                    'Error!',
                    'Your file has been deleted.',
                    'error'
                )
            })


        },

        getVT() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/vaitro', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.ds_vt = res.data
            })
        },

    },

    created() {
        this.getVT();
    },

}      
</script>


