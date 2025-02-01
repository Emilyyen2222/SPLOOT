
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
    
      <div class="sr-slider"
       ref="sliderRef" 
       @wheel="handleWheel">
          <div class="cards-container">
              <!-- v-for -->
              <div class="card" v-for="card in cards" :key="card.id">
                  <div class="card-title">
                      <p class="bold">{{card.name}}</p> <!-- 寵物名 -->
                  </div>
                  <div class="card-content">
                    <div class="sr-items-group">
                      <!-- cardData? -->
                      <div class="srItems">
                        <p>訂閱方案</p>
                        <p> {{card.subscription }}</p>
                      </div>
                      <div class="srItems">
                        <p>訂閱日期</p>
                        <p> {{card.subscribeDate }}</p>
                      </div>
                      <div class="srItems">
                        <p>配送日期</p>
                        <p> {{card.deliveryDate }}</p>
                      </div>
                      <div class="srItems">
                        <p>已配送次數</p>
                        <p> {{ card.delivered  }}</p>
                      </div>
                      <div class="srItems">
                        <p>剩餘配送次數</p>
                        <p> {{ card.remaining  }}</p>
                      </div>
                      <div class="srItems">
                        <p>金額</p>
                        <p class="bold"> {{ card.amount  }}</p>
                      </div>
                    </div>
                    <div class="cardBtn">
                      <Btn btnStyle="primary small" @click="toggleLightBox_resub( card.id )">續約</Btn>
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
      </div>
    
      <div class="divider"></div>
    
      <div class="sh-h">
        <div class="sh-h-title">
          <p class="bold th_index">索引</p>
          <p class="bold th_petName">寵物名稱</p>
          <p class="bold th_plan">定月方案</p>
          <p class="bold th_date">訂閱日期</p>
          <p class="bold th_total">金額</p>
        </div>
        <div class="sh-h-content">
          <!-- v-for -->
          <!-- <div class="sh-h-items" v-for{ subHistory through in items } :key="id"> -->
          <div class="sh-h-items">
            <p class="tb_index">01</p>
            <p class="tb_petName">小白</p>
            <p class="tb_plan">銀卡(三個月)</p>
            <p class="tb_date">2024/01/15</p>
            <p class="tb_total">$300</p>
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
    <div class="boxPayment">
      <div class="questionContainer">
          <h4 class="title bold">完成購買程序</h4>
          <div class="options">
              <div class="paymentBox">
                  <div class="textBox">
                      <p>SPLOOT BOX 三個月方案 - 白金卡(Platinum)</p> 
                      <p>$3,597</p> 
                  </div>
                  <div class="boxDivider"></div>
                  <div class="textBox">
                      <p>月費</p> 
                      <p>$3,597</p> 
                  </div>
                  <div class="boxDivider"></div>
                  <div class="textBox">
                      <p>今日應付金額</p> 
                      <p>$3,597</p> 
                  </div>
              </div>
              <div class="infoBox">
                  <div class="xsText left">信用卡付款</div>
                  <InputText 
                  textAlign = "textLeft" 
                  placeHolder="卡號" 
                  errorMsg="Invalid Input" 
                  v-model="inputValue" 
                  :hasError="inputError">
                  </InputText>
                  <InputText textAlign = "textLeft" 
                  placeHolder="持卡人姓名" errorMsg="Invalid Input" 
                  v-model="inputValue" 
                  :hasError="inputError">
                  </InputText>
                  <div class="cardInfo">
                      <div class="info">
                          <DropdownMenu 
                          size=""
                          :placeHolder="menus.visaYear.placeHolder"
                          :options="menus.visaYear.options">
                          </DropdownMenu>
                      </div>
                      <div class="info">
                          <DropdownMenu 
                          size=""
                          :placeHolder="menus.visaMonth.placeHolder"
                          :options="menus.visaMonth.options">
                          </DropdownMenu>
                      </div>
                      <div class="info">
                      <InputText textAlign = "textLeft" 
                      placeHolder="安全碼" errorMsg="Invalid Input" 
                      v-model="inputValue" 
                      :hasError="inputError">
                      </InputText>
                      </div>
                  </div>
              </div>
          </div>
              <ul class="planItems">
                  <li class="xsText">SHOPLINE將會使用本次交易資訊作為後續定期扣款，點擊提交即同意 《SHOPLINE Payments 支付服務條款》及《SHOPLINE Payments 隱私權政策》。</li>
                  <li class="xsText">本金流服務由 SHOPLINE Payments 提供，通過 PCI-DSS 國際信用卡組織最高等級認證，提供安全的交易服務，支援國內外信用卡刷卡。</li>
              </ul>

              <li class="checkBox">
                  <div class="boxAlign">
                      <input type="checkbox">
                      <p class="xsText">
                          我同意 

                          <span class="xsText link" @click="toggleLightBox_userP" href="">網站服務條款</span> 及 
                          <span class="xsText link" @click="toggleLightBox_privacy" href="">隱私權政策</span>
                      </p>
                  </div>
                  <div class="boxAlign">
                      <input type="checkbox">
                      <p class="xsText">我同意成為 SPLOOT 的會員</p>
                  </div>
                  <div class="boxAlign">
                      <input type="checkbox">
                      <p class="xsText">我願意接收 SPLOOT 的最新消息、優惠及服務推廣相關資訊</p>
                  </div>
              </li>
          <Btn btnStyle="primary default" @click="toggleLightBox_resub">開始訂閱SPLOOT BOX</Btn>   
      </div>
    </div>    
  </LightBox>
  
    <!-- 使用者政策 -->
    <LightBox 
      :is-light-box="lightTitle_userPolicy.isLightBox.value" 
      :title="lightTitle_userPolicy.title"
      @toggle="toggleLightBox_userP">
      <h6>使用者政策</h6>
      <p>在您開始使用 SPLOOT布魯家 所經營之網站之前，請詳細閱讀以下所有服務條款：
      當您成為 SPLOOT布魯家 網站的會員時，即表示您已詳細閱讀、明確瞭解並同意接受本服務條款之所有內容。
      若您不同意所列之服務條款，則請您立即離開此網站或者不使用任何網站之任何服務提供。</p>
      <p class="bold">帳號</p>
      <p>當您向我們註冊新帳號時，請務必確保您所提供的資料皆是最準確、完整並且時常保持更新狀態。違反所列之條款者，將有可能導致被立即停止您的帳號以及網站所提供的所有服務。此外，在使用任何服務以及活動上，您有義務責任確保您的密碼安全、無論該密碼是透過使用我們服務而管理或者第三方服務。您必須立即通知我們，一旦您的密碼被盜用或者處於不安全狀態。</p>
      <p class="bold">連結到其他網站</p>
      <p>我們的服務可能含有部份連結，將連結到第三方網站或者服務。該些服務將不會處於我們的控制、操作以及擁有管轄權限的範圍內，所以本網站沒有承擔任何內容、隱私政策或者任何第三方網站所提供的服務之義務責任。您同意本網站不需要承擔任何責任、因使用該第三方網站所提供之內容、服務與商品而所導致的；直接或者間接性損失與破壞。我們強烈建議您必須詳細閱讀清楚有關您所造訪的第三方網站之服務條款以及隱私政策，以確保您自身的權益。</p>
      <p class="bold">終止服務</p>
      <p>在不需要任何事前通知以下，我們有可能隨時終止您使用我們網站服務的權限；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。在不需要任何事前通知以下，我們有可能隨時終止您所持有的登入帳號；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。一旦確定終止，您將會立即無法繼續使用所有服務。若您希望終止您的帳號，您可以隨時終止服務。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。</p>
      <p class="bold">政府法律</p>
      <p>以上所有條款將會會遵從（國家之法律）無論是否其條款衝突於法律服務條款。若我們未擁有執行以上條款之部份權益，並不等同於我們放棄所有條款的執行權益。若有以上有部份條款不適用於所指定之法庭，其其他之所有條款依然有效。以上所有條款達致雙方在服務使用上的一致性同意與協議，任何事前的協議將有可能影響雙方對於以上所有服務條款的取代或者更改。
      我們保留所有條款的更改、取代之權益，並所做出更改、取代之內容可自行決定。若有任何的更改涉及任何內容，我們將會嘗試提供最少30天的事前通知；該通知將會在新條款正式起效之前公布。至於任何內容的制定則由我們自行決定。若您欲繼續使用網站服務，請務必同意所有新條款；若您不同意新條款，將會要求停止使用網站所有服務。
      若您有任何問題與疑慮，煩請與 SPLOOT布魯家 進行聯繫。</p>
      <Btn @click="toggleLightBox_userP" class="padding" btnStyle="primary default">確定</Btn>
    </LightBox>

    <!-- 隱私權政策 -->
    <LightBox 
      :is-light-box="lightTitle_privacy.isLightBox.value" 
      :title="lightTitle_privacy.title"
      @toggle="toggleLightBox_privacy">
      <h6>隱私權政策</h6>
      <p>歡迎您使用 SPLOOT布魯家（以下簡稱「本公司」）係依據本服務條款提供 SPLOOT布魯家 (http://www.sploot.co) 服務（以下簡稱「本服務」），為了讓您能夠安心的使用本網站的各項服務與資訊，特此向您說明本網站的隱私權保護政策，以保障您的權益，請您詳閱下列內容：</p>
      <p class="bold">一、隱私權保護政策的適用範圍</p>
      <p>隱私權保護政策內容，包括本網站如何處理您在使用網站服務時收集到的個人識別資料。隱私權保護政策不適用於其他相關連結的網站，也不適用於非本網站所委託或參與管理的人員。</p>
      <p class="bold">二、個人資料的蒐集、處理及利用方式</p>
      <p>當您造訪本網站或使用本網站所提供之功能服務時，我們將視該服務功能性別，請您提供必要的個人資料，並於特定目的範圍內處理及使用您的個人資料；未經您的書面同意，將不會將個人資料用於其他用途。
      本網站在您使用服務信箱、填寫問卷、參加活動時，會保存您所提供的姓名、電子郵件信箱、聯絡方式及使用時間等。
      於一般瀏覽時，伺服器會自行記錄相關行為，包括您使用連線設備之IP位址、使用時間、瀏覽器及點擊紀錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公開。</p>
      <p class="bold">三、資料之保護</p>
      <p>本網站主機均設有防火牆、反病毒系統及其他相關的資訊安全設備及必要的安全防護措施，對於本網站及您的個人資料加以嚴格保護。
        未經授權之人員不得接觸您的個人資料，且所有接觸之人員均經簽署保密契約，違反保密義務者將受到相關法律處分。</p>
      <Btn @click="toggleLightBox_privacy" class="padding" btnStyle="primary default">確定</Btn>              
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

// cards
const cards = ref([
  {
    id: 1,
    name: '小白',
    subscription: '銀卡 (3個月方案)',
    subscribeDate: '2025/01/02',
    deliveryDate: '每月10日',
    delivered: 0,
    remaining: 3,
    amount: '$1299',
  },
  {
    id: 2,
    name: '小黑',
    subscription: '銀卡 (6個月方案)',
    subscribeDate: '2025/02/05',
    deliveryDate: '每月10日',
    delivered: 2,
    remaining: 4,
    amount: '$2299',
  },
  {
    id: 3,
    name: '小花',
    subscription: '銀卡 (1個月方案)',
    subscribeDate: '2025/03/10',
    deliveryDate: '每月10日',
    delivered: 1,
    remaining: 0,
    amount: '$699',
  },
  {
    id: 4,
    name: '小藍',
    subscription: '白金卡 (12個月方案)',
    subscribeDate: '2025/04/15',
    deliveryDate: '每月10日',
    delivered: 5,
    remaining: 7,
    amount: '$3999',
  },
  {
    id: 5,
    name: '小綠',
    subscription: '白金卡 (3個月方案)',
    subscribeDate: '2025/04/15',
    deliveryDate: '每月10日',
    delivered: 5,
    remaining: 7,
    amount: '$3999',
  },
]);

// slider
// 定義一個引用來獲取 slider 的 DOM 元素
const sliderRef = ref(null);
// 調整滾動倍率，1 表示原始滾動距離，1.5 表示增加 50% 距離
const scrollMultiplier = 2.5;
// 監聽 wheel 事件，並將垂直滾輪轉換為水平滾動
const handleWheel = (event) => {
  // 防止垂直滾動
  event.preventDefault();
  // 根據滾輪垂直滾動的距離來更新 scrollLeft
  if (sliderRef.value) {
    sliderRef.value.scrollLeft += event.deltaY * scrollMultiplier;
  }
};

// 續約
const menus = {
  year: {
    placeHolder: '年份',
    options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
      id: i,
      name: `${2025 - i} 年`,
    })),
  },
  month: {
    placeHolder: '月份',
    options: Array.from({ length: 12 }, (_, i) => ({
      id: i + 1,
      name: `${i + 1} 月`,
    })),
  },
  day: {
    placeHolder: '日期',
    options: Array.from({ length: 31 }, (_, i) => ({
      id: i + 1,
      name: `${i + 1} 日`,
    })),
  },
  country: {
    placeHolder: '送貨地點',
    options: [
      { id: 0, name: '台灣' },
      { id: 1, name: '香港' },
      { id: 2, name: '澳門' },
    ],
  },
  shipPlace: {
    placeHolder: '送貨地點',
    options: [
      { id: 0, name: '台灣' },
      { id: 1, name: '香港' },
      { id: 2, name: '澳門' },
    ],
  },
  payment: {
    placeHolder: '送貨地點',
    options: [
      { id: 0, name: '台灣' },
      { id: 1, name: '香港' },
      { id: 2, name: '澳門' },
    ],
  },
  visaYear: {
      placeHolder: '年份',
      options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
        id: i,
        name: `${2025 - i} 年`,
      })),
    },
  visaMonth: {
      placeHolder: '月份',
      options: Array.from({ length: 12 }, (_, i) => ({
        id: i + 1,
        name: `${i + 1} 月`,
      })),
    },
};

/*const subHistory ={
  [
    { id:0, ind: 1, petName: '小白', plan: '銀卡(三個月)', date: '2024/01/15' , total: '$'+1299 },
  ],
};

lightbox
const lightTitle8 = { title: "" , isLightBox : ref(false) };
*/

// LightBox
const lightTitle_resub = { title: "續約" , isLightBox : ref(false) };
const lightTitle_userPolicy = {title: "使用者政策", isLightBox: ref(false)};
const lightTitle_privacy = {title: "隱私權政策", isLightBox: ref(false)};


// 控制lightbox狀態
 // 續約
function toggleLightBox_resub() {
  lightTitle_resub.isLightBox.value = !lightTitle_resub.isLightBox.value;
  if(lightTitle_resub.isLightBox.value){
    document.body.classList.add('clicked');
  }else{
    document.body.classList.remove('clicked');
  }
};
 // 使用者政策
 function toggleLightBox_userP() {
  lightTitle_userPolicy.isLightBox.value = !lightTitle_userPolicy.isLightBox.value;
  if (lightTitle_userPolicy.isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
};
 // 隱私權政策
 function toggleLightBox_privacy() {
  lightTitle_privacy.isLightBox.value = !lightTitle_privacy.isLightBox.value;
  if (lightTitle_privacy.isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
};

</script>