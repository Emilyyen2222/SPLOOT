
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
          <p>目前有 {{ cardCount }} 個訂閱</p>
        </div>
      
        <div class="divider"></div>
      
        <div 
          class="sr-slider"
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
            <div class="sh-h-items" 
             v-for=" subHistory in subHistories " 
             :key="subHistory.id">
            <!-- <div class="sh-h-items"> -->
              <p class="tb_index">{{ '0'+ subHistory.shId }}</p>
              <p class="tb_petName">{{ subHistory.petName }}</p>
              <p class="tb_plan">{{ subHistory.plan }}</p>
              <p class="tb_date">{{ subHistory.date }}</p>
              <p class="tb_total">{{ '$' + subHistory.total }}</p>
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
                        <p>SPLOOT BOX
                            <!-- {{ periodName.three }}方案 - {{ subSelected }}
                            ({{ planName }})</p> -->
                            {{ plan.twelve }}方案 - {{ cardLevel.gold }}
                            ({{ metal.gold }})</p>
                        <p>{{ "$" + total.money }}</p>
                    </div>
                    <div class="boxDivider"></div>
                    <div class="textBox">
                        <p>月費</p>
                        <p>{{ "$" + monthly.money }}</p>

                    </div>
                    <div class="boxDivider"></div>
                    <div class="textBox">
                        <p>今日應付金額</p>
                        <p>{{ "$" + monthly.money }}</p>
                    </div>
                </div>
                <div class="infoBox">
                    <div class="xsText left">信用卡付款</div>
                    <InputText size="small" placeHolder="卡號" errorMsg="請輸入信用卡資訊" v-model="formattedCardNumber"
                        :hasError="creditCardError" @input="formatCardNumber">
                    </InputText>
                    <InputText size="small" placeHolder="持卡人姓名" errorMsg="請輸入持卡人姓名" v-model="holderName"
                        :hasError="holderNameError">
                    </InputText>
                    <div class="cardInfo">
                        <div class="info dropdownMenu">
                            <DropdownMenu class="dropDown" :placeHolder="menus.visaYear.placeHolder"
                                :options="menus.visaYear.options" v-model="expireYear">
                            </DropdownMenu>
                        </div>
                        <div class="info dropdownMenu">
                            <DropdownMenu class="dropDown" :placeHolder="menus.visaMonth.placeHolder"
                                :options="menus.visaMonth.options" v-model="expireMonth">
                            </DropdownMenu>
                        </div>
                        <div class="info">
                            <InputText size="small" placeHolder="安全碼" errorMsg="請輸入3~4位安全碼" v-model="cvc"
                                :hasError="cvvError" @input="validateCVV">
                            </InputText>
                        </div>
                    </div>
                </div>
                <p v-if="formHasError" class="xsText text-red textCenter">請填寫信用卡資訊</p>
            </div>
            <ul class="planItems">
                <li class="xsText">SHOPLINE將會使用本次交易資訊作為後續定期扣款，點擊提交即同意 《SHOPLINE Payments 支付服務條款》及《SHOPLINE Payments
                    隱私權政策》。
                </li>
                <li class="xsText">本金流服務由 SHOPLINE Payments 提供，通過 PCI-DSS 國際信用卡組織最高等級認證，提供安全的交易服務，支援國內外信用卡刷卡。</li>
            </ul>

            <li class="checkBox">
                <div class="boxAlign">
                    <input type="checkbox" v-model="q9Checkbox">
                    <p class="xsText">
                        我同意
                        <span class="xsText link" href="" @click="togglePolicy">網站服務條款</span> 及
                        <span class="xsText link" href="" @click="togglePrivacy">隱私權政策</span>
                    </p>
                    <br>
                    <p v-if="policyHasError" class="xsText text-red textCenter">*請勾選我同意</p>
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

            <Btn btnType="form" btnStyle="nextQ"
                @click="nextQuestion(cardNumber != '' && holderName != '' && expireYear != '' && expireMonth != '' && cvc != '' && q9Checkbox)">
                繼續訂閱SPLOOT BOX</Btn>            
        </div>
      </div>    
    </LightBox>
    
    <!-- 網站服務條款 -->
    <Policy :is-light-box="isLightBoxPolicy" :title="titlePolicy" @toggle="togglePolicy" policies="policyInfo"></Policy>
    <!-- 隱私權政策 -->
    <Policy :is-light-box="isLightBoxPrivacy" :title="titlePrivacy" @toggle="togglePrivacy" policies="privacyInfo">
    </Policy>
  
    <!-- circle bg -->
    <div class="member-circle"></div>
  
  </main>
  
  
  </template>
  
  <script setup>
  
  import { computed, ref } from 'vue';
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
  
   // 計算卡片數量
  const cardCount = computed(() => cards.value.length);

  // 歷史紀錄，subHistory
  const subHistories = ref([
    {shId:1, petName : '小白', plan: "銀卡(三個月)", date:'2024/01/15', total:'300' },
    {shId:2, petName : '大黑', plan: "金卡(十二個月)", date:'2018/01/15', total:'1200' },
    {shId:3, petName : '大黑', plan: "金卡(十二個月)", date:'2018/01/15', total:'1200' },
    {shId:4, petName : '大黑', plan: "金卡(十二個月)", date:'2018/01/15', total:'1200' },
    {shId:5, petName : '大黑', plan: "金卡(十二個月)", date:'2018/01/15', total:'1200' },
  ]);


  // slider
  // 定義一個引用來獲取 slider 的 DOM 元素
  const sliderRef = ref(null);
  // 調整滾動倍率，1 表示原始滾動距離(1.5 表示增加 50% 距離)  
  const scrollMultiplier = 35;
  // 監聽 wheel 事件，並將垂直滾輪轉換為水平滾動
  const handleWheel = (event) => {
    // 防止垂直滾動
    event.preventDefault();
    // 根據滾輪垂直滾動的距離來更新 scrollLeft
    if (sliderRef.value) {
      sliderRef.value.scrollLeft += event.deltaY * scrollMultiplier;
    }
  };
  
  // 續約(Emily)
    // 假資料(Hao)
    const plan = ref({twelve:"十二個月"});
    const cardLevel = ref({gold:"金卡"});
    const metal = ref({gold:"gold"});
    const total = ref({money:1919});
    const monthly = ref({money:749});

  const subSelected = ref({
    
  });
  const planSelected = ref("");
  const planName = {
      // s:"Sliver",
      "銀卡": "Silver",
      // "金卡": "Gold",
      // "白金卡": "Platinum"
  };
  const periodName = {
      three: "三個月",
      // "單次體驗": "單次體驗",
      // "3個月": "三個月",
      // "6個月": "六個月",
      // "12個月": "十二個月"
  };
  const monthFee = {
      "單次體驗": 1,
      "3個月": 3,
      "6個月": 6,
      "12個月": 12
  }
  // 訂閱週期對應表
  const planOptions = {
      "銀卡": [
          { label: "單次體驗", times: "x1", price: 799 },
          { label: "3個月", times: "x3", price: 2097 },
          { label: "6個月", times: "x6", price: 3774 },
          { label: "12個月", times: "x12", price: 7128 }
      ],
      "金卡": [
          { label: "單次體驗", times: "x1", price: 999 },
          { label: "3個月", times: "x3", price: 2697 },
          { label: "6個月", times: "x6", price: 4854 },
          { label: "12個月", times: "x12", price: 9168 }
      ],
      "白金卡": [
          { label: "單次體驗", times: "x1", price: 1299 },
          { label: "3個月", times: "x3", price: 3597 },
          { label: "6個月", times: "x6", price: 6474 },
          { label: "12個月", times: "x12", price: 12228 }
      ]
  };
  // question 9 信用卡號驗證
  const cardNumber = ref('');
  const formattedCardNumber = ref(''); // 經過格式化的信用卡號（每4位加空格）
  const creditCardError = ref(false);

  const holderName = ref('');
  const expireYear = ref('');
  const expireMonth = ref('');

  //question 9 安全碼驗證
  const cvc = ref('');
  const holderNameError = ref(false);
  const cvvError = ref(false);

  const q9Checkbox = ref(false);
  const policyHasError = ref(false);

  const isLightBoxPolicy = ref(false);
  const isLightBoxPrivacy = ref(false);

  const titlePolicy = ref("網站服務條款");
  const titlePrivacy = ref("隱私權政策");

  const menus = {
      catBreedsMenu: ref({
          placeHolder: '我的貓咪品種是',
          options: [
              { id: 0, name: '美短（美國短毛貓）' },
              { id: 1, name: '英短（英國短毛貓）' },
              { id: 2, name: '緬因貓' },
              { id: 3, name: '布偶貓' },
              { id: 4, name: '波斯貓' },
              { id: 5, name: '金吉拉' },
              { id: 6, name: '曼赤肯（矮腳貓）' },
              { id: 7, name: '無毛貓（斯芬克斯）' },
              { id: 8, name: '加菲貓' },
              { id: 9, name: '孟加拉貓' },
              { id: 10, name: '暹羅貓' },
              { id: 11, name: '折耳貓（蘇格蘭折耳貓）' },
              { id: 12, name: '俄羅斯藍貓' },
              { id: 13, name: '橘貓（米克斯）' },
              { id: 14, name: '三花貓（米克斯）' },
              { id: 15, name: '狸花貓（米克斯）' },
              { id: 16, name: '挪威森林貓' },
              { id: 17, name: '土耳其梵貓' },
              { id: 18, name: '土耳其安哥拉貓' },
              { id: 19, name: '埃及貓' },
              { id: 20, name: '喜馬拉雅貓' },
              { id: 21, name: '新加坡貓' },
              { id: 22, name: '美國捲耳貓' },
              { id: 23, name: '索馬利貓' },
              { id: 24, name: '巴厘貓' },
              { id: 25, name: '東方短毛貓' },
              { id: 26, name: '科拉特貓' },
              { id: 27, name: '塞爾凱克捲毛貓' },
              { id: 28, name: '德文捲毛貓' },
              { id: 29, name: '柯尼斯捲毛貓' },
              { id: 30, name: '日本短尾貓' },
          ],
          menuValue: '',
      }),
      dogBreedsMenu: ref({
          placeHolder: '我的狗狗品種是',
          options: [
              { id: 0, name: '柴犬' },
              { id: 1, name: '拉布拉多' },
              { id: 2, name: '哈士奇' },
              { id: 3, name: '黃金獵犬' },
              { id: 4, name: '德國牧羊犬' },
              { id: 5, name: '法國鬥牛犬' },
              { id: 6, name: '貴賓犬（泰迪）' },
              { id: 7, name: '臘腸犬' },
              { id: 8, name: '比熊犬' },
              { id: 9, name: '邊境牧羊犬' },
              { id: 10, name: '雪納瑞' },
              { id: 11, name: '西施犬' },
              { id: 12, name: '約克夏' },
              { id: 13, name: '柯基犬' },
              { id: 14, name: '馬爾濟斯' },
              { id: 15, name: '秋田犬' },
              { id: 16, name: '松獅犬' },
              { id: 17, name: '沙皮狗' },
              { id: 18, name: '牛頭梗' },
              { id: 19, name: '羅威納犬' },
              { id: 20, name: '大丹犬' },
              { id: 21, name: '杜賓犬' },
              { id: 22, name: '博美犬' },
              { id: 23, name: '喜樂蒂牧羊犬' },
              { id: 24, name: '阿拉斯加雪橇犬' },
              { id: 25, name: '巴哥犬' },
              { id: 26, name: '狐狸犬' },
              { id: 27, name: '愛斯基摩犬' },
              { id: 28, name: '大白熊犬' },
              { id: 29, name: '巴吉度犬' },
              { id: 30, name: '比格犬' },
          ],
          menuValue: '',
      }),
      year: {
          placeHolder: '年份',
          options: Array.from({ length: 2025 - 2005 + 1 }, (_, i) => ({
              id: i,
              name: `${2025 - i} 年`,
          })),
          menuValue: ref(''),
      },
      month: {
          placeHolder: '月份',
          options: Array.from({ length: 12 }, (_, i) => ({
              id: i + 1,
              name: `${i + 1} 月`,
          })),
          menuValue: ref(''),
      },
      day: {
          placeHolder: '日期',
          options: Array.from({ length: 31 }, (_, i) => ({
              id: i + 1,
              name: `${i + 1} 日`,
          })),
          menuValue: ref(''),
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

  // const selectedPrice = computed(() => {
  //     const selectedPlanObj = planOptions[subSelected.value].find(
  //         (p) => p.label == planSelected.value
  //     );
  //     return selectedPlanObj.price
  // });

  // const monthlyPrice = computed(() => {
  //     const months = monthFee[planSelected.value] || 1;
  //     return selectedPrice.value / months;
  // });

  const formatCardNumber = () => {
      // 移除所有非數字字符
      let numbersOnly = formattedCardNumber.value.replace(/\D/g, '');

      // 限制最大長度為16 
      numbersOnly = numbersOnly.slice(0, 16);

      // 每4位加一個空格
      formattedCardNumber.value = numbersOnly.replace(/(\d{4})/g, '$1 ').trim();

      // 更新原始卡號（去掉空格）
      cardNumber.value = numbersOnly;
  };
  const validateCVV = () => {
      // 只允許輸入數字
      cvc.value = cvc.value.replace(/\D/g, '');

      // 限制最多 4 位數
      if (cvc.value.length > 4) {
          cvc.value = cvc.value.slice(0, 4);
      }
  };
  function nextQuestion(bol = false) {
    formHasError.value = false;
    petName.value.hasError = petName.value.inputMsg == '';

    if (bol && question.value == 4) {
        sessionStorage.setItem('question', 5);
        sessionStorage.setItem('petName', petName.value.inputMsg);
        sessionStorage.setItem('questionPetSelected', questionPet.value.selected[0]);
        if (questionDog.value.selected[0]) sessionStorage.setItem('dogSizeSelected', questionDog.value.selected[0]);
        if (questionCat.value.selected[0]) sessionStorage.setItem('catSizeSelected', questionCat.value.selected[0]);
        sessionStorage.setItem('dogBreedSelected', menus.dogBreedsMenu.value.menuValue ? menus.dogBreedsMenu.value.menuValue : '');
        sessionStorage.setItem('catBreedSelected', menus.catBreedsMenu.value.menuValue ? menus.catBreedsMenu.value.menuValue : '');
        sessionStorage.setItem('birthYear', birth.value.year);
        sessionStorage.setItem('birttMonth', birth.value.month);
        sessionStorage.setItem('birthDay', birth.value.day);
    }
    if (bol && question.value == 9) subscribeSplootBoxPhp();

    if (bol == true) {
        console.log('question.value++');
    } else {
        switch (question.value) {
            case 1:
                formHasError.value = questionPet.value.selected.length == 0;
                return;
            case 2:
                formHasError.value = petSize.value.selected.length == 0;
                return;
            case 3:
                formHasError.value = petBreed.value.menuValue == '';
                return;
            case 6:
                formHasError.value = subSelected.value == '';
                return;
            case 7:
                formHasError.value = planSelected.value == '';
                return;
            case 8:
                formHasError.value = selectedCity.value == '' || selectedDistrict.value == '' || deliverStreet.value == '';
                return;
            case 9:
                policyHasError.value = !q9Checkbox.value;
                formHasError.value = formattedCardNumber.value == ''
                    || holderName.value == '' || expireYear.value == '' || expireMonth.value == '' || cvc.value == '';
                return;

        }
    }
}
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
  function togglePolicy() {
    isLightBoxPolicy.value = !isLightBoxPolicy.value;
    updateBodyClass();
  }

  function togglePrivacy() {
      isLightBoxPrivacy.value = !isLightBoxPrivacy.value;
      updateBodyClass();
  }

  function updateBodyClass() {
      if (isLightBoxPolicy.value || isLightBoxPrivacy.value) {
          document.body.classList.add('clicked');
      } else {
          document.body.classList.remove('clicked');
      }
  }
  
  </script>