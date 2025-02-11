<template>
  <MainHeader theme="red" bgc="yellow-1"></MainHeader>
  <section class="scrollSection landing bg-yellow-1">
    <div class="mainBox">
      <div class="bigText text-red">CONNECT THROUGH SPLOOT</div>
      <img src="@/assets/img/home/landing.svg" alt="landing">
    </div>

     <img class="landingCircle" src="@/assets/img/home/landingCircle.svg" alt="landingCircle">
  </section>


  <section class="scrollSection match bg-purple-2">
    <div class="mainBox">
      <div class="bigText text-purple-0">THE PERFECT PET PLAYDATE AWAITS.</div>
      <div class="mainText">
        <div class="content">
          <h2 class="bold">結交新朋友</h2>
          <h6>為您的毛孩找到最合拍的新朋友<br>建立專屬牠的朋友圈</h6>
        </div>
        <RouterLink to="/match">
          <Btn btnStyle="primary large">立即配對</Btn>
        </RouterLink>
      </div>
      <img src="@/assets/img/home/match.svg" alt="match">
    </div>

    <div class="homeCircle"></div>
  </section>

  <section class="scrollSection splootBox bg-pink-2">
    <div class="mainBox">
      <div class="bigText text-pink-0">MAKING PET LIVES PAWSOME!</div>
      <div class="mainText">
        <div class="content">
        <h2 class="bold">給寵物一個驚喜</h2>
        <h6>每月精選專屬好禮，讓您的寵物驚喜連連，幸福滿分！</h6>
      </div>
      <RouterLink to="sploot-box">
        <Btn btnStyle="primary large">立即訂閱寵物盒</Btn>
      </RouterLink>
      </div>
      <img src="@/assets/img/home/splootBox.svg" alt="splootBox">
    </div>

    <div class="homeCircle"></div>
  </section>

  <section class="scrollSection splootBuddy bg-blueberry-2">
    <div class="mainBox">
      <div class="bigText text-blueberry-0">Your everyday pet Helper at hand</div>
      <div class="mainText">
        <div class="content">
          <h2 class="bold">尋找小幫手</h2>
          <h6>一站解決飼養疑問，從散步到訓練，全方位支援！</h6>
        </div>
        <RouterLink to="sploot-buddy">
          <Btn btnStyle="primary large">立即尋找</Btn>
        </RouterLink>
      </div>
      <img src="@/assets/img/home/splootBuddy.svg" alt="splootBuddy">
    </div>

    <div class="homeCircle"></div>
  </section>

  <section class="scrollSection event bg-yellow-2">
    <div class="mainBox">
      <div class="bigText text-yellow-0">Where pets and owners connect.</div>
      <div class="mainText">
        <div class="content">
          <h2 class="bold">揪團出遊</h2>
          <h6>參與各種有趣活動，與愛寵人士一起共享美好時光</h6>
        </div>
        <RouterLink to="sploot-event">
          <Btn btnStyle="primary large">查看日曆</Btn>
        </RouterLink>
      </div>
      <img src="@/assets/img/home/event.svg" alt="event">
    </div>

    <div class="homeCircle"></div>
  </section>

  <section class="scrollSection splootFriendly bg-blue-1">
    <div class="mainBox">
      <div class="bigText text-blue-0">Discover pet-friendly spaces near you!</div>
      <div class="mainText">
        <div class="content">
          <h2 class="bold">寵物友善設施</h2>
          <h6>探索附近的寵物友善地點，讓外出時光更輕鬆愉快！</h6>
        </div>
        <RouterLink to="sploot-pet-friendly">
          <Btn btnStyle="primary large">立即探索</Btn>
        </RouterLink>
      </div>
      <img src="@/assets/img/home/splootFriendly.svg" alt="splootFriendly">
    </div>

    <div class="homeCircle"></div>
  </section>
  <MainFooter class="scrollSection"></MainFooter>
</template>

<script setup>
import { ref, onMounted } from "vue";

import MainHeader from '../components/MainHeader.vue';
import MainFooter from '../components/MainFooter.vue';
import Btn from '../components/Btn.vue';
import { RouterLink } from "vue-router";


// onMounted(() => {
//   const sections = document.querySelectorAll('.scrollSection'); // querySelect 去找每一個會滑動的 section
//   let currentSectionIndex = 0; // 追蹤目前在第幾個區塊
//   let isScrolling = false; // 偵測目前是否在滑動，預防滑動的時候觸發太多次

//   const scrollToSection = (index) => {
//       sections[index].scrollIntoView({ behavior: 'smooth' });
//   }; // function 滑動到 第[index]個 section 
//   // behavior smooth 是讓他可以滑順的滑倒下一個section 拿掉的話會變成用跳的到下一個區塊

//   const handleScroll = (e) => {
//       if (isScrolling) return; // 如果正在滑動就返回，預防觸發太多次

//       isScrolling = true; // 表示正在滑動
//       if (e.deltaY > 0 && currentSectionIndex < sections.length - 1) { // e.deltaY > 0 代表在往下滑
//           currentSectionIndex++; // 如果正在往下滑 且 目前不在最後一個section -> 滑到下一個
//       } else if (e.deltaY < 0 && currentSectionIndex > 0) { // e.deltaY < 0 代表在往上滑
//           currentSectionIndex--; // 如果正在往上滑 且 目前不在第一個section -> 滑到上一個
//       }

//       scrollToSection(currentSectionIndex); // function 滑到下一個區塊

//       // 加一個 delay 預防觸發太多次滑動
//       setTimeout(() => {
//           isScrolling = false;
//       }, 1000);
//   };

//   document.addEventListener('wheel', handleScroll);
//   // wheel 跟 scroll 不一樣
//   // wheel 是只要嘗試滑動或有滑動的動作就會觸發
//   // scroll 是實際上頁面有滑動的時候才會觸發

// });
</script>

<style lang="scss" scoped>
  // @import "../assets/sass/style.scss";
  // #home{
  //   header{
  //     position: fixed;
  //     &.bg-yellow-1{
  //       background-color: transparent;
  //     }
  //   }
  // }
</style>