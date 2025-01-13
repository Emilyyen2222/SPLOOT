<template>
  <div :class="btnBox" ref="btnClass" @click="toggleInput">
    <div class="btn" :class="props.btnStyle">
      <span><slot></slot></span>
    </div>
  </div>
</template>

<script setup>
  import { ref, defineProps } from 'vue';

  const props = defineProps({
    btnType: {
      type: String,
      default: 'btnBox',
    },
    btnStyle: {
      type: String,
      required: true
    }
  });

  const btnClass = ref(null);
  const btnBox = ref('');
  
  if(props.btnType == 'btnBox'){
    btnBox.value = 'btnBox'
  }else if(props.btnType == 'form'){
    btnBox.value = 'formBox'
  }

  function toggleInput(){
    if(props.btnType == 'form' & props.btnStyle == 'option'){
      btnClass.value.classList.toggle('-active');
    }
  }

</script>

<style lang="scss" scoped>

</style>