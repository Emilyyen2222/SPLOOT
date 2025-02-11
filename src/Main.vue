<!-- Sam -->
<template>
  <!-- <MainHeader :theme="route.meta.theme" :bgc="route.meta.bgc"></MainHeader> -->
  <RouterView></RouterView>
  <AuthBox />
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import AuthBox from '@/components/authBox.vue';

// import MainHeader from './MainHeader.vue';

const route = useRoute();
</script>