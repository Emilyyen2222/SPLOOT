<!-- Ian -->
<template>

    <div v-if="isLightBox" class="lightBox" :class="{clicked:isLightBox}">
        <div class="lightBoxContent" :class="bgc" :style="{padding:`${pY}rem ${pX}rem`}">
            <div class="closeBtnBox">
                <div class="closeBtn" @click="toggleLightBox">
                    <img src="@/assets/img/icon/close.svg" alt="closeIcon">
                </div>
            </div>
            <div class="introTitle">
                <h4 class="bold">{{ title }}</h4>
            </div>
            <div class="overflow">
                <slot></slot>
            </div>        
        </div>
    </div>
    
    <div class="blackCover" :class="{clicked:isLightBox}"></div>

 </template>
 
 <script setup>
   import { defineProps, defineEmits } from 'vue';
    
    const props = defineProps({
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
        title:{
            type: String,
            required: true,
        },
        
    })
  

    const emit = defineEmits(['toggle']);

    function toggleLightBox() {
    emit('toggle');
    }
 
    
    
 
 </script>
 
 