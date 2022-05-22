<template>
   <div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">Quản lý món ăn</h1>
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <div class="row">
               <div class="col">
                  <h6 class="m-0 font-weight-bold text-primary">Danh sách món ăn</h6>
               </div>
               <div class="col" align="right">
                  <button type="button" class="btn btn-success btn-circle btn-sm" @click="newModal()">
                     <i class="fas fa-plus"></i></button>
               </div>
            </div>
         </div>

         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                  <thead>
                     <tr>
                        <th>Mã</th>
                        <th>Hình ảnh</th>
                        <th>Tên món ăn</th>
                        <th>Giá</th>
                        <th>Tình trạng</th>
                        <th>Đơn vị tính</th>
                        <th>Danh mục</th>
                        <th>Thao tác</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr v-for="(todo, index) in ds_mon" :key="index">
                        <td>{{ todo.id }}</td>
                        <!-- <td>{{ todo.hinhanh }}</td> -->

                        <td class="text-center"><img :src="getIMG(todo.hinhanh)" style="width: 5rem; " /></td>
                        <td>{{ todo.tenmonan }}</td>
                        <td>{{ todo.gia.toLocaleString() }}đ</td>
                        <td v-if="todo.tinhtrang == 0">
                           <span class="badge badge-danger">Hết</span>
                        </td>
                        <td v-else-if="todo.tinhtrang == 1">
                           <span class="badge badge-success">Còn</span>
                        </td>
                        <td>{{ todo.donvitinh }}</td>
                        <!-- <td>{{ todo.danhmuc }}</td> -->
                        <td>{{ todo.danhmucmonss.tendm }}</td>
                        <td>
                           <button class="btn btn-primary btn-circle btn-sm mr-2" @click="editModal(todo)"><i
                                 class="fas fa-edit"></i></button>
                           <button class="btn btn-danger btn-circle btn-sm" @click="deleteMon(todo.id)"><i
                                 class="fas fa-trash"></i></button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- Modal add -->
      <div class="modal fade" id="addModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <form @submit.prevent="editmode ? updateMon() : saveMon()" enctype="multipart/form-data">
                  <!-- Modal Header -->
                  <div class="modal-header">
                     <h4 class="modal-title" id="modal_title"></h4>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                     <div class="form-group">
                        <label for="tenmonan">Tên món ăn</label>
                        <input v-model="form.tenmonan" type="text" class="form-control" name="tenmonan"
                           placeholder="Nhập Tên món ăn">
                        <div class="text-danger error-text " v-if="form.errors.has('tenmonan')"
                           v-html="form.errors.get('tenmonan')"></div>
                     </div>
                     <div class="form-group">
                        <label for="gia">Giá</label>
                        <input v-model="form.gia" type="number" class="form-control" name="gia" placeholder="Nhập giá">
                        <div class="text-danger error-text " v-if="form.errors.has('gia')"
                           v-html="form.errors.get('gia')"></div>
                     </div>
                     <div class="form-group">
                        <label for="mota">Mô tả</label>
                        <textarea v-model="form.mota" class="form-control" name="mota" rows="3"></textarea>
                        <div class="text-danger error-text " v-if="form.errors.has('mota')"
                           v-html="form.errors.get('mota')"></div>
                     </div>
                     <div class="form-group d-none">
                        <label for="tinhtrang">Tình trạng</label>
                        <input type="radio" name="tinhtrang" value="1" checked> Còn
                        <input type="radio" name="tinhtrang" value="0"> Hết
                     </div>
                     <div class="form-group">
                        <label for="hinhanh">Ảnh</label>
                        <!-- <input v-model="form.hinhanh" type="text" class="form-control" name="hinhanh"> -->
                        <input @change="updateImage" type="file" class="form-control" name="hinhanh">
                        <div class="text-danger error-text " v-if="form.errors.has('hinhanh')"
                           v-html="form.errors.get('hinhanh')"></div>
                     </div>
                     <div class="form-group">
                        <label for="donvitinh">Đơn vị tính</label>
                        <select class="donvitinh form-control" v-model="form.donvitinh" name="donvitinh">
                           <option value="" class="form-control">Đơn vị tính</option>
                           <option value="Suất">Suất</option>
                           <option value="Đĩa">Đĩa</option>
                           <option value="Phần">Phần</option>
                           <option value="Con">Con</option>
                           <option value="Kg">Kg</option>
                           <option value="Chén">Chén</option>
                        </select>
                        <div class="text-danger error-text " v-if="form.errors.has('donvitinh')"
                           v-html="form.errors.get('donvitinh')"></div>
                     </div>
                     <div class="form-group">
                        <label for="danhmuc">Danh mục</label>
                        <select class="form-control" name="danhmuc" v-model="form.danhmuc">
                           <option value="" class="form-control">Danh mục món ăn</option>
                           <option v-for="item in ds_dm" v-bind:value="item.id">
                              {{ item.tendm }}
                           </option>
                        </select>
                        <div class="text-danger error-text " v-if="form.errors.has('danhmuc')"
                           v-html="form.errors.get('danhmuc')"></div>
                     </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                     <button v-show="!editmode" type="submit" class="btn btn-primary">Thêm</button>
                     <button v-show="editmode" type="submit" class="btn btn-primary">Cập nhật</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

   </div>

</template>

<script>
import Form from 'vform'

export default {
   data() {
      return {
         editmode: true,
         form: new Form({
            id: '',
            tenmonan: '',
            gia: '',
            mota: '',
            tinhtrang: 1,
            hinhanh: '',
            donvitinh: '',
            danhmuc: '',
         }),

         ds_mon: {},
         ds_dm: {},
      }
   },
   methods: {

      getIMG(hinhanh) {
         return `/images/${hinhanh}`
      },

      updateImage(e) {
         this.form.hinhanh = e.target.files[0]
         // console.log(this.form.hinhanh)
      },

      newModal() {
         this.editmode = false
         this.form.reset();
         $('#addModal').modal('show')
         $('#modal_title').html('Thêm món ăn');
      },

      saveMon() {
         let token = window.localStorage.getItem('token');
         if (token == null) {
            this.$router.push('/login');
         }
         this.form.post('http://127.0.0.1:8000/api/monan', {
            headers: {
               Authorization: 'Bearer ' + token
            }
         })
            .then(() => {
               $('#addModal').modal('hide')
               this.$swal(
                  'Thành công!',
                  'món ăn đã được thêm.',
                  'success'
               )
               this.getMon();
            })
            .catch(error => {
               this.$swal(
                  'Error!',
                  'Your file has been deleted.',
                  'error'
               )
            })
      },

      editModal(monan) {
         // console.log(monan.id);
         this.editmode = true
         $('#addModal').modal('show')
         this.form.fill(monan);//gán giá trị
         $('#modal_title').html('Sửa món ăn');
      },

      updateMon() {
         let token = window.localStorage.getItem('token');
         if (token == null) {
            this.$router.push('/login');
         }
         this.form.put('http://127.0.0.1:8000/api/monan/' + this.form.id, {
            headers: {
               Authorization: 'Bearer ' + token
            }
         })
            .then(() => {
               $('#addModal').modal('hide')
               this.$swal(
                  'Thành công!',
                  'món ăn đã dược cập nhật.',
                  'success'
               )
               this.getMon();
            })
            .catch(error => {
               this.$swal(
                  'Error!',
                  'Your file has been deleted.',
                  'error'
               )
            })
      },

      deleteMon(id) {
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
               this.form.delete('http://127.0.0.1:8000/api/monan/' + id, {
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
               this.getMon();
            }

         })
      },

      getMon() {
         let token = window.localStorage.getItem('token');
         if (token == null) {
            this.$router.push('/login');
         }
         this.axios.get('http://127.0.0.1:8000/api/monan', {
            headers: {
               Authorization: 'Bearer ' + token
            }
         }).then(res => {
            this.ds_mon = res.data.datamonan
         })
      },

      getDM() {
         let token = window.localStorage.getItem('token');
         if (token == null) {
            this.$router.push('/login');
         }
         this.axios.get('http://127.0.0.1:8000/api/danhmuc', {
            headers: {
               Authorization: 'Bearer ' + token
            }
         }).then(res => {
            this.ds_dm = res.data.data
         })
      },
   },

   created() {
      this.getMon();
      this.getDM();
   },



}      
</script>