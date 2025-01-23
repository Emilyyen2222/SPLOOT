
<template>

  <!-- top nav -->
  <div class="topNav">
    <!-- msg & avatar -->
    <div class="msg-n-avatar">
        <!-- avatar -->
        <div class="avatar">
          <!-- 改ref -->
          <img src="../assets/img/member-center/portrait1.svg" alt="">
        </div>
        <!-- msg -->
        <div class="msg-welcome">
        <h5 class="bold">嗨! <span id="msgUsername">username</span> 歡迎回來</h5>
        </div>
    </div>
    <!-- mc nav -->
    <div class="mcNav">
      <div class="btn-wrapper">
        <RouterLink to='/member-center/member-info'>
          <Btn btnStyle="white default" class="mcNav-btn" :class="{ active: isActive }" @click="mc_changeColor">會員資料</Btn>
        </RouterLink>        
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/petcard">
          <Btn btnStyle="white default">寵物資訊卡</Btn>
        </RouterLink>
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/sub-record">
          <Btn btnStyle="white default">寵物盒訂閱紀錄</Btn>
        </RouterLink>        
      </div>      
      <div class="btn-wrapper">
        <RouterLink to="/member-center/helper">
          <Btn btnStyle="white default">小幫手中心</Btn>
        </RouterLink>          
      </div>      
        
    </div>
  </div>       

</template>

<script setup>

import { ref } from 'vue';

// components
import Btn from '../components/Btn.vue';
import DropdownMenu from '../components/DropdownMenu.vue';
import InputText from '../components/InputText.vue';
import LightBox from '../components/LightBox.vue';

// data

//const
// mcNav 按鈕狀態
// const isActive = ref( false );

// const mc_changeColor = () => {
//   isActive.value = !isActive.value;
// };
//
// function mc_changeColor(){
//   if(){
    
//   } else{

//   }
// };

</script>