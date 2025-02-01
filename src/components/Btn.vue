<template>
  <div :class="box">
    <div class="btn" :class="props.btnStyle">
      <span><slot></slot></span>
    </div>
  </div>
</template>

<script setup>
  import { ref, defineEmits } from 'vue';
  import { useRoute } from 'vue-router';

  const route = useRoute();

  const props = defineProps({
    btnType: {
      type: String,
      default: '',
    },
    btnStyle: {
      type: String,
    },
  });

  const box = ref('');
  
  if(props.btnType == ''){
    box.value = 'defaultBtn';
  }else if(props.btnType == 'form'){
    box.value = 'formBtn';
  }else if(props.btnType == 'event'){
    box.value = 'eventBtn';
  }else if(props.btnType == 'tag'){
    box.value = 'tagBtn';
  }
</script>