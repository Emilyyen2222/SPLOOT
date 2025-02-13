
<template>

  <!-- top nav -->
  <div class="topNav">
    <!-- msg & avatar -->
    <div class="msg-n-avatar">
        <!-- avatar -->
        <div class="avatar">
          <!-- 改ref -->
          <!-- <img src="../assets/img/member-center/portrait1.svg" alt=""> -->
          <!-- <img :src="selectedAvatar.value" alt="avatar"> -->
          <img :src="memberPortrait" alt="avatar">
        </div>
        <!-- msg -->
        <div class="msg-welcome">
        <h5 class="bold">嗨! <span id="msgUsername">username</span> 歡迎回來</h5>
        </div>
    </div>
    <!-- mc nav -->
    <div class="mcNav">
      <div class="btn-wrapper">
        <RouterLink to='/member-center' custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn"
          >會員資料</Btn>
        </RouterLink>        
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/petcard" custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn">寵物資訊卡</Btn>
        </RouterLink>
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/subscription" custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn">寵物盒訂閱紀錄</Btn>
        </RouterLink>        
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/helper" custom v-slot="{navigate, isActive}">
          <Btn :btnStyle="isActive ? 'primary default' : 'white default'" 
          @click="navigate" 
          class="mcNav-btn">小幫手中心</Btn>
        </RouterLink>          
      </div>      
        
    </div>
  </div>       

</template>

<script setup>

import { ref,inject, computed } from 'vue';

// components
import Btn from '../components/Btn.vue';
// import DropdownMenu from '../components/DropdownMenu.vue';
// import InputText from '../components/InputText.vue';
// import LightBox from '../components/LightBox.vue';

const props = defineProps({
  avatar: {
    type: Number,
    default: 1
  }
})

// const memberPortraitChosed = computed(() => {
//   return props.avatar;
// });
const memberPortrait = computed(()=> {      
        console.log("帶進switch的值:", props.avatar);
        switch (props.avatar){
          case 1 : 
            return new URL(`@/assets/img/member-center/portrait1.svg`,import.meta.url).href;
          case 2 : 
            return new URL(`@/assets/img/member-center/portrait2.svg`,import.meta.url).href;
          case 3 : 
            return new URL(`@/assets/img/member-center/portrait3.svg`,import.meta.url).href;
          case 4 : 
            return new URL(`@/assets/img/member-center/portrait4.svg`,import.meta.url).href;
          case 5 : 
            return new URL(`@/assets/img/member-center/portrait5.svg`,import.meta.url).href;
          case 6 : 
            return new URL(`@/assets/img/member-center/portrait6.svg`,import.meta.url).href;
          case 7 : 
            return new URL(`@/assets/img/member-center/portrait7.svg`,import.meta.url).href;
          case 8 : 
            return new URL(`@/assets/img/member-center/portrait8.svg`,import.meta.url).href;
          default:
            return new URL(`@/assets/img/member-center/portrait1.svg`,import.meta.url).href;
        };
      });
// data
  // 確保本身有值 
const injectedAvatar = inject('memberPortrait',ref(""));
const selectedAvatar = computed(()=>injectedAvatar.value);
console.log("收到的 selectedAvatar:", selectedAvatar.value);


  if(selectedAvatar){
    console.log("nav收到的值(格式化之前):",selectedAvatar.value

  )};



// // 重新格式化 URL
// const formattedAvatarURL = computed(() => {
//   if (!selectedAvatar.value) return "";

//   // ✅ 提取文件名稱
//   const fileName = selectedAvatar.value.split("/").pop(); // 取得 `portrait6.svg`

//   // ✅ 重新構造 Vue `@/assets/...` 路徑
//   return new URL(`@/assets/img/member-center/${fileName}`, import.meta.url).href;
// });
// console.log("nav收到的值(格式化之後):",formattedAvatarURL.value);


  // avatar
  const avatars=[
  {avatarId:1,img: new URL("@/assets/img/member-center/portrait1.svg", import.meta.url).href},
  {avatarId:2,img: new URL("@/assets/img/member-center/portrait2.svg", import.meta.url).href},
  {avatarId:3,img: new URL("@/assets/img/member-center/portrait3.svg", import.meta.url).href},
  {avatarId:4,img: new URL("@/assets/img/member-center/portrait4.svg", import.meta.url).href},
  {avatarId:5,img: new URL("@/assets/img/member-center/portrait5.svg", import.meta.url).href},
  {avatarId:6,img: new URL("@/assets/img/member-center/portrait6.svg", import.meta.url).href},
  {avatarId:7,img: new URL("@/assets/img/member-center/portrait7.svg", import.meta.url).href},
  {avatarId:8,img: new URL("@/assets/img/member-center/portrait8.svg", import.meta.url).href},
];


</script>