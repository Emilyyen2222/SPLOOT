<!-- Sam -->
<template>
    <header :class="[header, `bg-${bgc}`]">
        <nav>
            <div class="navHamburger">
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="logo">
                <RouterLink to="/">
                    <img v-if="theme == 'red'" src="@/assets/img/header-red.svg" alt="Logo">
                    <img v-if="theme == 'blue'" src="@/assets/img/header-blue.svg" alt="Logo">
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
                <div :class="btn"><span>登入</span></div>
            </div>
        </nav>
    </header>
</template>
  
<script setup>
    import { ref, defineProps } from 'vue';

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

    const header = ref('');
    const btn = ref('');

    if(props.theme == 'red'){
        header.value = 'redTheme';
        btn.value = 'btn primary small';
    }else if(props.theme == 'blue'){
        header.value = 'blueTheme';
        btn.value = 'btn blue small';
    }


</script>