import {
  createRouter,
  createWebHistory
} from 'vue-router'

import HomeView from '../views/HomeView.vue'
import Ban from '../components/Ban.vue';
import Dashboard from '../components/Dashboard.vue';
import Login from '../views/Login.vue';
import Registor from '../views/Registor.vue';
import Admin from '../views/Admin.vue';
import Danhmuc from '../components/Danhmuc.vue';
import Monan from '../components/MonAn/Monan.vue';
import CreateMA from '../components/MonAn/CreateMA.vue';
import EditMA from '../components/MonAn/EditMA.vue';
import Order from '../components/Order.vue';
import GiaoDienDB from '../components/GiaoDienDB.vue';
import HoaDonTQ from '../components/HoaDonTQ.vue';
import HoaDonOn from '../components/HoaDonOn.vue';
import DetailHDOn from '../components/DetailHDOn.vue';
import DetailHDTQ from '../components/DetailHDTQ.vue';
import BaoCao from '../components/BaoCao.vue';
import KhachHang from '../components/KhachHang.vue';
import NhanVien from '../components/Nhanvien/NhanVien.vue';
import CreateNV from '../components/Nhanvien/CreateNV.vue';
import EditNV from '../components/Nhanvien/EditNV.vue';
import VaiTro from '../components/VaiTro.vue';
import Quyen from '../components/Quyen.vue';

const router = createRouter({
  history: createWebHistory(
    import.meta.env.BASE_URL),
  routes: [{
      path: '/',
      name: 'admin',
      component: Admin,
      children: [{
          path: '/',
          name: 'dashboard',
          component: Dashboard,
        },
        {
          path: '/ban',
          name: 'ban',
          component: Ban,
        },
        {
          path: '/danhmuc',
          name: 'danhmuc',
          component: Danhmuc,
        },
        {
          path: '/monan',
          name: 'monan',
          component: Monan,
        },
        {
          path: '/monan/create',
          name: 'createMA',
          component: CreateMA,
        },
        {
          path: '/monan/edit/:id',
          name: 'editMA',
          component: EditMA,
        },
        {
          path: '/order',
          name: 'order',
          component: Order,
        },
        {
          path: '/daubep',
          name: 'daubep',
          component: GiaoDienDB,
        },
        {
          path: '/khachhang',
          name: 'khachhang',
          component: KhachHang,
        },
        {
          path: '/nhanvien',
          name: 'nhanvien',
          component: NhanVien,
        },
        {
          path: '/nhanvien/create',
          name: 'createNV',
          component: CreateNV,
        },
        {
          path: '/nhanvien/edit/:id',
          name: 'editNV',
          component: EditNV,
        },
        {
          path: '/vaitro',
          name: 'vaitro',
          component: VaiTro,
        },
        {
          path: '/quyen',
          name: 'quyen',
          component: Quyen,
        },
        {
          path: '/hoadontq',
          name: 'hoadontq',
          component: HoaDonTQ,
        },
        {
          path: '/hoadontq/detail/:id',
          name: 'hoadontq.detail',
          component: DetailHDTQ,
        },
        {
          path: '/hoadononline',
          name: 'hoadononline',
          component: HoaDonOn,
        },
        {
          path: '/baocao',
          name: 'baocao',
          component: BaoCao,
        },
        {
          path: '/hoadononline/edit/:id',
          name: 'hoadononline.edit',
          component: DetailHDOn,
        },
      ]
    },
    {
      path: "/:catchAll(.*)",
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/registor',
      name: 'registor',
      component: Registor
    },
    {
      path: '/auth/:provider/callback',
      component: Login
    },
  ]
})

export default router