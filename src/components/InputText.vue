<template>
  <div class="inputBox" :class="{'-error': hasError}">

    <input 
    :type="inputType"
    :placeholder="placeHolder"
    :value="modelValue"
    @input="updateValue">
  
    <p v-if="hasError" class="errorMsg">{{ errorMsg }}</p>
  </div>
</template>

<script setup>
  import { ref, defineProps, defineEmits } from 'vue';

  const props = defineProps({
    inputType: {
      type: String,
      default: 'text'
    },
    modelValue: {
      type: String,
      default: ''
    },
    placeHolder: {
      type: String,
      required: true,
    },
    errorMsg: {
      type: String,
      required: true,
    },
    hasError: {
      type: Boolean,
      default: false
    }
  });

  const emit = defineEmits(['update:modelValue']);

  const updateValue = (e) => {
    emit('update:modelValue', e.target.value);
  };
</script>
