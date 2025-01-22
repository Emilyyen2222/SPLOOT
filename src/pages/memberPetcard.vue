
<template>
<MainHeader theme="red" bgc="natural-1"></MainHeader>
<!-- 主內容 -->
<main class="whole-bg">
  <!-- top nav -->
  <memberNav/>

<div class="petcardView">
      <div class="petcard-title">
          <h6 class="bold">寵物資訊卡</h6>
          <p>目前有2張資訊卡</p>
      </div>
  
      <div class="divider"></div>
  
      <!-- view -->
      <div class="petcard-container">
          <!-- card1 -->
          <div class="petcard">
            <div class="ptc-top">
                <!-- 元件 -->
            </div>
            <div class="ptc-btn-group">
              <Btn btnStyle="primary default" id="deletePetCard">編輯</Btn>
              <div class="btn-group">
                <Btn btnStyle="baseline small" id="editPetCard">刪除卡片</Btn>
                <Btn btnStyle="baseline small" id="editPetCard">配對喜好設定</Btn>
              </div>
            </div>
          </div>
            <!-- card2 -->
          <div class="petcard">
            <div class="ptc-top">
                <!-- 元件 -->
            </div>
            <div class="ptc-btn-group">
              <Btn btnStyle="primary default" id="deletePetCard">編輯</Btn>
              <div class="btn-group">
                <Btn btnStyle="baseline small" id="editPetCard">刪除卡片</Btn>
                <Btn btnStyle="baseline small" id="editPetCard">配對喜好設定</Btn>
              </div>
            </div>
          </div>
            <!-- card3 -->
          <div class="petcard" id="addPetCard">
            <div class="" id="addPetCardBtn">
              <Btn btnStyle="baseline small">+ 狗狗資訊卡</Btn>
              <Btn btnStyle="baseline small">+ 貓貓資訊卡</Btn>
            </div>
          </div>           
      </div>

      <!-- popup，配對喜好調整 -->
      <div class="matchAdjust-wrapper">
        <div class="title">
          <h4 class="bold">配對喜好設定</h4>
        </div>
        <div class="divider"></div>

        <div class="matchAdjust">
          <div class="tag-wrapper">
            
            <div class="tag-container">
              <p>我想認識</p>
              <div class="tag-group">
                <Btn btnType="form" btnStyle="option">貓貓朋友</Btn>
                <Btn btnType="form" btnStyle="option">狗狗朋友</Btn>
                <Btn btnType="form" btnStyle="option">不限</Btn>
              </div>
            </div>

            <div class="tag-container">
              <p>絕育狀態*</p>
              <div class="tag-group">
                <Btn btnType="form" btnStyle="option">已結紮</Btn>
                <Btn btnType="form" btnStyle="option">未結紮</Btn>
                <Btn btnType="form" btnStyle="option">不限</Btn>
              </div>
            </div>

            <div class="tag-container">
              <p>社交性</p>
              <div class="tag-group">
                <Btn btnType="form" btnStyle="option">親寵親人</Btn>
                <Btn btnType="form" btnStyle="option">不親寵親人</Btn>
                <Btn btnType="form" btnStyle="option">親寵不親人</Btn>
                <Btn btnType="form" btnStyle="option">慢熟</Btn>
                <Btn btnType="form" btnStyle="option">小孩友善</Btn>
              </div>
            </div>

          </div>          
          <div class="btn-group">
            <Btn btnStyle="primary small">儲存</Btn>
            <Btn btnStyle="baseline small">取消修改</Btn>
          </div>
        </div>
      </div>

      <!-- popup，刪除卡片 -->
      <div class="delete-petcard">
        <div class="title">
          <p class="bold">確定刪除資訊卡?</p>
        </div>
        <div class="btn-group">
          <Btn btnStyle="primary small">確定</Btn>
          <Btn btnStyle="baseline small">取消</Btn>
        </div>
      </div>
  
</div>

  <!-- circle bg -->
  <div class="member-circle"></div>

</main>

</template>

<script setup>

import { ref } from 'vue';
// components
import MainHeader from '../components/MainHeader.vue';
import Btn from '../components/Btn.vue';
import DropdownMenu from '../components/DropdownMenu.vue';
import InputText from '../components/InputText.vue';
import LightBox from '../components/LightBox.vue';
// pages
import memberNav from '../pages/memberNav.vue' ;

</script>