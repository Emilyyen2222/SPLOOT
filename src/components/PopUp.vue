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

<style lang="scss" scoped>
body.clicked{
    overflow-y: hidden;
    }

.popUp{
    border: 1px solid;
    position: fixed;
    z-index: 1010;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    display: none;
    padding: 5.6rem;

    background-color: #FFF;

    &.clicked{
        display: block;
    }
}

//遮罩
.blackCover{
    display: none;

    position: fixed;
    top: 0;

    width: 100%;
    height: 100%;
    background-color: rgb(0, 0, 0, 0.5);

    z-index: 1005;
    
    &.clicked{
    display: block;
    overflow-y: hidden;
    }
}

</style>