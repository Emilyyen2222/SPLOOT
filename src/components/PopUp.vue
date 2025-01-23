<!-- Ian -->
<template>
   
   <div v-if="isPopUp" class="popUp" :class="{clicked:isPopUp}">
    <slot></slot>
    
   </div>


   <div class="popBlackCover" :class="{clicked:isPopUp}"></div>

</template>

<script setup>
import { defineProps,} from 'vue';

const popProps = defineProps({
    isPopUp:{
        type: Boolean,
        required: true,        
    }
})

</script>