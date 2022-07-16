import {
  createRouter,
  createWebHistory
} from 'vue-router'

import HomeView from '../views/HomeView.vue'
import Login from '../views/Login.vue';
import Registor from '../views/Registor.vue';
import Forgot from '../views/Forgot.vue';
import Admin from '../views/Admin.vue';
import ResetPassword from '../views/ResetPassword.vue';

import Ban from '../components/Ban.vue';
import Dashboard from '../components/Dashboard.vue';
import Reset from '../components/Reset.vue';
import Danhmuc from '../components/Danhmuc.vue';
import Monan from '../components/MonAn/Monan.vue';
import CreateMA from '../components/MonAn/CreateMA.vue';
import EditMA from '../components/MonAn/EditMA.vue';
import Order from '../components/Order.vue';
import GiaoDienDB from '../components/GiaoDienDB.vue';
import HoaDonTQ from '../components/HoaDonTQ.vue';
import HoaDonOn from '../components/HoaDonOn.vue';
import EditHDOn from '../components/EditHDOn.vue';
import DetailHDOn from '../components/DetailHDOn.vue';
import DetailHDTQ from '../components/DetailHDTQ.vue';
import BaoCao from '../components/BaoCao.vue';
import KhachHang from '../components/KhachHang.vue';
import NhanVien from '../components/Nhanvien/NhanVien.vue';
import CreateNV from '../components/Nhanvien/CreateNV.vue';
import EditNV from '../components/Nhanvien/EditNV.vue';
import VaiTro from '../components/VaiTro.vue';
import Quyen from '../components/Quyen.vue';
import Thongtin from '../components/Thongtin.vue';

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
          components: {
            default: Dashboard,
            a: GiaoDienDB,
          },
        },
        {
          path: '/table',
          name: 'table',
          component: Ban,
        },
        {
          path: '/category',
          name: 'category',
          component: Danhmuc,
        },
        {
          path: '/food',
          name: 'food',
          component: Monan,
        },
        {
          path: '/food/create',
          name: 'createMA',
          component: CreateMA,
        },
        {
          path: '/food/edit/:id',
          name: 'editMA',
          component: EditMA,
        },
        {
          path: '/order',
          name: 'order',
          component: Order,
        },
        {
          path: '/customer',
          name: 'customer',
          component: KhachHang,
        },
        {
          path: '/user',
          name: 'user',
          component: NhanVien,
        },
        {
          path: '/user/create',
          name: 'createNV',
          component: CreateNV,
        },
        {
          path: '/user/edit/:id',
          name: 'editNV',
          component: EditNV,
        },
        {
          path: '/role',
          name: 'role',
          component: VaiTro,
        },
        {
          path: '/permission',
          name: 'permission',
          component: Quyen,
        },
        {
          path: '/hdtaiquay',
          name: 'hdtaiquay',
          component: HoaDonTQ,
        },
        {
          path: '/hdtaiquay/detail/:id',
          name: 'hdtaiquay.detail',
          component: DetailHDTQ,
        },
        {
          path: '/hdonline',
          name: 'hdonline',
          component: HoaDonOn,
        },
        {
          path: '/hdonline/edit/:id',
          name: 'hdonline.edit',
          component: EditHDOn,
        },
        {
          path: '/hdonline/:id',
          name: 'hdonline.detail',
          component: DetailHDOn,
        },
        {
          path: '/report',
          name: 'report',
          component: BaoCao,
        },
        {
          path: '/thongtin',
          name: 'thongtin',
          component: Thongtin,
        },
      ]
    },
    {
      // path: "/:catchAll(.*)",
      path: '/:pathMatch(.*)*',
      name: "home",
      component: HomeView,
    },
    {
      path: '/404',
      name: "404",
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
      path: '/forgot',
      name: 'forgot',
      component: Forgot
    },
    {
      path: '/reset/:token',
      name: 'reset',
      component: Reset
    },
    {
      path: '/reset-password',
      name: 'reset-password',
      component: ResetPassword
    },
    {
      path: '/auth/:provider/callback',
      component: Login
    },
  ]
})

export default router