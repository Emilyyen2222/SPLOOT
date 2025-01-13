<!-- Sam -->
<template>
    <header :class="[themes[props.theme].header,`bg-${props.bgc}`]">
        <nav>
            <div class="navHamburger"
                :class="{'-navFocus': isNavFocus}"
                @click="toggleNav">
                <div class="line" :class="themes[props.theme].bg"></div>
                <div class="line" :class="themes[props.theme].bg"></div>
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
                    { name: '毛孩日曆', link: '/sploot-calendar'},
                    { name: '友善設施', link: '/sploot-friendly'},
                ]" :key="index">

                    <RouterLink :to="item.link" 
                    :class="themes[props.theme].color">{{ item.name }}</RouterLink>
                </li>
            </ul>
            <div class="btnBox loginBox">
                <div :class="themes[props.theme].loginBtn"><span>登入</span></div>
            </div>
        </nav>
    </header>
</template>
  
<script setup>
    import { ref, defineProps, reactive } from 'vue';

    const props = defineProps({
        theme: {
            type: String,
            required: true,
        },
        bgc: {
            type: String,
            required: true,
        }
    });

    const themes = {
        red: {
            header: 'redTheme',
            bg: 'bg-red',
            color: 'text-red',
            loginBtn: 'btn primary small',
            logoUrl: new URL('@/assets/img/header-red.svg', import.meta.url).href,
        },
        blue: {
            header: 'blueTheme',
            bg: 'bg-blue',
            color: 'text-blue',
            loginBtn: 'btn blue small',
            logoUrl: new URL('@/assets/img/header-blue.svg', import.meta.url).href,
        },
    }

    const isNavFocus = ref(false);

    function toggleNav(){
        isNavFocus.value = !isNavFocus.value
    }


</script>