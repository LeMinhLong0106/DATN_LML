<template>

    <div class="px-4 mt-4">
        <form @submit.prevent="updateMon" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Hình ảnh</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile mb-2 w-100" :src="getIMG(ds_ma.hinhanh)">
                            <!-- Profile picture help block-->
                            <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                            <!-- Profile picture upload button-->
                            <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                            <input @change="updateImage" type="file" class="form-control" name="hinhanh">

                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="tenmonan">Tên món ăn</label>
                                <input v-model="ds_ma.tenmonan" type="text" class="form-control" name="tenmonan"
                                    placeholder="Tên món">
                                <div class="text-danger error-text " v-if="errors['tenmonan']"
                                    v-html="errors['tenmonan']">
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="gia">Giá</label>
                                    <input v-model="ds_ma.gia" type="number" class="form-control" name="gia"
                                        placeholder="Giá">
                                    <div class="text-danger error-text " v-if="errors['gia']" v-html="errors['gia']">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="tinhtrang">Tình trạng</label>
                                    <br>
                                    <input type="radio" value="1" checked v-model="ds_ma.tinhtrang" />
                                    Còn
                                    <input type="radio" value="0" v-model="ds_ma.tinhtrang" />
                                    Hết
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="tenmonan">Mô tả</label>
                                <textarea v-model="ds_ma.mota" class="form-control" name="mota"
                                    placeholder="Mô tả"></textarea>

                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="donvitinh">Đơn vị tính</label>
                                    <select class="form-control" v-model="ds_ma.donvitinh" name="donvitinh">
                                        <option value="" class="form-control">Đơn vị tính</option>
                                        <option value="Suất">Suất</option>
                                        <option value="Đĩa">Đĩa</option>
                                        <option value="Phần">Phần</option>
                                        <option value="Con">Con</option>
                                        <option value="Kg">Kg</option>
                                        <option value="Chén">Chén</option>
                                    </select>
                                    <div class="text-danger error-text " v-if="errors['donvitinh']"
                                        v-html="errors['donvitinh']">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="danhmuc">Danh mục</label>
                                    <select class="form-control" name="danhmuc" v-model="ds_ma.danhmuc">
                                        <option value="" class="form-control">Danh mục</option>
                                        <option v-for="item in ds_dm" v-bind:value="item.id">
                                            {{ item.tendm }}
                                        </option>
                                    </select>
                                    <div class="text-danger error-text " v-if="errors['danhmuc']"
                                        v-html="errors['danhmuc']">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button-->
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <router-link to="/nhanvien" class="btn btn-primary float-right">Quay lại</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            api: 'http://localhost:8000/api/monan',
            ds_ma: {},
            ds_dm: {},
            errors: {},
        }
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },

        updateMon() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            let formData = new FormData();
            formData.append('tenmonan', this.ds_ma.tenmonan);
            formData.append('gia', this.ds_ma.gia);
            formData.append('tinhtrang', this.ds_ma.tinhtrang);
            formData.append('mota', this.ds_ma.mota);
            formData.append('donvitinh', this.ds_ma.donvitinh);
            formData.append('danhmuc', this.ds_ma.danhmuc);
            formData.append('hinhanh', this.hinhanh);
            this.axios.post('http://localhost:8000/api/update_ma' + '/' + this.$route.params.id, formData, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.$router.push('/monan');
                this.$swal(
                    'Thành công!',
                    'Món ăn đã được thêm.',
                    'success'
                )
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.$swal(
                    'Thất bại!',
                    'Món ăn chưa được thêm.',
                    'error'
                )
            })


        },
        updateImage(e) {
            this.hinhanh = e.target.files[0]
        },

        // getMA() {
        //     let token = window.localStorage.getItem('token');
        //     if (token == null) {
        //         this.$router.push('/login');
        //     }
        //     this.axios.get(this.api + '/' + this.$route.params.id, {
        //         headers: {
        //             Authorization: 'Bearer ' + token
        //         }
        //     }).then(response => {
        //         // console.log(response.data)
        //         this.ds_ma = response.data;
        //     })
        // },

        // getDM() {
        //     let token = window.localStorage.getItem('token');
        //     if (token == null) {
        //         this.$router.push('/login');
        //     }
        //     this.axios.get('http://127.0.0.1:8000/api/danhmuc', {
        //         headers: {
        //             Authorization: 'Bearer ' + token
        //         }
        //     }).then(res => {
        //         this.ds_dm = res.data
        //     })
        // },
    },

    // created() {
    //     this.getMA();
    //     this.getDM();
    // },

    async created() {
        let token = window.localStorage.getItem('token');
        if (token == null) {
            this.$router.push('/login');
        }

        const id = parseInt(this.$route.params.id);
        // console.log('idd:' + id);
        if (!id) {
            this.$router.push('/monan');
        }
        const [monan, danhmuc] = await Promise.all([
            this.axios.get(this.api + '/' + id, {
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }),
            this.axios.get('http://127.0.0.1:8000/api/danhmuc', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }),
        ]);
        // console.log(monan.data.id);
        if (!monan.data.id) {//nếu không tồn tại id trong database
            this.$router.push('/monan');
        }else{
            this.ds_ma = monan.data;
            this.ds_dm = danhmuc.data;
        }
    },

}      
</script>