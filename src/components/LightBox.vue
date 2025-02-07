<!-- Ian -->
<template>

    <div 
    v-if="displayMode === 'if' ? isLightBox : true" 
    v-show="displayMode === 'show' ? isLightBox : true"
    class="lightBox"
    :class="[{clicked:isLightBox},padding]">
        <div class="lightBoxContent">
            <div class="closeBtnBox">
                <div class="closeBtn" @click="toggleLightBox">
                    <img src="@/assets/img/icon/close.svg" alt="closeIcon">
                </div>
            </div>
            <div class="introTitle">
                <h4 class="bold">{{ title }}</h4>
            </div>
            <div class="overflowBox">
                <div class="overflow">
                    <slot></slot>
                </div>        
            </div>
        </div>
    </div>
    
    <div 
    class="blackCover" 
    :class="{clicked:isLightBox}"
    v-if="displayMode === 'if' ? isLightBox : true" 
    v-show="displayMode === 'show' ? isLightBox : true"
    ></div>

 </template>
 
 <script setup>
   import { defineProps, defineEmits } from 'vue';
    
    const props = defineProps({
        isLightBox: {
            type: Boolean,
            required: true,
        },
        title:{
            type: String,
            required: true,
        },
        padding:{
            type: String,
            required: false,
        },
        displayMode:{
            type:String,
            default:'if',
        }
        
    })
  
    const emit = defineEmits(['toggle']);

    function toggleLightBox(){
    emit('toggle');
    }
 
 </script>
 
 