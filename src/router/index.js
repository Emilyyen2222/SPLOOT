// Sam
import { createRouter, createWebHistory } from "vue-router";

// path → component
const routes = [
  {
    path: '/',
    component: () => import('@/views/homeView.vue'),
    meta: {
      title: 'Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
      bodyId: 'home',
    }
  },
  {
    path: '/ds',
    component: () => import('@/views/dsView.vue'),
    meta: {
      title: '元件庫 | Sploot',
      theme: 'red',
      bodyBg: 'pink-2',
      bodyId: 'ds', // 有需要才加
      textColor: 'brown' //有需要才加
    }
  },
  {
    path: '/sploot-box',
    // component: () => import('@/views/splootboxView.vue'),
    // meta: {
    //   title: '訂閱寵物盒 | Sploot',
    //   theme: 'red',
    //   bodyBg: 'pink-0',
    // },
    children: [
      {
        path: '',
        component: () => import('@/views/splootboxView.vue'),
        meta: {
          title: '訂閱寵物盒 | Sploot',
          theme: 'red',
          bodyBg: 'pink-0',
        }
      },
      {
        path: 'question',
        component: () => import('@/views/questionView.vue'),
        meta: {
          title: '訂閱寵物盒 | Sploot',
          theme: 'red',
          bodyBg: 'pink-2',
        }
      }

    ]
  },
  // {
  //   path: '/sploot-box/question',
  //   component: () => import('@/views/questionView.vue'),
  //   meta: {
  //     title: '訂閱寵物盒 | Sploot',
  //     theme: 'red',
  //     bodyBg: 'pink-2',
  //   }
  // },
  {
    path: '/match',
    component: () => import('@/views/matchView.vue'),
    meta: {
      title: '認識毛毛友 | Match',
      theme: 'red',
      bodyBg: 'purple-1',
    }
  },
  {
    path: '/match/matchCard',
    component: () => import('@/views/matchCardView.vue'),
    meta: {
      title: '認識毛毛友 | MatchCard',
      theme: 'red',
      bodyBg: 'purple-1',
    }
  },
  {
    path: '/petInfoCard',
    component: () => import('@/views/petInfoCardView.vue'),
    meta: {
      title: '認識毛毛友 | petInfoCard',
      theme: 'red',
      bodyBg: 'purple-1',
    }
  },
  {
    path: '/sploot-buddy',
    component: () => import('@/views/splootBuddyView.vue'),
    meta: {
      title: '尋找小幫手 | Sploot',
      theme: 'blue',
      bodyBg: 'blueberry-0',
    }
  },
  {
    path: '/sploot-event',
    component: () => import('@/views/eventView.vue'),
    meta: {
      title: '毛孩日曆 | Sploot',
      theme: 'blue',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/sploot-pet-friendly',
    component: () => import('@/views/petFriendlyView.vue'),
    meta: {
      title: '友善設施 | Sploot',
      theme: 'blue',
      bodyBg: 'blue-1',
    }
  },
  {
    path: '/sploot-buddy/buddy-post',
    component: () => import('@/views/buddyPostView.vue'),
    meta: {
      title: '尋找小幫手 | Sploot',
      theme: 'blue',
      bodyBg: 'blueberry-0',
    }
  }, 
  {
    path: '/member-center',
    component: () => import('@/views/memberCenter.vue'),
    meta: {
      title: '會員中心 | Sploot',
      theme: 'red',
      bodyBg: 'natural-1',
    }
  },
  {
    path: '/member-center/petcard',
    component: () => import('@/views/memberPetcard.vue'),
    meta: {
      title: '寵物資訊卡 | Sploot',
      theme: 'red',
      bodyBg: 'natural-1',
    }
  },
  {
    path: '/member-center/subscription',
    component: () => import('@/views/memberSubscription.vue'),
    meta: {
      title: '訂閱紀錄 | Sploot',
      theme: 'red',
      bodyBg: 'natural-1',
    }
  },
  {
    path: '/member-center/helper',
    component: () => import('@/views/memberHelper.vue'),
    meta: {
      title: '會員資料 | Sploot',
      theme: 'red',
      bodyBg: 'natural-1',
    }
  },
  
  // 後台
  {
    path: '/backend/member',
    component: () => import('@/views/backend/memberManage.vue'),
    meta: {
      title: '會員管理 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/member',
    component: () => import('@/views/backend/memberManage.vue'),
    meta: {
      title: '會員管理 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/match',
    component: () => import('@/views/backend/matchManage.vue'),
    meta: {
      title: '配對管理 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/petCard-verify',
    component: () => import('@/views/backend/cardVerifyManage.vue'),
    meta: {
      title: '寵物照片審核 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/sploot-box',
    component: () => import('@/views/backend/splootBoxManage.vue'),
    meta: {
      title: '寵物盒方案管理 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/order',
    component: () => import('@/views/backend/orderManage.vue'),
    meta: {
      title: '訂單管理 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/splootBuddy-verify',
    component: () => import('@/views/backend/buddyVerifyManage.vue'),
    meta: {
      title: '小幫手身份審核 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/event',
    component: () => import('@/views/backend/eventManage.vue'),
    meta: {
      title: '活動管理 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  {
    path: '/backend/news',
    component: () => import('@/views/backend/newsManage.vue'),
    meta: {
      title: '消息管理 | Sploot',
      theme: 'red',
      bodyBg: 'yellow-1',
    }
  },
  
  
  
];

// 建立 router
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes,
  scrollBehavior(to, from, savedPosition) { //Ian
    if (savedPosition) {
      return savedPosition; // 如果有保存的位置，返回該位置
    } else {
      return { top: 0 };  // 否則滾動到頂部
    }
  }
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