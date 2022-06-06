import {
  createRouter,
  createWebHistory
} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Menu from '../views/Menu.vue'
import Cart from '../views/Cart.vue'
import Login from '../views/Login.vue'
import LoginGG from '../views/LoginGG.vue'
import Registor from '../views/Registor.vue'
import Detail from '../views/Detail.vue'
import Profile from '../views/Profile.vue'
import Order from '../views/Order.vue'

const router = createRouter({
  history: createWebHistory(
    import.meta.env.BASE_URL),
  routes: [{
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/menu',
      name: 'menu',
      component: Menu
    },
    {
      path: '/cart',
      name: 'cart',
      component: Cart
    },
    {
      path: '/api/login/google/callback',
      name: 'loginGG',
      component: LoginGG
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
      path: '/detail/:id',
      name: 'detail',
      component: Detail
    },
    {
      path: '/profile',
      name: 'profile',
      component: Profile
    },
    {
      path: '/order',
      name: 'order',
      component: Order
    },
  ]
})

export default router