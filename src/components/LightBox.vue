<template>

    <div v-if="isLightBox" class="lightBox" :class="{clicked:isLightBox}">
        <div class="closeBtn" :class="closeBtn" @click="toggleLightBox">
            <img src="@/assets/img/icon/close.svg" alt="closeIcon">
        </div>
        <div class="lightBoxContent" :class="bgc" :style="{padding:`${pY}rem ${pX}rem`}"><slot></slot></div>
    </div>
    
    <div class="blackCover" :class="{clicked:isLightBox}"></div>

 </template>
 
 <script setup>
   import { defineProps, defineEmits } from 'vue';
    
    const props = defineProps({
        closeBtn:{
            type:String,
            default:'',
        },
        bgc:{
            type:String,
            default:'#FFFEFA',
        },
        pX: {
        type: [Number, String],
        required: true
          },
        pY: {
        type: [Number, String],
        required: true
        },
        isLightBox: {
            type: Boolean,
            required: true,
        },
        
    })

    const emit = defineEmits(['toggle']);

    function toggleLightBox() {
    emit('toggle');
    }
 
    
    
 
 </script>
 
 