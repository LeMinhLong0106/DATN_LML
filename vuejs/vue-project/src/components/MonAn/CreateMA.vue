<template>
    <div class="px-4 mt-4">
        <form @submit.prevent="saveMon" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Hình ảnh</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <!-- <img class="img-account-profile rounded-circle mb-2" :src="getIMG()"> -->
                            <!-- Profile picture help block-->
                            <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                            <!-- Profile picture upload button-->
                            <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                            <input @change="saveImage" type="file" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('hinhanh') }" name="hinhanh">
                            <div v-if="form.errors.has('hinhanh')" class="invalid-feedback">
                                <strong>{{ form.errors.get('hinhanh') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Chi tiết món ăn</div>
                        <div class="card-body">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="tenmonan">Tên món ăn</label>
                                    <input v-model="form.tenmonan" type="text" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('tenmonan') }" name="tenmonan"
                                        placeholder="Tên món">
                                    <div v-if="form.errors.has('tenmonan')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('tenmonan') }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="gia">Giá</label>
                                    <input v-model="form.gia" type="number" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('gia') }" name="gia" placeholder="Giá">
                                    <div v-if="form.errors.has('gia')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('gia') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="mota">Mô tả</label>
                                <textarea v-model="form.mota" class="form-control "
                                    :class="{ 'is-invalid': form.errors.has('mota') }" name="mota"
                                    placeholder="Mô tả"></textarea>
                                <div v-if="form.errors.has('mota')" class="invalid-feedback">
                                    <strong>{{ form.errors.get('mota') }}</strong>
                                </div>
                            </div>


                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="donvitinh">Đơn vị tính</label>
                                    <select class="form-control" v-model="form.donvitinh"
                                        :class="{ 'is-invalid': form.errors.has('donvitinh') }" name="donvitinh">
                                        <option value="" class="form-control">Đơn vị tính</option>
                                        <option value="Suất">Suất</option>
                                        <option value="Đĩa">Đĩa</option>
                                        <option value="Phần">Phần</option>
                                        <option value="Con">Con</option>
                                        <option value="Kg">Kg</option>
                                        <option value="Chén">Chén</option>
                                    </select>
                                    <div v-if="form.errors.has('donvitinh')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('donvitinh') }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="danhmuc">Danh mục</label>
                                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('danhmuc') }"
                                        name="danhmuc" v-model="form.danhmuc">
                                        <option value="" class="form-control">Danh mục</option>
                                        <option v-for="item in ds_dm" v-bind:value="item.id">
                                            {{ item.tendm }}
                                        </option>
                                    </select>
                                    <div v-if="form.errors.has('danhmuc')" class="invalid-feedback">
                                        <strong>{{ form.errors.get('danhmuc') }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button-->
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <router-link to="/food" class="btn btn-primary float-right">Quay lại</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import Form from 'vform'

export default {
    data() {
        return {
            // api: 'http://localhost:8000/api/food',
            form: new Form({
                id: '',
                tenmonan: '',
                gia: '',
                mota: '',
                tinhtrang: 1,
                donvitinh: '',
                danhmuc: '',
                hinhanh: '',
            }),
            ds_dm: {},
        }
    },
    methods: {
        saveImage(e) {
            this.form.hinhanh = e.target.files[0]
        },

        saveMon() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.form.post('food', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
                .then(res => {
                    this.$swal(
                        'Thành công!',
                        res.data.message,
                        'success'
                    )
                    this.$router.push('/food')
                })
                .catch(() => {
                    this.$swal(
                        'Lỗi!',
                        'Có lỗi xảy ra.',
                        'error'
                    )
                })
        },
        getDM() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('category', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                // console.log(res.data)
                this.ds_dm = res.data
            })
        },
    },

    created() {
        this.getDM();
    },

}      
</script>


