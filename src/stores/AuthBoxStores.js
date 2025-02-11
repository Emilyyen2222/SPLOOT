import { defineStore } from 'pinia';
import { ref, watch, onBeforeMount} from 'vue';

import openedEye from '@/assets/img/icon/login/openedEye.svg';
import closedEye from '@/assets/img/icon/login/closedEye.svg';

export const useAuthStores = defineStore('auth',() => {

    const isLoggedIn = ref(false);
    
    const authType = ref('login');
    const isAuthBox = ref(false);

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

    const passwords =ref({
        1: 'password',
        2: 'password',
        3: 'password',
    });

    const eyeState =ref({
        1: closedEye,
        2: closedEye,
        3: closedEye,
    });

    const isLightBoxPolicy = ref(false);
    const isLightBoxPrivacy = ref(false);

    function toggleAuthBox() {
        isAuthBox.value = !isAuthBox.value;  // 切換開關

        signUpEmail.value.inputMsg ='';
        signUpPassword.value.inputMsg ='';
        signUpPasswordCheck.value.inputMsg ='';
        loginEmail.value.inputMsg ='';
        loginPassword.value.inputMsg ='';
    };

    function toggleAuthType() {
        authType.value = authType.value === 'login' ? 'signUp' : 'login'; // 通知父層更新 authType
        
        signUpEmail.value.inputMsg ='';
        signUpPassword.value.inputMsg ='';
        signUpPasswordCheck.value.inputMsg ='';
        loginEmail.value.inputMsg ='';
        loginPassword.value.inputMsg ='';

        robotCheck.value.checkValue = false;
        robotCheck.value.hasError = false;
        // console.log("authType 切換為:", authType.value)
    };
    
    function eyeStateToggle(number){
        passwords.value[number] = passwords.value[number] == 'password' ? 'text' : 'password';
        eyeState.value[number] = eyeState.value[number] == closedEye ? openedEye : closedEye;
    };

    function isValidEmail(email){
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    };

    function isValidPassword(password) {
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        return passwordPattern.test(password);
    };

    // Policy Component
    function togglePolicy() {
        isLightBoxPolicy.value = !isLightBoxPolicy.value;
    };
    
    function togglePrivacy() {
        isLightBoxPrivacy.value = !isLightBoxPrivacy.value;
    };

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

    //登入狀態儲存

    async function checkLoginStatus(){
        const resp = await fetch('php/checkLogin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        try{
            const loginStatus = await resp.json();
            if(loginStatus.status == 'loggedIn'){
                isLoggedIn.value = true;
            }else{
                isLoggedIn.value = false;
            }
        }catch(error){
            console.error('Error parsing JSON:', error);
        }
    };

    onBeforeMount(() => {
        checkLoginStatus();
    });

    return {
        isLoggedIn,
        authType,
        isAuthBox,
        loginEmail,
        loginPassword,
        signUpEmail,
        signUpPassword,
        signUpPasswordCheck,
        signUpAgreeCheck,
        robotCheck,
        passwords,
        eyeState,
        isLightBoxPolicy,
        isLightBoxPrivacy,
        toggleAuthType,
        togglePolicy,
        togglePrivacy,
        loginPhp,
        signUpPhp,
        toggleAuthBox,
        eyeStateToggle,
        checkLoginStatus
    };
});