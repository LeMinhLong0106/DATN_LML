<template>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Hôm nay</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" v-if="homnay == null">
                                    Chưa có đơn
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" v-else>
                                    {{ parseInt(homnay.total).toLocaleString('de-DE') }}đ
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Trong tháng</div>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800" v-for="i in homqua">
                                    {{ i.total.toLocaleString() }} VNĐ</div> -->

                                <div class="h5 mb-0 font-weight-bold text-gray-800" v-if="tongtien == null">
                                    Chưa có đơn
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" v-else>
                                    {{ parseInt(tongtien).toLocaleString("de-DE") }}đ
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Món ăn chưa nấu
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ monanchuanau }}</div>
                                    </div>
                                    <!-- <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Xử lý hóa đơn</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Quầy({{ hdtqcxl }}) /
                                    online({{ hdoncxl }})</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
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
            homnay: {},
            homqua: {},
            tongtien: 0,
            hdtqcxl: 0,
            hdoncxl: 0,
            monanchuanau: 0,
        }
    },

    methods: {
        getBaoCao() {
            let token = window.localStorage.getItem('token');
            if (token == null) {
                this.$router.push('/login');
            }
            this.axios.get('report', {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            }).then(res => {
                console.log(res.data);
                this.homnay = res.data.tongtienhomnay
                // this.homqua = res.data.tongtienhomqua
                this.hdtqcxl = res.data.hdtqcxl
                this.hdoncxl = res.data.hdoncxl
                this.monanchuanau = res.data.monanchuanau
                this.tongtien = res.data.tongtien
                // console.log(res.data.tongtienhomnay);
            })
        },
    },

    created() {
        this.getBaoCao();
    },

}
</script>
