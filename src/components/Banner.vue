<template>
    <header :class="[themes[props.theme].theme, `bg-${props.bgc}`]">
        <nav>
            <div class="navHamburger">
                <div class="line bg-red"></div>
                <div class="line bg-red"></div>
            </div>
            <div class="logo">
                <RouterLink to="/">
                    <img v-if="props.theme == 'red'" src="@/assets/img/header-red.svg" alt="Logo">
                    <img v-if="props.theme == 'blue'" src="@/assets/img/header-blue.svg" alt="Logo">
                </RouterLink>
            </div>
            <ul class="headerList">
                <li class="headerItem"><RouterLink to="/">認識新毛友</RouterLink></li>
                <li class="headerItem"><RouterLink to="/sploot-box">訂閱寵物盒</RouterLink></li>
                <li class="headerItem"><RouterLink to="/sploot-buddy">尋找小幫手</RouterLink></li>
                <li class="headerItem"><RouterLink to="/sploot-calendar">毛孩日曆</RouterLink></li>
                <li class="headerItem"><RouterLink to="/sploot-friendly">友善設施</RouterLink></li>
            </ul>
            <div class="loginBox">
                <div :class="themes[props.theme].btn"><span>登入</span></div>
            </div>
        </nav>
    </header>
</template>
  
<script setup>
    import { ref } from 'vue';

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
        red:{
            theme: 'redTheme',
            btn: 'btn primary small',
        },
        blue:{
            theme: 'blueTheme',
            btn: 'btn blue small',
        }
    }
</script>