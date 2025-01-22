
<template>
<MainHeader theme="red" bgc="natural-1"></MainHeader>
<!-- 主內容 -->
<main class="whole-bg">

  <!-- top nav -->
  <memberNav/> 

  <!-- 會更新的區塊 -->
  <div class="memberCenter"> 

    
    <!-- main content -->
    
    <!-- 會員資料 -->
    <div class="memberInfo" >
      
    </div> 

  
     <!-- 檢視寵物卡 -->
     <div class="memberPetcard" >
      
    </div>    
  
     <!-- 訂閱紀錄 -->
     <div class="memberSubRecord" >
      
    </div> 
  
    <!-- 小幫手中心 -->
    <div class="memberHelper" >
      
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
  import memberInfo from '../pages/memberInfo.vue' ;
  import memberPetcard from './memberPetcard.vue' ;
  import memberSubRecord from '../pages/memberSubRecord.vue' ;
  import memberHelper from '../pages/memberHelper.vue' ;
  import memberNav from '../pages/memberNav.vue' ;

//data
// const 
// import { useRoute } from "vue";

// const mRoute = useRoute();

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

//  // lightBox 狀態
// let isLightBox = ref(false);

// // 控制燈箱的顯示與隱藏
// function toggleLightBox() {
//   isLightBox.value = !isLightBox.value;
//   // 根據狀態新增或移除 clicked 類別
//   if (isLightBox.value) {
//     document.body.classList.add('clicked');
//   } else {
//     document.body.classList.remove('clicked');
//   }
// };


</script>
