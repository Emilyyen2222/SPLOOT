
<template>

    <div id="app">

      <!-- top nav -->
      <div class="topNav">
        <!-- msg & avatar -->
        <div class="msg-n-avatar">
            <!-- avatar -->
            <div class="avatar"></div>
            <!-- msg -->
            <div class="msg-welcome">
            <h5 class="bold">嗨! <span id="msgUsername">username</span> 歡迎回來</h5>
            </div>
        </div>
        <!-- mc nav -->
        <div class="mcNav">
          <div class="btn-wrapper">
            <!-- <RouterLink to="/member-center">
              <Btn btnStyle="white default">會員資料</Btn>
            </RouterLink> -->        
            <Btn btnStyle="white default">會員資料</Btn>
          </div>      
          <div class="btn-wrapper">
            <!-- <RouterLink to="/member-center">
              <Btn btnStyle="white default">寵物資訊卡</Btn>
            </RouterLink> -->
            <Btn btnStyle="white default">寵物資訊卡</Btn>
            <!-- <Btn btnstyle="white default">建立寵物資訊卡</Btn>
            <Btn btnstyle="white default">寵物資訊卡一覽</Btn> -->        
          </div>      
          <div class="btn-wrapper">
            <!-- <RouterLink to="/member-center">
              <Btn btnStyle="white default">寵物盒訂閱紀錄</Btn>
            </RouterLink> -->        
            <Btn btnStyle="white default">寵物盒訂閱紀錄</Btn>
          </div>      
          <div class="btn-wrapper">
            <!-- <RouterLink to="/member-center">
              <Btn btnStyle="white default">小幫手中心</Btn>
            </RouterLink> -->          
            <Btn btnStyle="white default">小幫手中心</Btn> 
          </div>      
            
        </div>
      </div>        

    </div>

</template>

<script setup>

import { ref } from 'vue';

import MainHeader from '../components/MainHeader.vue';
import Btn from '../components/Btn.vue';

// data

//const


</script>