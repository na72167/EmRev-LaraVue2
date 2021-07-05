import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/home/index'
import ApplyCompany from '@/views/applyCompany/index'
import MyPage from '@/views/myPage/index'
import { AuthFilter } from '@/router/auth';

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: Home
  },
  {
    path: '/ApplyCompany',
    component: ApplyCompany
  },
  {
    path: '/MyPage/:id',
    component: MyPage
  },
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  routes
})
router.afterEach(AuthFilter);

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
