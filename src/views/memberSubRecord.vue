
<template>
<MainHeader theme="red" bgc="natural-1"></MainHeader>
<!-- 主內容 -->
<main class="whole-bg">
  <!-- top nav -->
  <memberNav/>
  
  <div class="subRecord">
  
    <!-- recently sub -->
    <div class="sub-recently">
      <div class="sr-title">
        <h6 class="bold">當前方案</h6>
        <p>目前有4個訂閱</p>
      </div>
    
      <div class="divider"></div>
    
      <div class="sr-slider">
          <div class="cards-container">
              <!-- v-for -->
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                      <!-- cardData? -->
                      <div class="srItems">
                        <p>訂閱方案</p>
                        <!-- 連結資料庫 -->
                        <p> 銀卡 (3個月方案)</p>
                      </div>
                      <div class="srItems">
                        <p>訂閱日期</p>
                        <!-- 連結資料庫 -->
                        <p> 2025/01/02</p>
                      </div>
                      <div class="srItems">
                        <p>配送日期</p>
                        <!-- 連結資料庫 -->
                        <p> 每月10日</p>
                      </div>
                      <div class="srItems">
                        <p>已配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 0</p>
                      </div>
                      <div class="srItems">
                        <p>剩餘配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 3</p>
                      </div>
                      <div class="srItems">
                        <p>金額</p>
                        <!-- 連結資料庫 -->
                        <p class="bold"> $ 1299</p>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small" @click="toggleLightBox_resub">續約</Btn>
                    </div>
                  </div>
              </div>
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                      <!-- cardData? -->
                      <div class="srItems">
                        <p>訂閱方案</p>
                        <!-- 連結資料庫 -->
                        <p> 銀卡 (3個月方案)</p>
                      </div>
                      <div class="srItems">
                        <p>訂閱日期</p>
                        <!-- 連結資料庫 -->
                        <p> 2025/01/02</p>
                      </div>
                      <div class="srItems">
                        <p>配送日期</p>
                        <!-- 連結資料庫 -->
                        <p> 每月10日</p>
                      </div>
                      <div class="srItems">
                        <p>已配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 0</p>
                      </div>
                      <div class="srItems">
                        <p>剩餘配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 3</p>
                      </div>
                      <div class="srItems">
                        <p>金額</p>
                        <!-- 連結資料庫 -->
                        <p class="bold"> $ 1299</p>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div>
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                      <!-- cardData? -->
                      <div class="srItems">
                        <p>訂閱方案</p>
                        <!-- 連結資料庫 -->
                        <p> 銀卡 (3個月方案)</p>
                      </div>
                      <div class="srItems">
                        <p>訂閱日期</p>
                        <!-- 連結資料庫 -->
                        <p> 2025/01/02</p>
                      </div>
                      <div class="srItems">
                        <p>配送日期</p>
                        <!-- 連結資料庫 -->
                        <p> 每月10日</p>
                      </div>
                      <div class="srItems">
                        <p>已配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 0</p>
                      </div>
                      <div class="srItems">
                        <p>剩餘配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 3</p>
                      </div>
                      <div class="srItems">
                        <p>金額</p>
                        <!-- 連結資料庫 -->
                        <p class="bold"> $ 1299</p>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div>
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                      <!-- cardData? -->
                      <div class="srItems">
                        <p>訂閱方案</p>
                        <!-- 連結資料庫 -->
                        <p> 銀卡 (3個月方案)</p>
                      </div>
                      <div class="srItems">
                        <p>訂閱日期</p>
                        <!-- 連結資料庫 -->
                        <p> 2025/01/02</p>
                      </div>
                      <div class="srItems">
                        <p>配送日期</p>
                        <!-- 連結資料庫 -->
                        <p> 每月10日</p>
                      </div>
                      <div class="srItems">
                        <p>已配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 0</p>
                      </div>
                      <div class="srItems">
                        <p>剩餘配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 3</p>
                      </div>
                      <div class="srItems">
                        <p>金額</p>
                        <!-- 連結資料庫 -->
                        <p class="bold"> $ 1299</p>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div>
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                      <!-- cardData? -->
                      <div class="srItems">
                        <p>訂閱方案</p>
                        <!-- 連結資料庫 -->
                        <p> 銀卡 (3個月方案)</p>
                      </div>
                      <div class="srItems">
                        <p>訂閱日期</p>
                        <!-- 連結資料庫 -->
                        <p> 2025/01/02</p>
                      </div>
                      <div class="srItems">
                        <p>配送日期</p>
                        <!-- 連結資料庫 -->
                        <p> 每月10日</p>
                      </div>
                      <div class="srItems">
                        <p>已配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 0</p>
                      </div>
                      <div class="srItems">
                        <p>剩餘配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 3</p>
                      </div>
                      <div class="srItems">
                        <p>金額</p>
                        <!-- 連結資料庫 -->
                        <p class="bold"> $ 1299</p>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div>
              <div class="card">
                  <div class="card-title">
                      <p class="bold">小白</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                      <!-- cardData? -->
                      <div class="srItems">
                        <p>訂閱方案</p>
                        <!-- 連結資料庫 -->
                        <p> 銀卡 (3個月方案)</p>
                      </div>
                      <div class="srItems">
                        <p>訂閱日期</p>
                        <!-- 連結資料庫 -->
                        <p> 2025/01/02</p>
                      </div>
                      <div class="srItems">
                        <p>配送日期</p>
                        <!-- 連結資料庫 -->
                        <p> 每月10日</p>
                      </div>
                      <div class="srItems">
                        <p>已配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 0</p>
                      </div>
                      <div class="srItems">
                        <p>剩餘配送次數</p>
                        <!-- 連結資料庫 -->
                        <p> 3</p>
                      </div>
                      <div class="srItems">
                        <p>金額</p>
                        <!-- 連結資料庫 -->
                        <p class="bold"> $ 1299</p>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small">續約</Btn>
                    </div>
                  </div>
              </div>
    
          </div>
      </div>
    </div>
    
    <!-- history sub -->
    <div class="sub-history">
    
      <div class="sh-title">
        <h6 class="bold">歷史紀錄</h6>
        <smallText></smallText>
      </div>
    
      <div class="divider"></div>
    
      <div class="sh-h">
        <div class="sh-h-title">
          <p class="bold">索引</p>
          <p class="bold">寵物名稱</p>
          <p class="bold">定月方案</p>
          <p class="bold">訂閱日期</p>
          <p class="bold">金額</p>
        </div>
        <div class="sh-h-content">
          <!-- v-for -->
          <div class="sh-h-items">
            <p>01</p>
            <p>小白</p>
            <p>銀卡(三個月)</p>
            <p>2024/01/15</p>
            <p>$300</p>
          </div>
          <div class="sh-h-items">
            <p>02</p>
            <p>小白</p>
            <p>銀卡(三個月)</p>
            <p>2024/01/15</p>
            <p>$300</p>
          </div>
    
        </div>
      </div>
    
          
    </div> 
      
  </div>

  <!-- lightbox : 續約 -->
  <LightBox 
    :title="lightTitle_resub.title"
    :is-light-box="lightTitle_resub.isLightBox.value" 
    @toggle="toggleLightBox_resub">
  </LightBox>
  
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

// lightbox
const lightTitle_resub = { title: "續約" , isLightBox : ref(false) };
const lightTitle8 = { title: "" , isLightBox : ref(false) };

 // 控制lightbox狀態
function toggleLightBox_resub() {
  lightTitle_resub.isLightBox.value = !lightTitle_resub.isLightBox.value;
  if(lightTitle_resub.isLightBox.value){
    document.body.classList.add('clicked');
  }else{
    document.body.classList.remove('clicked');
  }
};

</script>