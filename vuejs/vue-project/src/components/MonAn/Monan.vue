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
                  <router-link :to="{ name: 'createMA' }">
                     <button type="button" class="btn btn-success btn-circle btn-sm">
                        <i class="fas fa-plus"></i></button>
                  </router-link>
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
                           <router-link :to="{ name: 'editMA', params: { id: todo.id } }">
                              <button class="btn btn-primary btn-circle btn-sm mr-2"><i
                                    class="fas fa-edit"></i></button>
                           </router-link>
                           <button class="btn btn-danger btn-circle btn-sm" @click="deleteMon(todo.id)"><i
                                 class="fas fa-trash"></i></button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

</template>

<script>
export default {
   data() {
      return {
         api: 'http://localhost:8000/api/monan',
         ds_mon: {},
         ds_dm: {},
      }
   },
   methods: {

      getIMG(hinhanh) {
         return `http://localhost:8000/images/${hinhanh}`
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
               this.axios.delete(this.api + '/' + id, {
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
         this.axios.get(this.api, {
            headers: {
               Authorization: 'Bearer ' + token
            }
         }).then(res => {
            console.log(res.data);
            this.ds_mon = res.data.datamonan
            this.$nextTick(() => {
               $('#dataTable').DataTable();
            })
         }).catch(error => {
            this.$router.push('/');
         })
      },

   },

   mounted() {
      this.getMon();
   },
}      
</script>