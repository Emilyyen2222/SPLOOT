<template>
  <div class="inputBox" :class="{'-error': hasError}">

    <input 
    type="text"
    :class="textAlign"
    :placeholder="placeHolder"
    :value="modelValue"
    @input="updateValue">
  
    <p v-if="hasError" class="errorMsg"
      :class="textAlign">{{ errorMsg }}</p>
  </div>
</template>

<script setup>
  import { ref, defineProps, defineEmits } from 'vue';

  const props = defineProps({
    textAlign: {
      type: String,
      default: 'textCenter'
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
    },
    modelValue: {
      type: String,
      default: ''
    },
  });

  const emit = defineEmits(['update:modelValue']);

  const updateValue = (e) => {
    emit('update:modelValue', e.target.value);
  };
</script>
