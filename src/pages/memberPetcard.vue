
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
            </div>
            <div class="ptc-btn-group">
              <Btn btnStyle="primary default" id="deletePetCard">編輯</Btn>
              <div class="btn-group">
                <Btn btnStyle="baseline small" id="editPetCard">刪除卡片</Btn>
                <Btn btnStyle="baseline small" id="editPetCard" @click="toggleLightBox_match">配對喜好設定</Btn>
              </div>
            </div>
          </div>
            <!-- card2 -->
          <div class="petcard">
            <div class="ptc-top">
            </div>
            <div class="ptc-btn-group">
              <Btn btnStyle="primary default" id="deletePetCard">編輯</Btn>
              <div class="btn-group">
                <Btn btnStyle="baseline small">刪除卡片</Btn>
                <Btn btnStyle="baseline small"  @click="toggleLightBox_match">配對喜好設定</Btn>
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



      <!-- popup，刪除卡片 -->
      <div class="delete-petcard" style="display: none;">
        <div class="title">
          <p class="bold">確定刪除資訊卡?</p>
        </div>
        <div class="btn-group">
          <Btn btnStyle="primary small">確定</Btn>
          <Btn btnStyle="baseline small">取消</Btn>
        </div>
      </div>
  
</div>

    <!-- popup，配對喜好調整 -->
    <LightBox 
      :title="lightTitle6.title"
      :is-light-box="lightTitle6.isLightBox.value" 
      @toggle="toggleLightBox_match"
      pY="5.6rem" 
      pX="5.6rem"
      bgc="transparent:50%"
      id="matchAdjustPop" 
      class="matchAdjust-wrapper">

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
    </LightBox>

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

// dropDown
const menu1 = {
    placeHolder: '請選擇月份',
    options: [
        {
            id: 0,
            name: '1'
        },
        {
            id: 1,
            name: '2'
        },
        {
            id: 2,
            name: '3'
        },
        {
            id: 3,
            name: '4'
        },
        {
            id: 4,
            name: '5'
        },
        {
            id: 5,
            name: '6'
        },
        {
            id: 6,
            name: '7'
        },
        {
            id: 7,
            name: '8'
        },
        {
            id: 8,
            name: '9'
        },
        {
            id: 9,
            name: '10'
        },
        {
            id: 10,
            name: '11'
        },
        {
            id: 11,
            name: '12'
        },
    ]
};

const menu2 = {
    placeHolder: '請選擇日期',
    options: [
        {
            id: 0,
            name: '選項1'
        },
        {
            id: 1,
            name: '選項2'
        },
        {
            id: 2,
            name: '選項3'
        },
        {
            id: 3,
            name: '選項4'
        },
    ]
};
// input
 // basic name 姓名
const input1 = {
    size: 'small',
    textAlign: 'textLeft',
    placeHolder: '這裡填預設文字',
    errorMsg: 'Invalid Input',
    inputValue: ref(''),
    inputError: ref(false),
}
const input3 = {
    size: 'small',
    textAlign: 'textLeft',
    placeHolder: '輸入新的信箱',
    errorMsg: 'Invalid Input',
    inputValue: ref(''),
    inputError: ref(false),
};
const input4 = {
    size: 'small',
    textAlign: 'textLeft',
    placeHolder: '輸入驗證碼',
    errorMsg: 'Invalid Input',
    inputValue: ref(''),
    inputError: ref(false),
};
const input5 = {
    size: 'small',
    textAlign: 'textLeft',
    placeHolder: '輸入驗證碼',
    errorMsg: 'Invalid Input',
    inputValue: ref(''),
    inputError: ref(false),
};
const input6 = {
    size: 'small',
    textAlign: 'textLeft',
    placeHolder: '輸入驗證碼',
    errorMsg: 'Invalid Input',
    inputValue: ref(''),
    inputError: ref(false),
};


// // lightBox title
const lightTitle4 = {title: "狗狗資訊卡", isLightBox: ref(false)};
const lightTitle5 = {title: "貓貓資訊卡", isLightBox: ref(false)};
const lightTitle6 = {title: "配對喜好設定", isLightBox: ref(false)};
//  // lightBox 狀態
// let isLightBox = ref(false);

// 控制燈箱的顯示與隱藏
 // 配對喜好設定 
function toggleLightBox_match() {
  lightTitle6.isLightBox.value = !lightTitle6.isLightBox.value;
  // 根據狀態新增或移除 clicked 類別
  if (lightTitle6.isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
};
</script>