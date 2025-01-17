// Sam
import { createRouter, createWebHistory } from "vue-router";

// path → component
const routes = [
  {
    path: '/',
    component: () => import('@/pages/homeView.vue'),
    meta: {
      title: 'Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
      bodyId: 'home',
    }
  },
  {
    path: '/ds',
    component: () => import('@/pages/dsView.vue'),
    meta: {
      title: '元件庫 | Sploot',
      theme: 'blue',
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
    path: '/sploot-box/question',
    component: () => import('@/pages/questionView.vue'),
    meta: {
      title: '訂閱寵物盒 | Sploot',
      theme: 'red',
      bodyBg: 'pink-2',
    }
  },
  {
    path: '/match',
    component: () => import('@/pages/matchView.vue'),
    meta: {
      title: '認識毛毛友 | Match',
      theme: 'red',
      bodyBg: 'purple-1',
    }
  },
  {
    path: '/sploot-buddy',
    component: () => import('@/pages/splootBuddyView.vue'),
    meta: {
      title: '尋找小幫手 | Sploot',
      theme: 'blue',
      bodyBg: 'blueberry-0',
    }
  },
  {
    path: '/sploot-event',
    component: () => import('@/pages/eventView.vue'),
    meta: {
      title: '毛孩日曆 | Sploot',
      theme: 'blue',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/sploot-pet-friendly',
    component: () => import('@/pages/petFriendlyView.vue'),
    meta: {
      title: '友善設施 | Sploot',
      theme: 'blue',
      bodyBg: 'blue-1',
    }
  },
  {
    path: '/sploot-buddy/buddy-post',
    component: () => import('@/pages/buddyPostView.vue'),
    meta: {
      title: '尋找小幫手 | Sploot',
      theme: 'blue',
      bodyBg: 'blueberry-0',
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
    bodyClass += ` redTheme`;
  }else if(to.meta.theme == 'blue'){
    iconLink.href = new URL('@/assets/img/header-blue.svg', import.meta.url).href;
    bodyClass += ` blueTheme`;
  }

  document.body.classList = bodyClass

  next();
});

export default router;