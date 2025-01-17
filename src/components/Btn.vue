<template>
  <div :class="box" ref="btnClass" @click="toggleInput(), updateSelection()">
    <div class="btn" :class="props.btnStyle">
      <span><slot></slot></span>
    </div>
  </div>
</template>

<script setup>
  import { ref, defineProps, defineEmits } from 'vue';
  import { useRoute } from 'vue-router';

  const route = useRoute();

  const props = defineProps({
    btnType: {
      type: String,
      default: 'default',
    },
    btnStyle: {
      type: String,
      required: true
    },
    modelValue: {
      type: Array,
      default: () => [],
    }
  });

  const emit = defineEmits(['update:modelValue']);

  const btnClass = ref(null);
  const box = ref('');
  
  if(props.btnType == 'default'){
    box.value = `btn`
  }else if(props.btnType == 'form'){
    box.value = 'formBtn'
  }else if(props.btnType == 'event'){
    box.value = 'eventBtn'
  }

  const toggleInput = () => {
    if(props.btnType == 'form' & props.btnStyle == 'option'){
      btnClass.value.classList.toggle('-active');
    }
  }
  const updateSelection = () => {
    if(props.btnType == 'form' & props.btnStyle == 'option'){

      const selectedText = btnClass.value.querySelector('span').innerText;
      const updatedSelection = [...props.modelValue];

      if(updatedSelection.includes(selectedText)){
        const index = updatedSelection.indexOf(selectedText);
        updatedSelection.splice(index, 1);
      }else{
        updatedSelection.push(selectedText);
      }

      emit('update:modelValue', updatedSelection);
    }
  }
</script>