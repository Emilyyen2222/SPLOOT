// Sam
import { createRouter, createWebHistory } from "vue-router";

// path → component
const routes = [
  {
    path: '/',
    component: () => import('@/pages/dsView.vue'),
    meta: {
      title: 'Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/sploot-box',
    component: () => import('@/pages/splootboxView.vue'),
    meta: {
      title: '訂閱寵物盒 | Sploot',
      theme: 'red',
      bodyBg: 'pink-0',
    }
  },
  {
    path: '/sploot-buddy',
    component: () => import('@/pages/dsView.vue'),
    meta: {
      title: '尋找小幫手 | Sploot',
      theme: 'blue',
      bodyBg: 'blueberry-0',
    }
  },
  {
    path: '/sploot-calendar',
    component: () => import('@/pages/dsView.vue'),
    meta: {
      title: '毛孩日曆 | Sploot',
      theme: 'blue',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/sploot-friendly',
    component: () => import('@/pages/dsView.vue'),
    meta: {
      title: '友善設施 | Sploot',
      theme: 'blue',
      bodyBg: 'blue-1',
    }
  },
  
];

// 建立 router
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
});

router.beforeEach((to, from, next) => {

  document.title = to.meta.title;

  if(to.meta.bodyId){ document.body.id = to.meta.bodyId; }

  let iconLink = document.querySelector("link[rel~='icon']");

  if(to.meta.theme == 'red'){
    iconLink.href = 'src/assets/img/header-red.svg';
  }else if(to.meta.theme == 'blue'){
    iconLink.href = 'src/assets/img/header-blue.svg';
  }

  if(to.meta.bodyBg){ document.body.classList = `bg-${to.meta.bodyBg}`; }

  


  next();



});

export default router;