
<template>
<MainHeader theme="red" bgc="natural-1"></MainHeader>
<!-- 主內容 -->
  <main class="whole-bg">
    <!-- top nav -->
    <memberNav/>
  
    <!-- v-if : 審核判斷 -->
    <div class="helperCenter">
      <!-- hc : helper-center -->
  
      <!-- 無身分 -->
      <div class="hc-not-passed">
    
        <div class="hc-title">
          <h6 class="bold">想成為小幫手嗎？簡單四步驟成為最可靠的小幫手</h6>
        </div>
    
        <div class="hc-nav">
            <!-- v-if? : 每完成一個步驟就放上打勾的icon? -->
            <div class="hc-steps"> 
              <p>適性測驗</p>
              <p class="hc-status">(已完成)</p>
            </div>
            <div class="hc-steps">
              <p>資料審核</p>
              <p class="hc-status">(已審核)</p>
            </div>
            <div class="hc-steps">
              <p>合約簽署</p>
              <p class="hc-status">(已簽署)</p>
            </div>
            <div class="hc-steps">
              <p>小幫手管理</p>
              <p class="hc-status" style="display: none;">(已審核)</p>
            </div>
    
        </div>
        
        <div class="hc-post-manage">
          <h6 class="bold">貼文發布管理</h6>
    
          <div class="divider"></div>
    
          <div class="hc-msg">
            <p>通過小幫手認證後才可以管理貼文喔~</p>
          </div>          
    
        </div>
    
    
      </div>
    
      <!-- 有身分 ，貼文管理-->
      <div class="hc-passed">
        <div class="hc-post-manage">
    
          <h6 class="bold">貼文發布管理</h6>
    
          <div class="divider"></div>
    
          <div class="hc-grid-container">
            <!-- 1 -->
            <div class="hc-postCard" id="hcPostBuddy">
    
              <div class="postCard">
              </div>
              <div class="hc-btn-group">
                <Btn btnStyle="primary default" id="editPostCard">編輯</Btn>
                <div class="btn-group">
                  <Btn btnStyle="baseline small" id="deletePostCard" @click="togglePopUp_deleteCard">刪除貼文</Btn>
                </div>
              </div>                
              
            </div>
            <!-- 2 -->
            <div class="hc-postCard empty" id="hcPostCare">     <!-- 之後 empty 改用監聽加上 -->
              <div class="btn-group">
                <Btn btnStyle="baseline small">+ 到府照顧</Btn>
              </div>
            </div>
            <!-- 3 -->
            <div class="hc-postCard empty" id="hcPostStay">
              <div class="btn-group">
                <Btn btnStyle="baseline small">+ 友善寄宿</Btn>
              </div>                
            </div>
            <!-- 4 -->
            <div class="hc-postCard empty" id="hcPostUber">
              <div class="btn-group">
                <Btn btnStyle="baseline small">+ 到府接送</Btn>
              </div>                
            </div>
          </div>          
    
        </div>
    
      </div>     
    </div>

    <!-- PopUp，刪除卡片 -->
    <PopUp
    :is-pop-up="deleteCard.isPopUp.value"
    @toggle="togglePopUp_deleteCard">
      <div class="delete-petcard">
        <div class="title">
          <p class="bold">確定刪除資訊卡?</p>
        </div>
        <div class="btn-group">
          <Btn btnStyle="primary small" @click="togglePopUp_deleteCard">確定</Btn>
          <Btn btnStyle="baseline small" @click="togglePopUp_deleteCard">取消</Btn>
        </div>
      </div>
    </PopUp>
  


    <!-- circle bg -->
    <div class="member-circle"></div>  

  </main>

  
</template>

<script setup>

import { ref } from 'vue';
// components
import MainHeader from '@/components/MainHeader.vue';
import Btn from '@/components/Btn.vue';
import DropdownMenu from '../components/DropdownMenu.vue';
import InputText from '../components/InputText.vue';
import LightBox from '../components/LightBox.vue';
// pages
import memberNav from '../views/memberNav.vue' ;

//popup狀態
const deleteCard = { isPopUp : ref (false )  };

// 刪除資訊卡
// 控制燈箱的顯示與隱藏
function togglePopUp_deleteCard() {
  deleteCard.isPopUp.value = !deleteCard.isPopUp.value;
  // // 停止捲軸
  if (deleteCard.isPopUp.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
};

</script>