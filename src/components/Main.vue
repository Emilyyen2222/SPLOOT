<!-- Sam -->
<template>
  <!-- <Banner :theme="route.meta.theme" :bgc="route.meta.bgc"></Banner> -->
  <RouterView></RouterView>
</template>

<script setup>
  import { ref, computed } from 'vue';
  import { useRoute } from 'vue-router';

  import Banner from './Banner.vue';

  const route = useRoute();

  // const meta = computed(() => route.meta);

  // console.log(route.meta.theme);
  // console.log(route.meta.bgc);
</script>    
  
<style lang="scss" scoped>

</style>