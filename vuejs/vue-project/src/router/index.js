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
import Monan from '../components/Monan.vue';
import Order from '../components/Order.vue';
import GiaoDienDB from '../components/GiaoDienDB.vue';
import HoaDonTQ from '../components/HoaDonTQ.vue';
import HoaDonOn from '../components/HoaDonOn.vue';
import DetailHDOn from '../components/DetailHDOn.vue';
import DetailHDTQ from '../components/DetailHDTQ.vue';
import BaoCao from '../components/BaoCao.vue';
import KhachHang from '../components/KhachHang.vue';
import NhanVien from '../components/NhanVien.vue';
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
          path: '/admin/ban',
          name: 'ban',
          component: Ban,
        },
        {
          path: '/admin/danhmuc',
          name: 'danhmuc',
          component: Danhmuc,
        },
        {
          path: '/admin/monan',
          name: 'monan',
          component: Monan,
        },
        {
          path: '/admin/order',
          name: 'order',
          component: Order,
        },
        {
          path: '/admin/daubep',
          name: 'daubep',
          component: GiaoDienDB,
        },
        {
          path: '/admin/khachhang',
          name: 'khachhang',
          component: KhachHang,
        },
        {
          path: '/admin/nhanvien',
          name: 'nhanvien',
          component: NhanVien,
        },
        {
          path: '/admin/nhanvien/create',
          name: 'createNV',
          component: CreateNV,
        },
        {
          path: '/admin/nhanvien/edit/:id',
          name: 'editNV',
          component: EditNV,
        },
        {
          path: '/admin/vaitro',
          name: 'vaitro',
          component: VaiTro,
        },
        {
          path: '/admin/quyen',
          name: 'quyen',
          component: Quyen,
        },
        {
          path: '/admin/hoadontq',
          name: 'hoadontq',
          component: HoaDonTQ,
        },
        {
          path: '/admin/hoadontq/detail/:id',
          name: 'hoadontq.detail',
          component: DetailHDTQ,
        },
        {
          path: '/admin/hoadononline',
          name: 'hoadononline',
          component: HoaDonOn,
        },
        {
          path: '/admin/baocao',
          name: 'baocao',
          component: BaoCao,
        },
        {
          path: '/admin/hoadononline/edit/:id',
          name: 'hoadononline.edit',
          component: DetailHDOn,
        },
      ]
    },
    {
      path: '/home',
      name: 'home',
      component: HomeView
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