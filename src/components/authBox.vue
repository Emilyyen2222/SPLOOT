<template>

<div v-if="authBoxStore.isAuthBox" class="authPosition" :class="{clicked:authBoxStore.isAuthBox}">
    <div class="authWrapper">
        <!-- 左半邊 -->
        <div class="mainLeft">
            <div class="closeBtnBox">
                <div class="closeBtn" @click="authBoxStore.toggleAuthBox">
                    <img src="@/assets/img/icon/close.svg" alt="closeIcon">
                </div>
            </div>
            <div class="topSection">
                <div class="topText" v-if="authBoxStore.authType === 'signUp'">
                    <p class="smallText">已有帳號？</p>
                    <p class="smallText underline" @click="authBoxStore.toggleAuthType">登入</p>
                </div>
                <div class="topText" v-if="authBoxStore.authType === 'login'">
                    <p class="smallText">還沒有帳號？</p>
                    <p class="smallText underline" @click="authBoxStore.toggleAuthType">快速註冊</p>
                </div>
            </div>
            
            <div class="mainSection">

                <div class="selectView">
                    
                    <!-- 註冊模式 -->
                    <div class="theView" v-if="authBoxStore.authType === 'signUp'">
                        <h4 class="bold">註冊</h4>
                        <div class="inputSetBox">
                            <InputText
                                placeHolder="輸入信箱"
                                :errorMsg="authBoxStore.signUpEmail.errorMsg"
                                v-model="authBoxStore.signUpEmail.inputMsg"
                                :hasError="authBoxStore.signUpEmail.hasError"
                                size="small">
                            </InputText>
                        </div>
                        <div class="inputSetBox">
                            <InputText
                                textType="password"
                                ref="password1"
                                class="password1"
                                placeHolder="密碼"
                                :errorMsg="authBoxStore.signUpPassword.errorMsg"
                                v-model="authBoxStore.signUpPassword.inputMsg"
                                :hasError="authBoxStore.signUpPassword.hasError"
                                size="small">
                            </InputText>
                            <img class="theEye" :src="authBoxStore.eyeState1" alt="" @click="authBoxStore.eyeStateToggle1()">
                        </div>
                        <div class="inputSetBox">
                            <InputText
                                textType="password"
                                ref="password2"
                                class="password2"
                                placeHolder="再次輸入密碼"
                                :errorMsg="authBoxStore.signUpPasswordCheck.errorMsg"
                                v-model="authBoxStore.signUpPasswordCheck.inputMsg"
                                :hasError="authBoxStore.signUpPasswordCheck.hasError"
                                size="small">
                            </InputText>
                            <img class="theEye" :src="authBoxStore.eyeState2" alt="" @click="authBoxStore.eyeStateToggle2()">
                        </div>

                        <div class="checkBox"
                        :class="{'-error': authBoxStore.signUpAgreeCheck.hasError}">
                            <input type="checkbox" id="agree" v-model="authBoxStore.signUpAgreeCheck.checkValue">
                            <label class="xsText" for="agree">我已閱讀並同意 <span class="termsAgreement underline" @click="authBoxStore.togglePolicy">網站服務條款</span> 及 <span class="agreementSection underline" @click="authBoxStore.togglePrivacy">隱私權政策</span></label>
                        </div>
                    </div>

                    <!-- 登入模式 -->
                    <div class="theView" v-if="authBoxStore.authType === 'login'">
                        <h4 class="bold">登入</h4>
                        <div class="inputSetBox">
                            <InputText
                                placeHolder="輸入信箱"
                                :errorMsg="authBoxStore.loginEmail.errorMsg"
                                v-model="authBoxStore.loginEmail.inputMsg"
                                :hasError="authBoxStore.loginEmail.hasError"
                                size="small">
                            </InputText>
                        </div>
                        <div class="inputSetBox">
                            <InputText
                                textType="password"
                                ref="password3"
                                class="password3"
                                placeHolder="密碼"
                                :errorMsg="authBoxStore.loginPassword.errorMsg"
                                v-model="authBoxStore.loginPassword.inputMsg"
                                :hasError="authBoxStore.loginPassword.hasError"
                                size="small">
                            </InputText>
                            <img class="theEye" :src="authBoxStore.eyeState3" alt="" @click="authBoxStore.eyeStateToggle3()">
                        </div>
                        <div class="forgotPassword">
                            <p class=" smallText underline">忘記密碼？</p>
                        </div>


                    </div>

                    <!-- 下半部不需隨模式更動 -->
                    <div class="buttomBtn">
                        <div class="captchaCheck"
                        :class="{'-error': authBoxStore.robotCheck.hasError}">
                            <div class="robotCheckBox">
                                <input id="robotCheck" type="checkbox" v-model="authBoxStore.robotCheck.checkValue">
                                <label for="robotCheck">我不是機器人</label>
                            </div>
                            <img class="captcha authIcon" src="../assets/img/icon/login/reCAPTCHA.svg" alt="">
                        </div>
                        <p v-if="authBoxStore.signUpAgreeCheck.hasError && authBoxStore.authType == 'signUp'" class="text-red xsText">請同意服務條款及政策</p>
                        <p v-if="authBoxStore.robotCheck.hasError" class="text-red xsText">請勾選我不是機器人</p>
                        <!-- 根據模式改按鈕內容 -->
                        <btn btnStyle="primary small" v-if="authBoxStore.authType === 'signUp'" @click="authBoxStore.signUpPhp">註冊</btn>
                        <btn btnStyle="primary small" v-if="authBoxStore.authType === 'login'" @click="authBoxStore.loginPhp">登入</btn>
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
                <div class="closeBtnBox">
                    <div class="closeBtn" @click="authBoxStore.toggleAuthBox">
                        <img src="@/assets/img/icon/close.svg" alt="closeIcon">
                    </div>
                </div>
                <div class="heroImgBox">
                    <img class="authMainImg" src="../assets/img/splootbox/cat3.jpg" alt="">
                </div>
        </div>
        
    </div>
</div>

    <!-- 網站服務條款 -->
    <Policy
        :is-light-box="authBoxStore.isLightBoxPolicy" 
        :title="titlePolicy"
        @toggle="authBoxStore.togglePolicy"
        policies="policyInfo"
    ></Policy>
    <!-- 隱私權政策 -->
    <Policy
        :is-light-box="authBoxStore.isLightBoxPrivacy" 
        :title="titlePrivacy"
        @toggle="authBoxStore.togglePrivacy"
        policies="privacyInfo"
    ></Policy>


<div class="authBlackCover" :class="{authClicked:authBoxStore.isAuthBox}" @click="authBoxStore.toggleAuthBox"></div>

</template>

<script setup>
    import { ref,onMounted } from 'vue';
    import { useAuthStores } from '@/stores/AuthBoxStores.js';  // 導入 Pinia Store

    import InputText from '@/components/InputText.vue';
    import Btn from '@/components/Btn.vue';
    import Policy from '../components/Policy.vue'; 

    const authBoxStore = useAuthStores();

    const emit = defineEmits(['update:authType', 'toggle']);


    const titlePolicy = ref("網站服務條款");
    const titlePrivacy = ref("隱私權政策");

    function toggleAuthBox(){
        authBoxStore.toggleAuthBox();
    }

    //抓取input type 改成password
    // onMounted(() => {
    //     const passwordInput1 = document.querySelector(".password1 input");
    //     passwordInput1.type = 'password';
    //     const passwordInput2 = document.querySelector(".password2 input");
    //     passwordInput2.type = 'password';
    //     const passwordInput3 = document.querySelector(".password3 input");
    //     passwordInput3.type = 'password';
    // });
</script>
