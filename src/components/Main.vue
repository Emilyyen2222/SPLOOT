<!-- Sam -->
<template>
  <!-- <MainHeader :theme="route.meta.theme" :bgc="route.meta.bgc"></MainHeader> -->
  <RouterView></RouterView>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';

import MainHeader from './MainHeader.vue';

const route = useRoute();
</script>

<style lang="scss" scoped></style>