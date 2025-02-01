<template>
  <div class="progressBar">
    <div v-for="index in total" :key="index" 
    class="progressSegment"
    :class="['progressSegment', { filled: index <= current }]"></div>
  </div>
</template>

<script setup>
  const props = defineProps({
    total: {
      type: Number,
      required: true
    },
    current: {
      type: Number,
      required: true
    }
  });
</script>