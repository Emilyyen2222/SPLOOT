<template>

<div class="authPosition" :class="{clicked:isAuthBox}">
    <div class="authWrapper">
        <!-- 左半邊 -->
        <div class="mainLeft">

            <div class="topSection">
                <div class="topText" v-show="props.authType === 'signUp'">
                    <p class="smallText">已有帳號？</p>
                    <p class="smallText underline" @click="toggleAuthType">登入</p>
                </div>
                <div class="topText" v-show="props.authType === 'login'">
                    <p class="smallText">還沒有帳號？</p>
                    <p class="smallText underline" @click="toggleAuthType">快速註冊</p>
                </div>
            </div>
            
            <div class="mainSection">

                <div class="selectView">
                    
                    <!-- 註冊模式 -->
                    <div class="theView" v-show="props.authType === 'signUp'">
                        <h4 class="bold">註冊</h4>
                        <InputText
                            placeHolder="輸入信箱"
                            errorMsg="Invalid Input"
                            v-model="inputValueMail"
                            :hasError="inputErrorMail"
                            textAlign = "textLeft"
                            size="small">
                        </InputText>
                        <!-- <p>用 v-model 監聽: {{ inputValueMail }}</p> -->
                            <div class="passwordBox">
                                <InputText
                                    ref="password1"
                                    class="password1"
                                    placeHolder="密碼"
                                    errorMsg="Invalid Input"
                                    v-model="inputValuePassword"
                                    :hasError="inputErrorPassword"
                                    textAlign = "textLeft"
                                    size="small">
                                </InputText>
                                <img class="theEye" :src="eyeState1" alt="" @click="eyeStateToggle1">
                                <!-- <p>用 v-model 監聽: {{ inputValuePassword }}</p> -->
                            </div>
                            <div class="passwordBox">
                                <InputText
                                    ref="password2"
                                    class="password2"
                                    placeHolder="再次輸入密碼"
                                    errorMsg="Invalid Input"
                                    v-model="inputValuePassword2"
                                    :hasError="inputErrorPassword2"
                                    textAlign = "textLeft"
                                    size="small">
                                </InputText>
                                <img class="theEye" :src="eyeState2" alt="" @click="eyeStateToggle2">
                                <!-- <p>用 v-model 監聽: {{ inputValuePassword2 }}</p> -->
                            </div>
                        <div class="checkBox">
                            <input type="checkbox" id="agree">
                            <label class="xsText" for="agree">我已閱讀並同意 <span class="termsAgreement underline" @click="togglePopUp">網站服務條款</span> 及 <span class="agreementSection underline" @click="togglePopUp">隱私權政策</span></label>
                        </div>
                    </div>

                    <!-- 登入模式 -->
                    <div class="theView" v-show="props.authType === 'login'">
                        <h4 class="bold">登入</h4>
                        <InputText
                            placeHolder="輸入信箱"
                            errorMsg="Invalid Input"
                            v-model="inputValueMail"
                            :hasError="inputErrorMail"
                            textAlign = "textLeft"
                            size="small">
                        </InputText>
                        <!-- <p>用 v-model 監聽: {{ inputValueMail }}</p> -->
                        <div class="passwordBox">
                            <InputText
                                ref="password3"
                                class="password3"
                                placeHolder="密碼"
                                errorMsg="Invalid Input"
                                v-model="inputValuePassword"
                                :hasError="inputErrorPassword"
                                textAlign = "textLeft"
                                size="small">
                            </InputText>
                            <img class="theEye" :src="eyeState3" alt="" @click="eyeStateToggle3">
                            <!-- <p>用 v-model 監聽: {{ inputValuePassword }}</p> -->
                        </div>
                        <div class="forgotPassword">
                            <p class=" smallText underline">忘記密碼？</p>
                        </div>


                    </div>

                    <!-- 下半部不需隨模式更動 -->
                    <div class="buttomBtn">
                        <div class="captchaCheck">
                            <div class="robotCheckBox">
                                <input id="robotCheck" type="checkbox">
                                <label for="robotCheck">我不是機器人</label>
                            </div>
                            <img class="captcha authIcon" src="../assets/img/icon/login/reCAPTCHA.svg" alt="">
                        </div>
                        <!-- 根據模式改按鈕內容 -->
                        <btn btnStyle="primary small" v-show="props.authType === 'signUp'">註冊</btn>
                        <btn btnStyle="primary small" v-show="props.authType === 'login'">登入</btn>
                        <!-- 分隔線 -->
                        <div class="dividerBox">
                            <div class="divider left"></div>
                            <p class="smallText">or</p>
                            <div class="divider right"></div>
                        </div>
                        <div class="gmail quickWay">
                            <img class="google authIcon" src="../assets/img/icon/login/google.svg" alt="">
                            <div class="quickBox">
                                <p class="smallText">Gmail</p>
                            </div>
                        </div>
                        <div class="line quickWay">
                            <img class="Line authIcon" src="../assets/img/icon/login/line.svg" alt="">
                            <div class="quickBox">                        
                                <p class="smallText">Line</p>
                            </div>
                        </div>

                    </div>

                </div>
                
            </div>
            
        </div>

    <!-- 右半邊 -->

        <div class="mainRight">
            <img class="authMainImg" src="../assets/img/splootbox/cat3.jpg" alt="">
        </div>
        
    </div>
</div>

<!-- 隱私權政策 服務條款 -->
<PopUp :is-pop-up="isPopUp">
    <div class="policy">
        <h6>隱私權政策</h6>
        <p>在您開始使用 SPLOOT布魯家 所經營之網站之前，請詳細閱讀以下所有服務條款：
        當您成為 SPLOOT布魯家 網站的會員時，即表示您已詳細閱讀、明確瞭解並同意接受本服務條款之所有內容。
        若您不同意所列之服務條款，則請您立即離開此網站或者不使用任何網站之任何服務提供。
        帳號當您向我們註冊新帳號時，請務必確保您所提供的資料皆是最準確、完整並且時常保持更新狀態。違反所列之條款者，將有可能導致被立即停止您的帳號以及網站所提供的所有服務。此外，在使用任何服務以及活動上，您有義務責任確保您的密碼安全、無論該密碼是透過使用我們服務而管理或者第三方服務。您必須立即通知我們，一旦您的密碼被盜用或者處於不安全狀態。
        連結到其他網站我們的服務可能含有部份連結，將連結到第三方網站或者服務。該些服務將不會處於我們的控制、操作以及擁有管轄權限的範圍內，所以本網站沒有承擔任何內容、隱私政策或者任何第三方網站所提供的服務之義務責任。您同意本網站不需要承擔任何責任、因使用該第三方網站所提供之內容、服務與商品而所導致的；直接或者間接性損失與破壞。我們強烈建議您必須詳細閱讀清楚有關您所造訪的第三方網站之服務條款以及隱私政策，以確保您自身的權益。
        終止服務在不需要任何事前通知以下，我們有可能隨時終止您使用我們網站服務的權限；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。在不需要任何事前通知以下，我們有可能隨時終止您所持有的登入帳號；以上終止服務決定並不需要任何理由即可即時生效，包括但不限於您違反本服務條款。一旦確定終止，您將會立即無法繼續使用所有服務。若您希望終止您的帳號，您可以隨時終止服務。終止服務適用於所有條款的規定，包括但不限於所有權規定、擔保聲明、賠款以及有限責任。
        政府法律以上所有條款將會會遵從（國家之法律）無論是否其條款衝突於法律服務條款。若我們未擁有執行以上條款之部份權益，並不等同於我們放棄所有條款的執行權益。若有以上有部份條款不適用於所指定之法庭，其其他之所有條款依然有效。以上所有條款達致雙方在服務使用上的一致性同意與協議，任何事前的協議將有可能影響雙方對於以上所有服務條款的取代或者更改。
        我們保留所有條款的更改、取代之權益，並所做出更改、取代之內容可自行決定。若有任何的更改涉及任何內容，我們將會嘗試提供最少30天的事前通知；該通知將會在新條款正式起效之前公布。至於任何內容的制定則由我們自行決定。若您欲繼續使用網站服務，請務必同意所有新條款；若您不同意新條款，將會要求停止使用網站所有服務。
        若您有任何問題與疑慮，煩請與 SPLOOT布魯家 進行聯繫。</p>
        <h6>隱私權政策</h6>
        <p>歡迎您使用 SPLOOT布魯家（以下簡稱「本公司」）係依據本服務條款提供 SPLOOT布魯家 (http://www.sploot.co) 服務（以下簡稱「本服務」），為了讓您能夠安心的使用本網站的各項服務與資訊，特此向您說明本網站的隱私權保護政策，以保障您的權益，請您詳閱下列內容：
        一、隱私權保護政策的適用範圍
        隱私權保護政策內容，包括本網站如何處理您在使用網站服務時收集到的個人識別資料。隱私權保護政策不適用於其他相關連結的網站，也不適用於非本網站所委託或參與管理的人員。
        二、個人資料的蒐集、處理及利用方式
        當您造訪本網站或使用本網站所提供之功能服務時，我們將視該服務功能性別，請您提供必要的個人資料，並於特定目的範圍內處理及使用您的個人資料；未經您的書面同意，將不會將個人資料用於其他用途。
        本網站在您使用服務信箱、填寫問卷、參加活動時，會保存您所提供的姓名、電子郵件信箱、聯絡方式及使用時間等。
        於一般瀏覽時，伺服器會自行記錄相關行為，包括您使用連線設備之IP位址、使用時間、瀏覽器及點擊紀錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公開。
        三、資料之保護
        本網站主機均設有防火牆、反病毒系統及其他相關的資訊安全設備及必要的安全防護措施，對於本網站及您的個人資料加以嚴格保護。
        未經授權之人員不得接觸您的個人資料，且所有接觸之人員均經簽署保密契約，違反保密義務者將受到相關法律處分。</p>
        <Btn @click="togglePopUp" class="padding" btnType="form" btnStyle="nextQ">同意</Btn>
    </div>
</PopUp>

<div class="authBlackCover" :class="{authClicked:isAuthBox}" @click="toggleAuthBox"></div>

</template>

<script setup>
    import { ref, watch, onMounted, defineProps, defineEmits } from 'vue';

    import InputText from '@/components/InputText.vue';
    import Btn from '@/components/Btn.vue';
    import PopUp from "../components/PopUp.vue";

const props = defineProps({
    authType:{
        type: String,
        required: true,
    },
    isAuthBox: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(['update:authType', 'toggle']);

function toggleAuthBox(){
    emit('toggle');
}

//註冊登入切換
function toggleAuthType() {
    const newAuthType = props.authType === 'login' ? 'signUp' : 'login';
    emit('update:authType', newAuthType); // 通知父層更新 authType
}


//密碼顯示

//眼睛/
import openedEye from '@/assets/img/icon/login/openedEye.svg' 
import closedEye from '@/assets/img/icon/login/closedEye.svg' 

let eyeState1 = ref(closedEye);
let eyeState2 = ref(closedEye);
let eyeState3 = ref(closedEye);

//抓取input type 改成password
onMounted(() => {
    const passwordInput1 = document.querySelector(".password1 input");
        passwordInput1.type = 'password';
    const passwordInput2 = document.querySelector(".password2 input");
        passwordInput2.type = 'password';
    const passwordInput3 = document.querySelector(".password3 input");
        passwordInput3.type = 'password';
});

function eyeStateToggle1() {
    const passwordInput1 = document.querySelector(".password1 input");
    passwordInput1.type = passwordInput1.type == 'password' ? 'text' : 'password';
    eyeState1.value = eyeState1.value == closedEye ? eyeState1.value = openedEye : eyeState1.value = closedEye;
};
function eyeStateToggle2() {
    const passwordInput2 = document.querySelector(".password2 input");
    passwordInput2.type = passwordInput2.type == 'password' ? 'text' : 'password';
    eyeState2.value = eyeState2.value == closedEye ? eyeState2.value = openedEye : eyeState2.value = closedEye;
};
function eyeStateToggle3() {
    const passwordInput3 = document.querySelector(".password3 input");
    passwordInput3.type = passwordInput3.type == 'password' ? 'text' : 'password';
    eyeState3.value = eyeState3.value == closedEye ? eyeState3.value = openedEye : eyeState3.value = closedEye;
};

//input 監看

//信箱
let inputValueMail = ref('');
let inputErrorMail = ref(false);

watch(inputValueMail, (newValue, oldValue) => {
    if(inputValueMail.value.includes('123')){
        inputErrorMail.value = true;
    }else{
        inputErrorMail.value = false;
    }
})

//密碼
let inputValuePassword = ref('');
let inputErrorPassword = ref(false);

watch(inputValuePassword, (newValue, oldValue) => {
    if(inputValuePassword.value.includes('123')){
        inputErrorPassword.value = true;
    }else{
        inputErrorPassword.value = false;
    }
})

//再次輸入密碼
let inputValuePassword2 = ref('');
let inputErrorPassword2 = ref(false);

watch(inputValuePassword2, (newValue, oldValue) => {
    if(inputValuePassword2.value.includes('123')){
        inputErrorPassword2.value = true;
    }else{
        inputErrorPassword2.value = false;
    }
})

// popup 狀態
let isPopUp = ref(false);

// 控制彈出視窗的顯示與隱藏
function togglePopUp() {
  isPopUp.value = !isPopUp.value;
  // 停止捲軸
  if (isPopUp.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
}
</script>
