<template>

<div class="authPosition" :class="{clicked:isAuthBox}">
    <div class="authWrapper">
        <!-- 左半邊 -->
        <div class="mainLeft">

            <div class="topSection">
                <div class="topText" v-show="props.authType === 'signUp'">
                    <p class="smallText">已有帳號？</p>
                    <p class="smallText underline">登入</p>
                </div>
                <div class="topText" v-show="props.authType === 'login'">
                    <p class="smallText">還沒有帳號？</p>
                    <p class="smallText underline">快速註冊</p>
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
                            <label class="xsText" for="agree">我已閱讀並同意 <span class="termsAgreement underline">網站服務條款</span> 及 <span class="agreementSection underline">隱私權政策</span></label>
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

<div class="popBlackCover" :class="{clicked:isAuthBox}" @click="toggleAuthBox"></div>

</template>

<script setup>
    import { ref, watch, onMounted, defineProps, defineEmits } from 'vue';

    import InputText from '@/components/InputText.vue';
    import Btn from '@/components/Btn.vue';

const props = defineProps({
    authType:{
        type: String,
        required: true,
    },
    isAuthBox: {
        type: Boolean,
        required: true,
    },
})

const emit = defineEmits(['toggle']);

function toggleAuthBox(){
    emit('toggle');
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


</script>
