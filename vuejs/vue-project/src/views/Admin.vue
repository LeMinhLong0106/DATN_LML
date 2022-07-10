<template>
    <div>
        <div v-if="user.vaitro_id == 4">
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
                                    <router-link class="dropdown-item" to="/thongtin">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Thông tin
                                    </router-link>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng xuất
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div>
                        <router-view name="a"></router-view>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
            </div>
        </div>
        <div id="wrapper" v-else>
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion noprint" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <!-- <i class="fas fa-laugh-wink"></i> -->
                        <img class="mr-2 filter" src="public/assets/images/nhahang.svg" aria-haspopup="true"
                            aria-expanded="false" style="width: 2.5em;">
                    </div>
                    <div class="sidebar-brand-text mx-3">Majestic</div>
                </router-link>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <router-link class="nav-link" to="/">
                        <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                        <img class="mr-2 filter" src="public/assets/images/home.svg" aria-haspopup="true"
                            aria-expanded="false" style="width: 1.25em;">

                        <span>Trang chủ</span>
                    </router-link>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                    Nhà hàng
                </div> -->
                <li class="nav-item" v-for="u in quyen">
                    <router-link class="nav-link" :to="u.tenquyen">
                        <img class="mr-2 filter" :src="getSVG(u.tenquyen)" aria-haspopup="true" aria-expanded="false"
                            style="width: 1.25em;">
                        <span>{{ u.mota }}</span>
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
                                    <router-link class="dropdown-item" to="/thongtin">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Thông tin
                                    </router-link>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng xuất
                                    </a>
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
                <footer class="sticky-footer bg-white noprint">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2022</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bạn muốn rời trang?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <a class="btn btn-primary" href="#" data-dismiss="modal" @click="logout()">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: [],
            ds_vt: [],
        }
    },
    computed: {
        quyen() {
            return this.$store.state.quyen
        },
    },

    methods: {
        // faClass(icon) {
        //     return 'fa-' + icon;
        // },
        getSVG(hinhanh) {
            return `../assets/images/${hinhanh}.svg`;
        },

        getIMG(hinhanh) {
            return `http://localhost:8000/images/${hinhanh}`
        },
        getUser() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('http://localhost:8000/api/getuser', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                this.user = res.data;
                this.$store.dispatch('quyen', this.user['userquyen']);
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

<style>
.filter {
    filter: invert(1)
}

@media print {
    h4 {
        font-size: 2.5rem;
    }

    h5 {
        font-size: 2rem;
    }

    p,
    .table {
        font-size: 1.5rem;
    }

    .printHD {
        width: 100%;
        margin-left: 50px;
    }

    .noprint,
    .noprint * {
        display: none !important;
    }
}
</style>