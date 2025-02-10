<!-- Sam -->
<template>
    <header :class="[`bg-${props.bgc}`, {'loggedIn': isLoggedIn} ]">
        <nav>
            <div class="navHamburger"
                :class="{'-navFocus': isNavFocus}"
                @click="toggleNav">
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="logo">
                <RouterLink to="/">
                    <img :src="themes[props.theme].logoUrl" alt="Logo">
                </RouterLink>
            </div>
            <ul class="headerList" :class="[{ '-navFocus': isNavFocus }, `bg-${props.bgc}`]">
                <li class="headerItem" 
                v-for="(item, index) in [
                    { name: '認識新毛友', link: '/petInfoCard'},
                    { name: '訂閱寵物盒', link: '/sploot-box'},
                    { name: '尋找小幫手', link: '/sploot-buddy'},
                    { name: '毛孩日曆', link: '/sploot-event'},
                    { name: '友善設施', link: '/sploot-pet-friendly'},
                ]" :key="index">

                    <RouterLink :to="item.link">{{ item.name }}</RouterLink>
                </li>
                <li v-if="isLoggedIn" class="memberCenter">
                    <RouterLink to="/member-center">
                        <img class="memberLogo" :src="memberLogo" alt="memberLogo">
                        <p>會員中心</p>
                    </RouterLink>
                </li>
            </ul>
            <Btn v-if="isLoggedIn == false" class="loginBox" btnStyle="primary small" @click="toggleAuthBox">登入</Btn>
            <div v-if="isLoggedIn == true" class="logOutBox">
                <Btn btnStyle="baseline small" @click="logOutPhp">登出</Btn>
                <RouterLink to="/member-center">
                    <img  class="memberLogo" :src="memberLogo" alt="memberLogo">
                </RouterLink>
            </div>
        </nav>
    </header>
    <AuthBox
    v-model:authType="authType" 
    :isAuthBox="isAuthBox" 
    @toggle="toggleAuthBox"
    ></AuthBox>
</template>
  
<script setup>
    import { ref, computed, onBeforeMount} from 'vue';
    
    import Btn from './Btn.vue';
    import AuthBox from './AuthBox.vue';

    const props = defineProps({
        theme: {
            type: String,
            default: '',
        },
        bgc: {
            type: String,
            required: true,
        }
    });
    
    const themes = {
        red: { logoUrl: new URL('@/assets/img/header-red.svg', import.meta.url).href },
        blue: { logoUrl: new URL('@/assets/img/header-blue.svg', import.meta.url).href },
    }
    const isLoggedIn = ref(false);
    const isNavFocus = ref(false);
    const isAuthBox = ref(false);
    const authType = ref('login'); // 初始為登入模式
    const memberLogoPortrait = ref(8);

    const isMDScreen = computed(()=>{ return window.innerWidth <= 768; });

    const memberLogo = computed(()=>{
        switch (memberLogoPortrait.value){
            case 1:
                return new URL(`@/assets/img/member-center/portrait1.svg`, import.meta.url).href;
                break;
            case 2:
                return new URL(`@/assets/img/member-center/portrait2.svg`, import.meta.url).href;
                break; 
            case 3:
                return new URL(`@/assets/img/member-center/portrait3.svg`, import.meta.url).href;
                break;
            case 4:
                return new URL(`@/assets/img/member-center/portrait4.svg`, import.meta.url).href;
                break;
            case 5:
                return new URL(`@/assets/img/member-center/portrait5.svg`, import.meta.url).href;
                break;
            case 6:
                return new URL(`@/assets/img/member-center/portrait6.svg`, import.meta.url).href;
                break;
            case 7:
                return new URL(`@/assets/img/member-center/portrait7.svg`, import.meta.url).href;
                break;
            case 8:
                return new URL(`@/assets/img/member-center/portrait8.svg`, import.meta.url).href;
                break;
            default:
                return new URL(`@/assets/img/member-center/portrait1.svg`, import.meta.url).href;
                break;
        };
    });

    function toggleNav(){
        isNavFocus.value = !isNavFocus.value
    }
        // 控制登入或註冊框的顯示與隱藏
    function toggleAuthBox() {
        isAuthBox.value = !isAuthBox.value;

        // 停止捲軸
        if (isAuthBox.value) {
            document.body.classList.add('authClicked');
        } else {
            document.body.classList.remove('authClicked');
        }
    }

    async function logOutPhp() {
        const resp = await fetch('php/logout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        try{
            const logoutResp = await resp.json();
        }catch(error){
            console.error('Error parsing JSON:', error);
        }

        window.location.reload();
    }

    onBeforeMount(async () => {
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
    });

    // console.log("%c" + "這個東西好好玩", "color: #D14535; font-size: 80px; font-weight: bold;");
    // console.log("%c" + "到此一遊", "color: #00000; font-size: 60px; font-weight: bold;");

</script>