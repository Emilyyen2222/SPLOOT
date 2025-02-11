<template>
    <button @click="authBoxStore.toggleAuthBox">HERE</button>
</template>

<script setup>
import { useAuthStores } from '@/stores/AuthBoxStores.js';  

const authBoxStore = useAuthStores();
</script>
