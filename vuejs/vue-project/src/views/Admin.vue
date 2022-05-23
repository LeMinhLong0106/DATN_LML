<template>
    <div>

        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
                </router-link>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <router-link class="nav-link" to="/">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Trang chủ</span>
                    </router-link>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Nhà hàng
                </div>
                <div v-if="user.vaitro_id == 100">
                    <!-- bàn -->
                    <li class="nav-item">
                        <router-link class="nav-link" to="/admin/ban">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Bàn</span>
                        </router-link>
                    </li>
                    <!-- thực đơn -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_1"
                            aria-expanded="true" aria-controls="collapse_1">
                            <i class="fas fa-th-list"></i>
                            <span>Thực đơn</span>
                        </a>
                        <div id="collapse_1" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/admin/danhmuc">Danh mục</router-link>
                                <router-link class="collapse-item" to="/admin/monan">Món ăn</router-link>
                            </div>
                        </div>
                    </li>
                </div>

                <div v-if="user.vaitro_id == 200">
                    <!-- Hóa đơn -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_2"
                            aria-expanded="true" aria-controls="collapse_2">
                            <i class="fas fa-th-list"></i>
                            <span>Hóa đơn</span>
                        </a>
                        <div id="collapse_2" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/admin/hoadontq">Hóa đơn tại quầy</router-link>
                                <router-link class="collapse-item" to="/">Hóa đơn online</router-link>
                            </div>
                        </div>
                    </li>

                    <!-- Báo cáo  -->
                    <li class="nav-item">
                        <router-link class="nav-link collapsed" to="/admin/baocao">
                            <i class="fas fa-edit"></i>
                            <span>Báo cáo</span>
                        </router-link>
                    </li>
                </div>

                <div v-if="user.vaitro_id == 300">
                    <!-- order  -->
                    <li class="nav-item">
                        <router-link class="nav-link collapsed" to="/admin/order">
                            <i class="fas fa-edit"></i>
                            <span>Đơn hàng</span>
                        </router-link>
                    </li>

                    <!-- Đầu bêps  -->
                    <li class="nav-item">
                        <router-link class="nav-link collapsed" to="/admin/daubep">
                            <i class="fas fa-edit"></i>
                            <span>Đầu bếp</span>
                        </router-link>
                    </li>
                </div>

                <!-- bàn -->
                <li class="nav-item">
                    <router-link class="nav-link" to="/admin/ban">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Bàn</span>
                    </router-link>
                </li>
                <!-- thực đơn -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_1"
                        aria-expanded="true" aria-controls="collapse_1">
                        <i class="fas fa-th-list"></i>
                        <span>Thực đơn</span>
                    </a>
                    <div id="collapse_1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <router-link class="collapse-item" to="/admin/danhmuc">Danh mục</router-link>
                            <router-link class="collapse-item" to="/admin/monan">Món ăn</router-link>
                        </div>
                    </div>
                </li>

                <!-- Hóa đơn -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_2"
                        aria-expanded="true" aria-controls="collapse_2">
                        <i class="fas fa-th-list"></i>
                        <span>Hóa đơn</span>
                    </a>
                    <div id="collapse_2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <router-link class="collapse-item" to="/admin/hoadontq">Hóa đơn tại quầy</router-link>
                            <router-link class="collapse-item" to="/admin/hoadononline">Hóa đơn online</router-link>
                        </div>
                    </div>
                </li>

                <!-- Báo cáo  -->
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/admin/baocao">
                        <i class="fas fa-edit"></i>
                        <span>Báo cáo</span>
                    </router-link>
                </li>

                <!-- order  -->
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/admin/order">
                        <i class="fas fa-edit"></i>
                        <span>Đơn hàng</span>
                    </router-link>
                </li>

                <!-- Đầu bêps  -->
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/admin/daubep">
                        <i class="fas fa-edit"></i>
                        <span>Đầu bếp</span>
                    </router-link>
                </li>

                <!-- Khách hàng  -->
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/admin/khachhang">
                        <i class="fas fa-edit"></i>
                        <span>Khách hàng</span>
                    </router-link>
                </li>

                <!-- Nhân viên  -->
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/admin/nhanvien">
                        <i class="fas fa-edit"></i>
                        <span>Nhân viên</span>
                    </router-link>
                </li>

                <!-- Quyền  -->
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/admin/quyen">
                        <i class="fas fa-edit"></i>
                        <span>Quyền</span>
                    </router-link>
                </li>

                <!-- Vai trò  -->
                <li class="nav-item">
                    <router-link class="nav-link collapsed" to="/admin/vaitro">
                        <i class="fas fa-edit"></i>
                        <span>Vai trò</span>
                    </router-link>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Chào, {{ user.hoten
                                    }}</span>
                                    <img class="img-profile rounded-circle" :src="getIMG(user.hinhanh)">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" @click="logout()">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div>
                        <router-view></router-view>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {},
        }
    },
    methods: {
        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
        getUser() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://127.0.0.1:8000/api/user', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                console.log(res.data);
                this.user = res.data;
            }).catch(err => {
                console.log(err);
            })
        },
        logout() {
            window.localStorage.removeItem('token');
            this.$router.push('/login');
        },
    },
    created() {
        this.getUser();
    },
}
</script>
