<template>

<div class="authPosition" :class="{clicked:isAuthBox}">
    <div class="authWrapper">
        <!-- 左半邊 -->
        <div class="mainLeft">
            <div class="closeBtnBox">
                <div class="closeBtn" @click="toggleAuthBox">
                    <img src="@/assets/img/icon/close.svg" alt="closeIcon">
                </div>
            </div>
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
                        <div class="inputSetBox">
                            <InputText
                                placeHolder="輸入信箱"
                                :errorMsg="signUpEmail.errorMsg"
                                v-model="signUpEmail.inputMsg"
                                :hasError="signUpEmail.hasError"
                                size="small">
                            </InputText>
                        </div>
                        <div class="inputSetBox">
                            <InputText
                                ref="password1"
                                class="password1"
                                placeHolder="密碼"
                                :errorMsg="signUpPassword.errorMsg"
                                v-model="signUpPassword.inputMsg"
                                :hasError="signUpPassword.hasError"
                                size="small">
                            </InputText>
                            <img class="theEye" :src="eyeState1" alt="" @click="eyeStateToggle1()">
                        </div>
                        <div class="inputSetBox">
                            <InputText
                                ref="password2"
                                class="password2"
                                placeHolder="再次輸入密碼"
                                :errorMsg="signUpPasswordCheck.errorMsg"
                                v-model="signUpPasswordCheck.inputMsg"
                                :hasError="signUpPasswordCheck.hasError"
                                size="small">
                            </InputText>
                            <img class="theEye" :src="eyeState2" alt="" @click="eyeStateToggle2()">
                        </div>

                        <div class="checkBox"
                        :class="{'-error': signUpAgreeCheck.hasError}">
                            <input type="checkbox" id="agree" v-model="signUpAgreeCheck.checkValue">
                            <label class="xsText" for="agree">我已閱讀並同意 <span class="termsAgreement underline" @click="togglePolicy">網站服務條款</span> 及 <span class="agreementSection underline" @click="togglePrivacy">隱私權政策</span></label>
                        </div>
                    </div>

                    <!-- 登入模式 -->
                    <div class="theView" v-show="props.authType === 'login'">
                        <h4 class="bold">登入</h4>
                        <div class="inputSetBox">
                            <InputText
                                placeHolder="輸入信箱"
                                :errorMsg="loginEmail.errorMsg"
                                v-model="loginEmail.inputMsg"
                                :hasError="loginEmail.hasError"
                                size="small">
                            </InputText>
                        </div>
                        <div class="inputSetBox">
                            <InputText
                                ref="password3"
                                class="password3"
                                placeHolder="密碼"
                                :errorMsg="loginPassword.errorMsg"
                                v-model="loginPassword.inputMsg"
                                :hasError="loginPassword.hasError"
                                size="small">
                            </InputText>
                            <img class="theEye" :src="eyeState3" alt="" @click="eyeStateToggle3()">
                        </div>
                        <div class="forgotPassword">
                            <p class=" smallText underline">忘記密碼？</p>
                        </div>


                    </div>

                    <!-- 下半部不需隨模式更動 -->
                    <div class="buttomBtn">
                        <div class="captchaCheck"
                        :class="{'-error': robotCheck.hasError}">
                            <div class="robotCheckBox">
                                <input id="robotCheck" type="checkbox" v-model="robotCheck.checkValue">
                                <label for="robotCheck">我不是機器人</label>
                            </div>
                            <img class="captcha authIcon" src="../assets/img/icon/login/reCAPTCHA.svg" alt="">
                        </div>
                        <p v-if="signUpAgreeCheck.hasError && props.authType == 'signUp'" class="text-red xsText">請同意服務條款及政策</p>
                        <p v-if="robotCheck.hasError" class="text-red xsText">請勾選我不是機器人</p>
                        <!-- 根據模式改按鈕內容 -->
                        <btn btnStyle="primary small" v-show="props.authType === 'signUp'" @click="signUpPhp">註冊</btn>
                        <btn btnStyle="primary small" v-show="props.authType === 'login'" @click="loginPhp">登入</btn>
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
                    <div class="closeBtn" @click="toggleAuthBox">
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
        :is-light-box="isLightBoxPolicy" 
        :title="titlePolicy"
        @toggle="togglePolicy"
        policies="policyInfo"
    ></Policy>
    <!-- 隱私權政策 -->
    <Policy
        :is-light-box="isLightBoxPrivacy" 
        :title="titlePrivacy"
        @toggle="togglePrivacy"
        policies="privacyInfo"
    ></Policy>


<div class="authBlackCover" :class="{authClicked:isAuthBox}" @click="toggleAuthBox"></div>

</template>

<script setup>
    import { ref, watch, onMounted } from 'vue';

    import InputText from '@/components/InputText.vue';
    import Btn from '@/components/Btn.vue';
    import Policy from '../components/Policy.vue';  
    
    //眼睛/
    import openedEye from '@/assets/img/icon/login/openedEye.svg';
    import closedEye from '@/assets/img/icon/login/closedEye.svg'; 

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

    //密碼顯示
    const eyeState1 = ref(closedEye);
    const eyeState2 = ref(closedEye);
    const eyeState3 = ref(closedEye);

    const isLightBoxPolicy = ref(false);
    const isLightBoxPrivacy = ref(false);
    const titlePolicy = ref("網站服務條款");
    const titlePrivacy = ref("隱私權政策");

    // popup 狀態
    const isPopUp = ref(false);

    const loginEmail = ref({
        inputMsg: '',
        errorMsg: '',
        hasError: false
    });
    const loginPassword = ref({
        inputMsg: '',
        errorMsg: '',
        hasError: false
    });
    const signUpEmail = ref({
        inputMsg: '',
        errorMsg: '',
        hasError: false
    });
    const signUpPassword = ref({
        inputMsg: '',
        errorMsg: '',
        hasError: false
    });
    const signUpPasswordCheck = ref({
        inputMsg: '',
        errorMsg: '',
        hasError: false
    });

    const signUpAgreeCheck = ref({
        checkValue: false,
        hasError: false
    });

    const robotCheck = ref({
        checkValue: false,
        hasError: false
    });


    function toggleAuthBox(){
        emit('toggle');
    }
    //註冊登入切換
    function toggleAuthType() {
        const newAuthType = props.authType === 'login' ? 'signUp' : 'login';
        emit('update:authType', newAuthType); // 通知父層更新 authType

        robotCheck.value.checkValue = false;
        robotCheck.value.hasError = false;
    }

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

    function isValidEmail(email){
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    };

    function isValidPassword(password) {
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        return passwordPattern.test(password);
    }

    // Policy Component
    function togglePolicy() {
        isLightBoxPolicy.value = !isLightBoxPolicy.value;
        updateBodyClass();
    }
    function togglePrivacy() {
        isLightBoxPrivacy.value = !isLightBoxPrivacy.value;
        updateBodyClass();
    }

    async function loginPhp(){
        loginEmail.value.hasError = false;
        loginPassword.value.hasError = false;
        robotCheck.value.hasError = false;

        if(!isValidEmail(loginEmail.value.inputMsg)){
            loginEmail.value.hasError = true;
            loginEmail.value.errorMsg = '請輸入正確的 email 格式';
            return;
        };
        if(loginPassword.value.inputMsg == ''){
            loginPassword.value.hasError = true;
            loginPassword.value.errorMsg = '請輸入密碼';
            return;
        };
        if(robotCheck.value.checkValue == false){
            robotCheck.value.hasError = true;
            return;
        };

        const resp = await fetch('php/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
            email: loginEmail.value.inputMsg,
            password: loginPassword.value.inputMsg,
            }),
        });

        try {
            const user = await resp.json();
            if (user.status == 'success') {
                window.location.reload();

            } else if(user.message == '密碼錯誤'){
                loginPassword.value.errorMsg = user.message;
                loginPassword.value.hasError = true;
            } else if(user.message == '無此使用者'){
                loginEmail.value.errorMsg = user.message;
                loginEmail.value.hasError = true;
            }
        } catch (error) {
            console.error('Error parsing JSON:', error);
        }
    }
    async function signUpPhp(){
        signUpEmail.value.hasError = false;
        signUpPassword.value.hasError = false;
        signUpPasswordCheck.value.hasError = false;
        signUpAgreeCheck.value.hasError = false;
        robotCheck.value.hasError = false;

        if(!isValidEmail(signUpEmail.value.inputMsg)){
            signUpEmail.value.hasError = true;
            signUpEmail.value.errorMsg = '請輸入正確的 email 格式';
            return;
        };
        if(!isValidPassword(signUpPassword.value.inputMsg)){
            signUpPassword.value.hasError = true;
            signUpPassword.value.errorMsg = '密碼需至少8字元，包含字母和數字';
            return;
        };
        if(signUpPassword.value.inputMsg != signUpPasswordCheck.value.inputMsg){
            signUpPasswordCheck.value.hasError = true;
            signUpPasswordCheck.value.errorMsg = '密碼和確認密碼需相同';
            return;
        };
        if(signUpAgreeCheck.value.checkValue == false || robotCheck.value.checkValue == false){
            if(signUpAgreeCheck.value.checkValue == false){
                signUpAgreeCheck.value.hasError = true;
            }
            if(robotCheck.value.checkValue == false){
                robotCheck.value.hasError = true;
            }
            return;
        };

        const resp = await fetch('php/signup.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: signUpEmail.value.inputMsg,
                password: signUpPassword.value.inputMsg
            })
        });

        try {
            const user = await resp.json();
            if(user.status == 'success'){
                alert('註冊成功！');
                toggleAuthType();
            }else{
                signUpEmail.value.errorMsg = user.message;
                signUpEmail.value.hasError = true;
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        };
    }

    watch(
    () => loginEmail.value.inputMsg, (newValue, oldValue) => {
        if(isValidEmail(loginEmail.value.inputMsg)){
            loginEmail.value.hasError = false;
        }else{
            loginEmail.value.hasError = true;
            loginEmail.value.errorMsg = '請輸入正確的 email 格式';
        }
    });
    watch(
    () => signUpEmail.value.inputMsg, (newValue, oldValue) => {
        if(isValidEmail(signUpEmail.value.inputMsg)){
            signUpEmail.value.hasError = false;
        }else{
            signUpEmail.value.hasError = true;
            signUpEmail.value.errorMsg = '請輸入正確的 email 格式';
        }
    });
    watch(
    () => signUpPassword.value.inputMsg, (newValue, oldValue) => {
        if(isValidPassword(signUpPassword.value.inputMsg)){
            signUpPassword.value.hasError = false;
        }else{
            signUpPassword.value.hasError = true;
            signUpPassword.value.errorMsg = '密碼需至少8字元，包含字母和數字';
        }
    });
    watch(
    () => signUpPasswordCheck.value.inputMsg, (newValue, oldValue) => {
        if(signUpPasswordCheck.value.inputMsg == signUpPassword.value.inputMsg){
            signUpPasswordCheck.value.hasError = false;
        }else{
            signUpPasswordCheck.value.hasError = true;
            signUpPasswordCheck.value.errorMsg = '密碼和確認密碼需相同';
        }
    });

    //抓取input type 改成password
    onMounted(() => {
        const passwordInput1 = document.querySelector(".password1 input");
        passwordInput1.type = 'password';
        const passwordInput2 = document.querySelector(".password2 input");
        passwordInput2.type = 'password';
        const passwordInput3 = document.querySelector(".password3 input");
        passwordInput3.type = 'password';
    });
</script>
