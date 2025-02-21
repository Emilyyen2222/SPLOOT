<!-- Sam -->
<template>
  <MainHeader v-if="!routePath.includes('backend')" :theme="routeMeta" bgc=""></MainHeader>
  <RouterView></RouterView>
  <AuthBox />
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import AuthBox from '@/components/authBox.vue';

import MainHeader from '@/components/MainHeader.vue';

const route = useRoute();
const routeMeta = computed(() => route.meta.theme);
const routePath = computed(() => route.path);
</script>