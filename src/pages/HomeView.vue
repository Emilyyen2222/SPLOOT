<template>
  <MainHeader theme="red" bgc="yellow-1"></MainHeader>
  <section class="landing bg-yellow-1">
    <div class="mainText">
      <div class="bigText text-yellow-2">Connect Through Sploot</div>
      <h6 class="bold">
        SPLOOT是一個專屬寵物的交友平台，致力於打造溫暖的社群<br>結合交友、訂閱寵物盒與生活指南功能<br>不僅讓毛孩找到玩伴，也幫助家長輕鬆獲得客製化驚喜與實用資訊<br>讓毛孩與家長的生活更加完整與豐富</h6>
    </div>
  </section>
  <section class="match bg-purple-1">
    <div class="matchCards">
      <div class="matchCard">
        <img src="@/assets/img/home/matchCard.svg" alt="petImg">
        <div class="content">
          <div class="top-block">
            <h4>COCO</h4>
            <div class="distance">
              <img src="@/assets/img/icon/chip-natural-2.svg" alt="distanceIcon">
              <p class="smallText">距離你6公里</p>
            </div>
          </div>
          <div class="bottom-block">
            <div class="tagBox">
              <div class="tag">邊境牧羊</div>
              <div class="tag">活潑外向</div>
              <div class="tag">愛玩球</div>
            </div>
            <p>Sorem ipsum dolor sit amet, consectetur adipiscing elit.”</p>
          </div>
        </div>
      </div>
    </div>
    <div class="mainText">
      <div class="bigText text-purple-0">THE PERFECT PET PLAYDATE AWAITS.</div>
      <h6 class="bold">
        SPLOOT是一個專屬寵物的交友平台，致力於打造溫暖的社群<br>結合交友、訂閱寵物盒與生活指南功能<br>不僅讓毛孩找到玩伴，也幫助家長輕鬆獲得客製化驚喜與實用資訊<br>讓毛孩與家長的生活更加完整與豐富</h6>
    </div>
  </section>
  <section class="splootBox bg-pink-2"></section>
  <section class="splootBuddy bg-blueberry-0"></section>
  <section class="event bg-yellow-2"></section>
  <section class="splootFriendly bg-blue-1"></section>
</template>

<script setup>
import { ref } from "vue";

import MainHeader from '../components/MainHeader.vue';
</script>
