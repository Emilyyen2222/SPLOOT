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
      bodyId: 'ds', // 有需要才加
      textColor: 'brown' //有需要才加
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
    path: '/question',
    component: () => import('@/pages/questionView.vue'),
    meta: {
      title: '訂閱寵物盒 | Sploot',
      theme: 'red',
      bodyBg: 'pink-2',
    }
  },
  {
    path: '/sploot-buddy',
    component: () => import('@/pages/splootBuddy.vue'),
    meta: {
      title: '尋找小幫手 | Sploot',
      theme: 'blue',
      bodyBg: 'blueberry-0',
    }
  },
  {
    path: '/sploot-calendar',
    component: () => import('@/pages/petCalendarView.vue'),
    meta: {
      title: '毛孩日曆 | Sploot',
      theme: 'blue',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/sploot-friendly',
    component: () => import('@/pages/petFriendlyView.vue'),
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
  let bodyClass = '';

  if(to.meta.bodyBg){ bodyClass = ` bg-${to.meta.bodyBg}`; }

  if(to.meta.theme == 'red'){
    iconLink.href = new URL('@/assets/img/header-red.svg', import.meta.url).href;
    bodyClass += ` text-brown`;
  }else if(to.meta.theme == 'blue'){
    iconLink.href = new URL('@/assets/img/header-blue.svg', import.meta.url).href;
    bodyClass += ` text-blue`;
  }

  document.body.classList = bodyClass

  next();
});

export default router;