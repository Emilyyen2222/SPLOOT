<!-- Sam -->
<template>
    <header :class="[`bg-${props.bgc}`]">
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
            <ul class="headerList" :class="{'-navFocus': isNavFocus}">
                <li class="headerItem" 
                v-for="(item, index) in [
                    { name: '認識新毛友', link: '/match'},
                    { name: '訂閱寵物盒', link: '/sploot-box'},
                    { name: '尋找小幫手', link: '/sploot-buddy'},
                    { name: '毛孩日曆', link: '/sploot-event'},
                    { name: '友善設施', link: '/sploot-pet-friendly'},
                ]" :key="index">

                    <RouterLink :to="item.link">{{ item.name }}</RouterLink>
                </li>
            </ul>
            <Btn class="loginBox" btnStyle="primary small">登入</Btn>
        </nav>
    </header>
</template>
  
<script setup>
    import { ref, defineProps, reactive } from 'vue';
    import { useRoute } from 'vue-router';
    
    import Btn from './Btn.vue';

    const route = useRoute();
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
        red: {
            logoUrl: new URL('@/assets/img/header-red.svg', import.meta.url).href,
        },
        blue: {
            logoUrl: new URL('@/assets/img/header-blue.svg', import.meta.url).href,
        },
    }

    const isNavFocus = ref(false);

    function toggleNav(){
        isNavFocus.value = !isNavFocus.value
    }


</script>