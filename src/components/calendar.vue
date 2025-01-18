<template>
    <div>
      <vc-date-picker
      style="background-color: #F5D690;"
      :color="selectedColor"
      expanded/>
    </div>
  </template>

<script setup>
import {ref} from 'vue'

const selectedColor = ref('yellow');

</script>

<style lang="scss" scoped>

</style>